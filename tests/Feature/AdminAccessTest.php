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



    public function test_admin_dapat_mengakses_dashboard(): void
    {
        $this->actingAs($this->createUser('admin'))
            ->get('/dashboard')
            ->assertOk();
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
