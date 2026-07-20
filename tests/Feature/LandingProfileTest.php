<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\Paket;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LandingProfileTest extends TestCase
{
    use DatabaseTransactions;

    public function test_tamu_diarahkan_ke_login_saat_membuka_profile(): void
    {
        $this->get(route('member.profile'))
            ->assertRedirect(route('login'));
    }

    public function test_customer_diarahkan_ke_profile_setelah_login_dari_icon_profile(): void
    {
        $user = User::create([
            'name' => 'Customer Login Profil',
            'email' => 'login-profile-'.uniqid().'@example.test',
            'password' => 'password',
            'role' => 'customer',
            'status' => 'active',
        ]);

        $this->get(route('login', ['redirect' => 'profile']))
            ->assertOk();

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('member.profile'));

        $this->get(route('member.profile'))
            ->assertOk()
            ->assertSee('Belum Menjadi Member');
    }

    public function test_admin_diarahkan_ke_login_member_dan_bukan_mendapat_403(): void
    {
        $admin = User::create([
            'name' => 'Admin Profil',
            'email' => 'admin-profile-'.uniqid().'@example.test',
            'password' => 'password',
            'role' => 'admin',
            'status' => 'active',
        ]);

        $this->actingAs($admin)
            ->get(route('member.profile'))
            ->assertRedirect(route('login', ['redirect' => 'profile']));
    }

    public function test_customer_yang_masih_memiliki_sesi_dapat_membuka_profile_tanpa_login_ulang(): void
    {
        $user = User::create([
            'name' => 'Customer Sesi Profil',
            'email' => 'session-profile-'.uniqid().'@example.test',
            'password' => 'password',
            'role' => 'customer',
            'status' => 'active',
        ]);

        $this->actingAs($user)
            ->get(route('member.profile'))
            ->assertOk()
            ->assertSee('Belum Menjadi Member');
    }

    public function test_customer_hanya_melihat_data_member_yang_emailnya_sama(): void
    {
        $paket = Paket::create([
            'nama_paket' => 'Paket Profil '.uniqid(),
            'durasi' => 1,
            'tipe_durasi' => 'bulan',
            'harga' => 150000,
            'deskripsi' => 'Paket untuk pengujian profil.',
        ]);

        $email = 'profile-'.uniqid().'@example.test';
        $user = User::create([
            'name' => 'Customer Profil',
            'email' => $email,
            'password' => 'password',
            'role' => 'customer',
            'status' => 'active',
        ]);

        Member::create([
            'kode_member' => 'MBR'.uniqid(),
            'nama' => 'Nama Member Profil',
            'jenis_kelamin' => 'P',
            'no_hp' => '081234567891',
            'email' => $email,
            'alamat' => 'Bogor',
            'paket_id' => $paket->id,
            'tanggal_daftar' => now(),
            'tanggal_kadaluwarsa' => now()->addMonth(),
            'status' => 'aktif',
        ]);

        $this->actingAs($user)
            ->get(route('member.profile'))
            ->assertOk()
            ->assertSee('Nama Member Profil')
            ->assertSee($paket->nama_paket)
            ->assertSee('Aktif');
    }
}
