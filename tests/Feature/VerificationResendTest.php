<?php

namespace Tests\Feature;

use App\Mail\OtpMail;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class VerificationResendTest extends TestCase
{
    use DatabaseTransactions;

    public function test_customer_dapat_mengirim_ulang_otp_dan_kode_lama_dinonaktifkan(): void
    {
        Mail::fake();

        $user = User::create([
            'name' => 'Customer Verifikasi',
            'email' => 'verify-'.uniqid().'@example.test',
            'password' => 'password',
            'role' => 'customer',
            'status' => 'verify',
        ]);

        $verification = Verification::create([
            'user_id' => $user->id,
            'unique_id' => uniqid(),
            'otp' => md5('123456'),
            'type' => 'register',
            'send_via' => 'email',
            'status' => 'active',
        ]);

        $response = $this->actingAs($user)->post('/verify', [
            'type' => 'register',
        ]);

        $verification->refresh();
        $newVerification = Verification::where('user_id', $user->id)
            ->whereKeyNot($verification->id)
            ->latest('id')
            ->firstOrFail();

        $response->assertRedirect('/verify/'.$newVerification->unique_id);
        $this->assertSame('invalid', $verification->status);
        $this->assertSame('active', $newVerification->status);
        Mail::assertQueued(OtpMail::class, 1);
    }
}
