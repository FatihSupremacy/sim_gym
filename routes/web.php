<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LandingProfileController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PendaftaranMemberController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landingpage');
Route::redirect('/landing', '/');
Route::get('/pendaftaran', [PendaftaranMemberController::class, 'create'])->name('pendaftaran');
Route::post('/pendaftaran', [PendaftaranMemberController::class, 'store'])->name('pendaftaran.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', fn () => view('fitur_autentikasi.register'))->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/auth-google-redirect', [AuthController::class, 'google_redirect']);
Route::get('/auth-google-callback', [AuthController::class, 'google_callback']);

Route::group(['middleware' => ['auth', 'check_role:customer']], function () {
    Route::get('/verify', [VerificationController::class, 'index']);
    Route::post('/verify', [VerificationController::class, 'store'])->middleware('throttle:3,1');
    Route::get('/verify/{unique_id}', [VerificationController::class, 'show']);
    Route::put('/verify/{unique_id}', [VerificationController::class, 'update']);
});

Route::group(['middleware' => ['auth', 'check_role:customer', 'check_status']], function () {
    Route::get('/customer', fn () => redirect()->route('landingpage'));
});

Route::group(['middleware' => ['auth', 'check_status']], function () {
    Route::get('/profile', [LandingProfileController::class, 'index'])->name('member.profile');
});

Route::group(['middleware' => ['auth', 'check_role:admin']], function () {
    Route::get('/dashboard', [Dashboard::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/members', [MemberController::class, 'members']);
    Route::get('/members/create', [MemberController::class, 'create']);
    Route::post('/members', [MemberController::class, 'store']);
    Route::get('/members/{id}/perpanjang', [MemberController::class, 'perpanjang']);
    Route::put('/members/{id}/perpanjang', [MemberController::class, 'updatePerpanjang']);
    Route::get('/members/{id}', [MemberController::class, 'show']);
    Route::get('/members/{id}/edit', [MemberController::class, 'edit']);
    Route::put('/members/{id}', [MemberController::class, 'update']);
    Route::delete('/members/{id}', [MemberController::class, 'destroy']);

    Route::resource('paket', PaketController::class);

    Route::resource('absen', AbsenController::class);
    Route::post('/absen/harian', [AbsenController::class, 'checkinHarian'])->name('absen.harian');

    Route::resource('laporan', LaporanController::class);

    Route::resource('pembayaran', PembayaranController::class);
    Route::get('/pembayaran/{id}/approve', [PembayaranController::class, 'approve'])->name('pembayaran.approve');
    Route::get('/pembayaran/{id}/reject', [PembayaranController::class, 'reject'])->name('pembayaran.reject');
    Route::get('/pembayaran/{id}/bukti', [PembayaranController::class, 'bukti'])->name('pembayaran.bukti');

    // Route::get('/user', fn () => 'Halaman user');
    Route::get('/pendaftaran-member', [PendaftaranMemberController::class, 'index'])
        ->name('admin.pendaftaran.index');
    Route::patch('/pendaftaran-member/{pendaftaran}/konfirmasi', [PendaftaranMemberController::class, 'confirm'])
        ->name('admin.pendaftaran.confirm');
    Route::patch('/pendaftaran-member/{pendaftaran}/tolak', [PendaftaranMemberController::class, 'reject'])
        ->name('admin.pendaftaran.reject');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/account', [AuthController::class, 'profile'])->name('account.profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route::view('/hero', 'landingpage.hero');
// Route::view('/benefit', 'landingpage.benefit');
// Route::view('/paket', 'landingpage.paketgym');
// Route::view('/fasilitas', 'landingpage.fasilitas');
// Route::view('/testimoni', 'landingpage.testimoni');
// Route::view('/faq', 'landingpage.faq');
// Route::view('/footer', 'landingpage.footer');
