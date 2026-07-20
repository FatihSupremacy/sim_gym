<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**x
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $paket = Paket::when($keyword, function ($query) use ($keyword) {
            return $query->where(function ($q) use ($keyword) {
                $q->where('nama_paket', 'like', "%{$keyword}%")
                    ->orWhere('deskripsi', 'like', "%{$keyword}%");
            });
        })
            ->get();

        return view('fitur_paket.showpaket', compact('paket'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fitur_paket.addpaket');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_paket'   => 'required|string|max:255',
            'harga'        => 'required|integer',
            'durasi'      => 'required|integer',
            'tipe_durasi' => 'required|in:hari,bulan',
            'deskripsi'    => 'nullable|string',
        ], [
            'nama_paket.required' => 'Nama paket wajib diisi.',
            'harga.required' => 'Harga paket wajib diisi.',
            'harga.integer' => 'Harga paket harus berupa angka.',
            'durasi.integer' => 'Durasi harus berupa angka.',
            'tipe_durasi.in' => 'Tipe durasi tidak valid.',
        ]);

        Paket::create([
            'nama_paket'  => $request->nama_paket,
            'durasi'      => $request->durasi,
            'tipe_durasi' => $request->tipe_durasi,
            'harga'       => $request->harga,
            'deskripsi'   => $request->deskripsi,
        ]);

        return redirect('/paket')->with('pesan', 'Paket berhasil ditambahkan');
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
        $paket = Paket::findOrFail($id);
        return view('fitur_paket.editpaket', compact('paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $paket = Paket::findOrFail($id);

        $request->validate([
            'nama_paket'   => 'required|string|max:255',
            'harga'        => 'required|integer',
            'durasi_hari'  => 'nullable|integer',
            'durasi'      => 'required|integer',
            'tipe_durasi' => 'required|in:hari,bulan',
            'deskripsi'    => 'nullable|string',
        ], [
            'nama_paket.required' => 'Nama paket wajib diisi.',
            'harga.required'      => 'Harga paket wajib diisi.',
            'harga.integer'       => 'Harga paket harus berupa angka.',
        ]);

        $paket->update([
            'nama_paket'  => $request->nama_paket,
            'durasi'      => $request->durasi,
            'tipe_durasi' => $request->tipe_durasi,
            'harga'       => $request->harga,
            'deskripsi'   => $request->deskripsi,
        ]);

        return redirect('/paket')->with('pesan', 'Paket berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Paket::findOrFail($id)->delete();
            return redirect('/paket')->with('pesan', 'Paket berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/paket')->with('error', 'Paket tidak bisa dihapus karena masih digunakan oleh member.');
        }
    }
}
