<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use DatabaseTransactions;

    public function test_tamu_diarahkan_ke_login_saat_mengakses_website_admin(): void
    {
        $this->get('/dashboard')->assertRedirect(route('login'));
        $this->get('/members')->assertRedirect(route('login'));
        $this->get('/pembayaran')->assertRedirect(route('login'));
    }

    public function test_staff_dilarang_mengakses_seluruh_menu_website_admin(): void
    {
        $staff = $this->createUser('staff');
        $adminPages = [
            '/dashboard',
            '/members',
            '/paket',
            '/absen',
            '/laporan',
            '/pembayaran',
            '/pendaftaran-member',
            '/user',
        ];

        foreach ($adminPages as $page) {
            $this->actingAs($staff)->get($page)->assertForbidden();
        }
    }

    public function test_admin_dapat_mengakses_dashboard(): void
    {
        $this->actingAs($this->createUser('admin'))
            ->get('/dashboard')
            ->assertOk();
    }

    public function test_login_staff_ditolak_dan_session_dikeluarkan(): void
    {
        $staff = $this->createUser('staff');

        $this->post('/login', [
            'email' => $staff->email,
            'password' => 'password',
        ])->assertSessionHas('failed', 'Akun ini tidak memiliki akses ke website admin.');

        $this->assertGuest();
    }

    private function createUser(string $role): User
    {
        return User::create([
            'name' => ucfirst($role).' Pengujian',
            'email' => $role.'-'.uniqid().'@example.test',
            'password' => 'password',
            'role' => $role,
            'status' => 'active',
        ]);
    }
}
