<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\Paket;
use App\Models\PendaftaranMember;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PendaftaranMemberTest extends TestCase
{
    use DatabaseTransactions;

    public function test_pendaftaran_dari_landing_page_dapat_dikonfirmasi_menjadi_member(): void
    {
        $paket = Paket::create([
            'nama_paket' => 'Paket Pengujian',
            'durasi' => 1,
            'tipe_durasi' => 'bulan',
            'harga' => 50000,
            'deskripsi' => 'Paket sementara untuk pengujian.',
        ]);

        $email = 'pendaftar-'.uniqid().'@example.test';

        $response = $this->post(route('pendaftaran.store'), [
            'nama' => 'Calon Member',
            'jenis_kelamin' => 'L',
            'no_hp' => '081234567890',
            'email' => $email,
            'alamat' => 'Bogor',
            'paket_id' => $paket->id,
            'syarat_ketentuan' => '1',
        ]);

        $response->assertRedirect(route('pendaftaran'));
        $this->assertDatabaseHas('tb_pendaftaran', [
            'email' => $email,
            'status_pendaftaran' => 'pending',
        ]);

        $pendaftaran = PendaftaranMember::where('email', $email)->firstOrFail();
        $admin = User::create([
            'name' => 'Admin Pengujian',
            'email' => 'admin-'.uniqid().'@example.test',
            'password' => 'password',
            'role' => 'admin',
            'status' => 'active',
        ]);

        $response = $this
            ->actingAs($admin)
            ->patch(route('admin.pendaftaran.confirm', $pendaftaran));

        $response->assertRedirect(route('admin.pendaftaran.index'));
        $this->assertDatabaseHas('tb_pendaftaran', [
            'id' => $pendaftaran->id,
            'status_pendaftaran' => 'dikonfirmasi',
        ]);
        $this->assertDatabaseHas('tb_member', [
            'nama' => 'Calon Member',
            'email' => $email,
            'paket_id' => $paket->id,
            'status' => 'pending',
        ]);

        $member = Member::where('email', $email)->firstOrFail();
        $this->assertSame('L', $member->jenis_kelamin);
        $this->assertSame('Bogor', $member->alamat);
        $this->assertSame('pending', $member->status);
    }
}
