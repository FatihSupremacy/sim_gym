<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Member;
use App\Models\Paket;
use App\Models\Pembayaran;
use Carbon\Carbon;

class Dashboard extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        $totalMember = Member::count();
        $memberAktif = Member::where('status', 'aktif')
            ->whereDate('tanggal_kadaluwarsa', '>=', $today)
            ->count();
        $memberKadaluwarsa = Member::where('status', 'aktif')
            ->whereDate('tanggal_kadaluwarsa', '<', $today)
            ->count();
        $pembayaranPending = Pembayaran::where('status', 'pending')->count();
        $pendapatanBulanIni = Pembayaran::where('status', 'berhasil')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('nominal');
        $checkinHariIni = Absen::whereDate('checkin_time', $today)->count();

        $trendStartMonth = $now->copy()->startOfMonth()->subMonths(5);
        $trendEndMonth = $now->copy()->endOfMonth();

        $monthBuckets = collect(range(0, 5))
            ->map(fn($index) => $trendStartMonth->copy()->addMonths($index));

        $memberRows = Member::select('created_at')
            ->whereBetween('created_at', [$trendStartMonth, $trendEndMonth])
            ->get();
        $memberByMonth = $memberRows->groupBy(fn($row) => Carbon::parse($row->created_at)->format('Y-m'))
            ->map(fn($rows) => $rows->count());

        $pembayaranRows = Pembayaran::select('created_at', 'nominal')
            ->where('status', 'berhasil')
            ->whereBetween('created_at', [$trendStartMonth, $trendEndMonth])
            ->get();
        $pendapatanByMonth = $pembayaranRows->groupBy(fn($row) => Carbon::parse($row->created_at)->format('Y-m'))
            ->map(fn($rows) => $rows->sum('nominal'));

        $trendLabels = $monthBuckets->map(fn($month) => $month->format('M Y'))->values()->all();
        $trendMemberData = $monthBuckets->map(function ($month) use ($memberByMonth) {
            return (int) ($memberByMonth->get($month->format('Y-m')) ?? 0);
        })->values()->all();
        $trendPendapatanData = $monthBuckets->map(function ($month) use ($pendapatanByMonth) {
            return (int) ($pendapatanByMonth->get($month->format('Y-m')) ?? 0);
        })->values()->all();

        $komposisiPaket = Paket::query()
            ->withCount('members')
            ->orderByDesc('members_count')
            ->get();
        $komposisiLabels = $komposisiPaket->pluck('nama_paket')->all();
        $komposisiData = $komposisiPaket->pluck('members_count')->map(fn($count) => (int) $count)->all();

        $pembayaranTerbaru = Pembayaran::with([
            'member:id,nama,kode_member',
            'paket:id,nama_paket'
        ])->latest()->take(10)->get();

        $memberTerbaru = Member::with('paket:id,nama_paket')
            ->orderByDesc('tanggal_daftar')
            ->take(10)
            ->get();

        $checkinTerbaruHariIni = Absen::with('member:id,nama,kode_member')
            ->whereDate('checkin_time', $today)
            ->orderByDesc('checkin_time')
            ->take(10)
            ->get();

        return view('fitur_dashboard.dashboard', compact(
            'totalMember',
            'memberAktif',
            'memberKadaluwarsa',
            'pembayaranPending',
            'pendapatanBulanIni',
            'checkinHariIni',
            'trendLabels',
            'trendMemberData',
            'trendPendapatanData',
            'komposisiLabels',
            'komposisiData',
            'pembayaranTerbaru',
            'memberTerbaru',
            'checkinTerbaruHariIni'
        ));
    }
}
