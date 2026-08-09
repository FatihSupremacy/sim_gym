<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Paket;
use App\Models\PendaftaranMember;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PendaftaranMemberController extends Controller
{
    public function create()
    {
        $paket = Paket::orderBy('nama_paket')->get();

        return view('landingpage.pendaftaran', compact('paket'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'no_hp' => ['required', 'regex:/^[0-9]{10,15}$/'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('tb_member', 'email'),
                Rule::unique('tb_pendaftaran', 'email')
                    ->where(fn ($query) => $query->where('status_pendaftaran', 'pending')),
            ],
            'alamat' => ['required', 'string', 'max:1000'],
            'paket_id' => ['required', 'exists:tb_paket,id'],
            'syarat_ketentuan' => ['accepted'],
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.regex' => 'Nomor HP harus berisi 10 sampai 15 angka.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah menjadi member atau masih memiliki pendaftaran pending.',
            'alamat.required' => 'Alamat wajib diisi.',
            'paket_id.required' => 'Paket membership wajib dipilih.',
            'paket_id.exists' => 'Paket membership tidak valid.',
            'syarat_ketentuan.accepted' => 'Anda harus menyetujui syarat dan ketentuan.',
        ]);

        PendaftaranMember::create([
            'nama' => $validated['nama'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'no_hp' => $validated['no_hp'],
            'email' => $validated['email'],
            'alamat' => $validated['alamat'],
            'paket_id' => $validated['paket_id'],
            'status_pendaftaran' => 'pending',
        ]);

        return redirect()
            ->route('pendaftaran')
            ->with('success', 'Pendaftaran berhasil dikirim. Silakan tunggu konfirmasi dari admin.');
    }

    public function index()
    {
        $pendaftaran = PendaftaranMember::with('paket')
            ->orderByRaw("CASE WHEN status_pendaftaran = 'pending' THEN 0 ELSE 1 END")
            ->latest()
            ->paginate(15);

        return view('fitur_member.pendaftaran', compact('pendaftaran'));
    }

    public function confirm(PendaftaranMember $pendaftaran)
    {
        $result = DB::transaction(function () use ($pendaftaran) {
            $pendaftaran = PendaftaranMember::with('paket')
                ->lockForUpdate()
                ->findOrFail($pendaftaran->id);

            if ($pendaftaran->status_pendaftaran !== 'pending') {
                return 'processed';
            }

            if (Member::where('email', $pendaftaran->email)->exists()) {
                return 'duplicate';
            }

            $tanggalDaftar = Carbon::today();
            $tanggalKadaluwarsa = $tanggalDaftar->copy();
            $durasi = max((int) $pendaftaran->paket->durasi, 0);

            if ($pendaftaran->paket->tipe_durasi === 'bulan') {
                $tanggalKadaluwarsa->addMonthsNoOverflow($durasi);
            } else {
                $tanggalKadaluwarsa->addDays($durasi);
            }

            $lastId = Member::query()->lockForUpdate()->max('id') ?? 0;
            $kodeMember = 'MBR'.str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

            Member::create([
                'kode_member' => $kodeMember,
                'nama' => $pendaftaran->nama,
                'jenis_kelamin' => $pendaftaran->jenis_kelamin,
                'no_hp' => $pendaftaran->no_hp,
                'email' => $pendaftaran->email,
                'alamat' => $pendaftaran->alamat,
                'paket_id' => $pendaftaran->paket_id,
                'tanggal_daftar' => $tanggalDaftar,
                'tanggal_kadaluwarsa' => $tanggalKadaluwarsa,
                'status' => 'pending',
            ]);

            $pendaftaran->update([
                'status_pendaftaran' => 'dikonfirmasi',
                'catatan' => 'Dikonfirmasi menjadi member pada '.now()->format('d-m-Y H:i'),
            ]);

            return 'confirmed';
        });

        if ($result === 'processed') {
            return back()->with('warning', 'Pendaftaran ini sudah diproses sebelumnya.');
        }

        if ($result === 'duplicate') {
            return back()->with('warning', 'Email pendaftar sudah terdaftar pada data member.');
        }

        return redirect()
            ->route('admin.pendaftaran.index')
            ->with('pesan', 'Pendaftaran berhasil dipindahkan ke daftar member dengan status pending pembayaran.');
    }

    public function reject(Request $request, PendaftaranMember $pendaftaran)
    {
        $validated = $request->validate([
            'catatan' => ['required', 'string', 'max:1000'],
        ], [
            'catatan.required' => 'Catatan penolakan wajib diisi.',
        ]);

        $updated = PendaftaranMember::whereKey($pendaftaran->id)
            ->where('status_pendaftaran', 'pending')
            ->update([
                'status_pendaftaran' => 'ditolak',
                'catatan' => $validated['catatan'],
            ]);

        if (! $updated) {
            return back()->with('warning', 'Pendaftaran ini sudah diproses sebelumnya.');
        }

        return redirect()
            ->route('admin.pendaftaran.index')
            ->with('pesan', 'Pendaftaran berhasil ditolak.');
    }
}
