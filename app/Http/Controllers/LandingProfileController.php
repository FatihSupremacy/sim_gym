<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\PendaftaranMember;
use Illuminate\Http\Request;

class LandingProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'customer') {
            return redirect()
                ->route('login', ['redirect' => 'profile'])
                ->with('failed', 'Silakan masuk menggunakan akun customer yang terdaftar sebagai member.');
        }

        $member = Member::with('paket')
            ->where('email', $user->email)
            ->latest('id')
            ->first();

        $pendaftaran = null;

        if (! $member) {
            $pendaftaran = PendaftaranMember::with('paket')
                ->where('email', $user->email)
                ->latest('id')
                ->first();
        }

        return view('landingpage.profile', compact('user', 'member', 'pendaftaran'));
    }
}
