<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Member;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $members = Member::with('paket')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', "%$keyword%");
            })
            ->get();

        // ambil semua member yang sudah check-in hari ini
        $checkedInToday = Absen::whereDate('checkin_time', today())
            ->where('tipe', 'bulanan')
            ->pluck('member_id')
            ->toArray();

        return view('fitur_absen.showabsen', compact('members', 'checkedInToday'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $member = Member::findOrFail($request->member_id);

        if ($member->status !== 'aktif') {
            $message = $member->status === 'pending'
                ? 'Membership masih pending pembayaran'
                : 'Membership sudah kadaluarsa';

            return redirect()->back()->with('error', $message);
        }

        $today = today();

        $exists = Absen::where('member_id', $member->id)
            ->where('tipe', 'bulanan')
            ->whereDate('checkin_time', $today)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Member sudah check-in hari ini');
        }

        Absen::create([
            'member_id' => $member->id,
            'tipe' => 'bulanan',
            'checkin_time' => now()
        ]);

        return redirect()->back()->with('success', 'Member berhasil check in!');
    }

    public function checkinHarian()
    {
        Absen::create([
            'member_id' => null,
            'tipe' => 'harian',
            'checkin_time' => now()
        ]);

        return redirect()->back()->with('success', 'Check-in harian berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
