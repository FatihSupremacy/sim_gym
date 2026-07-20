<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\Paket;
use App\Models\Pembayaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PerpanjangMembershipTest extends TestCase
{
    use DatabaseTransactions;

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    public function test_form_perpanjang_memakai_hari_ini_dan_durasi_paket_sebagai_tanggal_awal(): void
    {
        Carbon::setTestNow('2026-01-31 10:00:00');

        $paket = $this->createPaket();
        $member = $this->createMember($paket);

        $response = $this->actingAs($this->createAdmin())
            ->get("/members/{$member->id}/perpanjang");

        $response->assertOk()
            ->assertViewHas('tanggalPerpanjangDefault', '31-01-2026')
            ->assertViewHas('tanggalKadaluwarsaDefault', '28-02-2026');
    }

    public function test_tanggal_perpanjang_dan_kadaluwarsa_tetap_bisa_disimpan_manual(): void
    {
        $paket = $this->createPaket();
        $member = $this->createMember($paket);

        $response = $this->actingAs($this->createAdmin())
            ->put("/members/{$member->id}/perpanjang", [
                'paket_id' => $paket->id,
                'tanggal_daftar' => '10-08-2026',
                'tanggal_kadaluwarsa' => '15-10-2026',
            ]);

        $response->assertRedirect('/members');
        $this->assertDatabaseHas('tb_member', [
            'id' => $member->id,
            'tanggal_daftar' => '2026-08-10',
            'tanggal_kadaluwarsa' => '2026-10-15',
            'status' => 'pending',
        ]);
    }

    public function test_member_perpanjangan_dengan_riwayat_pembayaran_berhasil_bisa_membayar_lagi(): void
    {
        $paket = $this->createPaket();
        $member = $this->createMember($paket);
        $admin = $this->createAdmin();

        Pembayaran::create([
            'member_id' => $member->id,
            'paket_id' => $paket->id,
            'nominal' => $paket->harga,
            'metode' => 'manual',
            'status' => 'berhasil',
        ]);

        $this->actingAs($admin)
            ->put("/members/{$member->id}/perpanjang", [
                'paket_id' => $paket->id,
                'tanggal_daftar' => '10-08-2026',
                'tanggal_kadaluwarsa' => '10-09-2026',
            ])
            ->assertRedirect('/members');

        $this->actingAs($admin)
            ->get('/pembayaran/create')
            ->assertOk()
            ->assertViewHas('member', function ($members) use ($member) {
                return $members->contains('id', $member->id);
            });
    }

    private function createPaket(): Paket
    {
        return Paket::create([
            'nama_paket' => 'Paket Perpanjang '.uniqid(),
            'durasi' => 1,
            'tipe_durasi' => 'bulan',
            'harga' => 150000,
            'deskripsi' => 'Paket untuk pengujian perpanjang membership.',
        ]);
    }

    private function createMember(Paket $paket): Member
    {
        return Member::create([
            'kode_member' => 'MBR'.uniqid(),
            'nama' => 'Member Perpanjang',
            'jenis_kelamin' => 'L',
            'no_hp' => '081234567899',
            'email' => 'member-perpanjang-'.uniqid().'@example.test',
            'alamat' => 'Jakarta',
            'paket_id' => $paket->id,
            'tanggal_daftar' => '2025-12-01',
            'tanggal_kadaluwarsa' => '2025-12-31',
            'status' => 'aktif',
        ]);
    }

    private function createAdmin(): User
    {
        return User::create([
            'name' => 'Admin Pengujian',
            'email' => 'admin-perpanjang-'.uniqid().'@example.test',
            'password' => 'password',
            'role' => 'admin',
            'status' => 'active',
        ]);
    }
}
