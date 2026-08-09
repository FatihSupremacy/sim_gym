<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Absen;
use App\Models\Member;

class LaporanController extends Controller
{
    // ========================
    // INDEX (LIST CARD)
    // ========================
    public function index(Request $request)
    {
        $tanggal = $request->tanggal;

        $laporans = Laporan::when($tanggal, function ($query) use ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        })
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('fitur_laporan_harian.showlaporan', compact('laporans'));
    }

    // ========================
    // CREATE (FORM + AUTO DATA)
    // ========================
    public function create()
    {
        // Buat instance Laporan sementara dengan tanggal hari ini
        // agar bisa menggunakan method relasi dari model
        $laporan = new Laporan(['tanggal' => today()->toDateString()]);

        $total      = $laporan->totalAbsen();
        $bulanan    = $laporan->totalAbsenBulanan();
        $harian     = $laporan->totalAbsenHarian();
        $memberBaru = $laporan->totalMemberBaru();

        return view('fitur_laporan_harian.addlaporan', compact(
            'total',
            'bulanan',
            'harian',
            'memberBaru'
        ));
    }

    // ========================
    // STORE
    // ========================
    public function store(Request $request)
    {
        $existing = Laporan::whereDate('tanggal', today())->first();

        if ($existing) {
            return back()->with('warning', 'Laporan untuk hari ini sudah dibuat. Silakan edit laporan yang sudah ada.');
        }

        Laporan::create([
            'user_id'         => auth()->id(),
            'tanggal'         => today(),
            'jam_operasional' => $request->jam_operasional,
            'petugas'         => $request->petugas,
            'pendapatan'      => $request->pendapatan,
            'penjualan_produk'=> $request->penjualan_produk,
            'kondisi_alat'    => $request->kondisi_alat,
            'operasional'     => $request->operasional,
            'keluhan'         => $request->keluhan,
            'insiden'         => $request->insiden,
            'tindak_lanjut'   => $request->tindak_lanjut,
        ]);

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil ditambahkan');
    }

    // ========================
    // SHOW (DETAIL + AUTO DATA)
    // ========================
    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);

        // Gunakan method relasi dari model Laporan
        $total      = $laporan->totalAbsen();
        $bulanan    = $laporan->totalAbsenBulanan();
        $harian     = $laporan->totalAbsenHarian();
        $memberBaru = $laporan->totalMemberBaru();

        return view('fitur_laporan_harian.detaillaporan', compact(
            'laporan',
            'total',
            'bulanan',
            'harian',
            'memberBaru'
        ));
    }

    // ========================
    // EDIT
    // ========================
    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('fitur_laporan_harian.editlaporan', compact('laporan'));
    }

    // ========================
    // UPDATE
    // ========================
    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        $laporan->update($request->all());

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil diupdate');
    }

    // ========================
    // DELETE
    // ========================
    public function destroy($id)
    {
        Laporan::findOrFail($id)->delete();

        return back()->with('success', 'Laporan dihapus');
    }
}
