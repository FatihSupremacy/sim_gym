<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\Paket;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MembershipStatusTest extends TestCase
{
    use DatabaseTransactions;

    public function test_member_yang_ditambahkan_admin_dimulai_dengan_status_pending(): void
    {
        $paket = $this->createPaket();
        $email = 'member-admin-'.uniqid().'@example.test';

        $response = $this->actingAs($this->createAdmin())->post('/members', [
            'nama' => 'Member Admin',
            'jenis_kelamin' => 'L',
            'no_hp' => '081234567890',
            'email' => $email,
            'alamat' => 'Jakarta',
            'paket_id' => $paket->id,
            'tanggal_daftar' => now()->format('d-m-Y'),
            'tanggal_kadaluwarsa' => now()->addMonth()->format('d-m-Y'),
        ]);

        $response->assertRedirect('/members');
        $this->assertDatabaseHas('tb_member', [
            'email' => $email,
            'status' => 'pending',
        ]);
    }

    public function test_konfirmasi_pembayaran_mengaktifkan_membership_dan_memulai_masa_aktif(): void
    {
        $paket = $this->createPaket();
        $member = Member::create([
            'kode_member' => 'MBR'.uniqid(),
            'nama' => 'Member Pending',
            'jenis_kelamin' => 'P',
            'no_hp' => '081234567891',
            'email' => 'member-pending-'.uniqid().'@example.test',
            'alamat' => 'Bandung',
            'paket_id' => $paket->id,
            'tanggal_daftar' => now()->subWeek(),
            'tanggal_kadaluwarsa' => now()->addWeek(),
            'status' => 'pending',
        ]);
        $pembayaran = Pembayaran::create([
            'member_id' => $member->id,
            'paket_id' => $paket->id,
            'nominal' => $paket->harga,
            'metode' => 'manual',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->createAdmin())
            ->get(route('pembayaran.approve', $pembayaran));

        $response->assertRedirect(route('pembayaran.index'));
        $this->assertDatabaseHas('tb_pembayaran', [
            'id' => $pembayaran->id,
            'status' => 'berhasil',
        ]);
        $this->assertDatabaseHas('tb_member', [
            'id' => $member->id,
            'status' => 'aktif',
            'tanggal_daftar' => now()->toDateString(),
            'tanggal_kadaluwarsa' => now()->addMonthNoOverflow()->toDateString(),
        ]);
        $this->assertSame('aktif', $member->fresh()->status);
    }

    private function createPaket(): Paket
    {
        return Paket::create([
            'nama_paket' => 'Paket Status '.uniqid(),
            'durasi' => 1,
            'tipe_durasi' => 'bulan',
            'harga' => 150000,
            'deskripsi' => 'Paket untuk pengujian status membership.',
        ]);
    }

    private function createAdmin(): User
    {
        return User::create([
            'name' => 'Admin Pengujian',
            'email' => 'admin-'.uniqid().'@example.test',
            'password' => 'password',
            'role' => 'admin',
            'status' => 'active',
        ]);
    }
}
