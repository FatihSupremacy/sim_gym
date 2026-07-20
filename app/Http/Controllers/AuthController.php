<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\AbstractProvider;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        if ($request->query('redirect') === 'profile') {
            $request->session()->put('url.intended', route('member.profile'));
        }

        return view('fitur_autentikasi.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|max:50',
        ]);
        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role == 'customer') {
                if ($user->status === 'verify') {
                    return redirect('/verify');
                }

                return redirect()->intended(route('landingpage'));
            }

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->with('failed', 'Akun ini tidak memiliki akses ke website admin.');
        }

        return back()->with('failed', 'Email atau password salah');
    }

    public function profile()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        return view('fitur_autentikasi.account', [
            'user' => Auth::user(),
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:users,email',
            'password' => 'required|max:50|min:8|confirmed',
        ], [
            'email.unique' => 'Email sudah terdaftar. Silakan masuk menggunakan akun tersebut.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'customer',
            'status' => 'verify',
        ]);
        Auth::login($user);

        return redirect('/verify');
    }

    public function google_redirect()
    {
        /** @var AbstractProvider $googleProvider */
        $googleProvider = Socialite::driver('google');

        return $googleProvider->stateless()->redirect();
    }

    public function google_callback(Request $request)
    {
        if ($request->has('error')) {
            return redirect('/login')->with('failed', 'Login Google dibatalkan atau ditolak.');
        }

        /** @var AbstractProvider $googleProvider */
        $googleProvider = Socialite::driver('google');
        $googleUser = $googleProvider->stateless()->user();
        $email = $googleUser->getEmail();

        if (! $email) {
            return redirect('/login')->with('failed', 'Email akun Google tidak ditemukan.');
        }

        $user = User::whereEmail($email)->first();
        if (! $user) {
            $user = User::create([
                'name' => $googleUser->getName() ?: $email,
                'email' => $email,
                'email_verified_at' => now(),
                'password' => Str::random(32),
                'role' => 'customer',
                'status' => 'active',
            ]);
        }
        if ($user && $user->status == 'banned') {
            return redirect('/login')->with('failed', 'Akun anda telah di bekukan');
        }
        Auth::login($user);
        $request->session()->regenerate();

        if ($user->role == 'customer') {
            return redirect()->intended(route('landingpage'));
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('failed', 'Akun ini tidak memiliki akses ke website admin.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
