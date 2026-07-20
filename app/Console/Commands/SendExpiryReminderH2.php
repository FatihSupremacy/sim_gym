<?php

namespace App\Console\Commands;

use App\Models\Member;
use App\Models\Notifikasi;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Throwable;

class SendExpiryReminderH2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:notify-expiry-h2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim notifikasi WhatsApp H-2 sebelum masa aktif member kadaluwarsa';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiUrl = (string) env('WA_API_URL');
        $apiKey = (string) env('WA_API_KEY');
        $session = (string) env('WA_SESSION');

        if ($apiUrl === '' || $apiKey === '' || $session === '') {
            $this->error('Konfigurasi WhatsApp API belum lengkap. Cek WA_API_URL, WA_API_KEY, WA_SESSION di .env');
            return self::FAILURE;
        }

        $targetDate = Carbon::today()->addDays(2);
        $targetDateString = $targetDate->toDateString();
        $tipeNotifikasi = 'h_minus_2';

        $members = Member::where('status', 'aktif')
            ->whereDate('tanggal_kadaluwarsa', $targetDateString)
            ->get();

        if ($members->isEmpty()) {
            $this->info("Tidak ada member dengan kadaluwarsa pada {$targetDateString} (H-2).");
            return self::SUCCESS;
        }

        $sent = 0;
        $failed = 0;
        $skipped = 0;

        foreach ($members as $member) {
            $existing = Notifikasi::where('member_id', $member->id)
                ->where('tipe_notifikasi', $tipeNotifikasi)
                ->whereDate('tanggal_kadaluwarsa', $targetDateString)
                ->first();

            if ($existing && $existing->status === 'sent') {
                $skipped++;
                $this->line("SKIP  - {$member->nama} ({$member->kode_member}) sudah terkirim sebelumnya.");
                continue;
            }

            $nomor = $this->normalizePhoneNumber((string) $member->no_hp);
            if (!$nomor) {
                $failed++;
                Notifikasi::updateOrCreate(
                    [
                        'member_id' => $member->id,
                        'tipe_notifikasi' => $tipeNotifikasi,
                        'tanggal_kadaluwarsa' => $targetDateString,
                    ],
                    [
                        'channel' => 'whatsapp',
                        'status' => 'failed',
                        'response' => 'Nomor HP tidak valid',
                        'sent_at' => now(),
                    ]
                );

                $this->warn("GAGAL - {$member->nama} ({$member->kode_member}) nomor HP tidak valid.");
                continue;
            }

            $text = "Halo {$member->nama}, masa aktif member Anda akan berakhir pada "
                . Carbon::parse($member->tanggal_kadaluwarsa)->format('d-m-Y')
                . ". Silakan perpanjang membership anda agar tetap aktif.";

            try {
                $response = Http::timeout(30)
                    ->withHeaders([
                        'Content-Type' => 'application/json',
                        'X-API-Key' => $apiKey,
                    ])
                    ->post($apiUrl, [
                        'session' => $session,
                        'to' => $nomor . '@s.whatsapp.net',
                        'text' => $text,
                        'is_group' => false,
                    ]);

                $status = $response->successful() ? 'sent' : 'failed';

                Notifikasi::updateOrCreate(
                    [
                        'member_id' => $member->id,
                        'tipe_notifikasi' => $tipeNotifikasi,
                        'tanggal_kadaluwarsa' => $targetDateString,
                    ],
                    [
                        'channel' => 'whatsapp',
                        'status' => $status,
                        'response' => $response->body(),
                        'sent_at' => now(),
                    ]
                );

                if ($status === 'sent') {
                    $sent++;
                    $this->info("SUKSES - {$member->nama} ({$member->kode_member})");
                } else {
                    $failed++;
                    $this->warn("GAGAL - {$member->nama} ({$member->kode_member}) HTTP " . $response->status());
                }
            } catch (Throwable $e) {
                $failed++;

                Notifikasi::updateOrCreate(
                    [
                        'member_id' => $member->id,
                        'tipe_notifikasi' => $tipeNotifikasi,
                        'tanggal_kadaluwarsa' => $targetDateString,
                    ],
                    [
                        'channel' => 'whatsapp',
                        'status' => 'failed',
                        'response' => $e->getMessage(),
                        'sent_at' => now(),
                    ]
                );

                $this->error("ERROR - {$member->nama} ({$member->kode_member}) {$e->getMessage()}");
            }
        }

        $this->newLine();
        $this->info("Selesai kirim notifikasi H-2 tanggal {$targetDateString}.");
        $this->line("Sukses : {$sent}");
        $this->line("Gagal  : {$failed}");
        $this->line("Skip   : {$skipped}");

        return self::SUCCESS;
    }

    private function normalizePhoneNumber(string $phone): ?string
    {
        $phone = preg_replace('/\D+/', '', $phone) ?? '';

        if ($phone === '') {
            return null;
        }

        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        } elseif (str_starts_with($phone, '8')) {
            $phone = '62' . $phone;
        } elseif (!str_starts_with($phone, '62')) {
            $phone = '62' . ltrim($phone, '0');
        }

        return strlen($phone) >= 10 ? $phone : null;
    }
}
