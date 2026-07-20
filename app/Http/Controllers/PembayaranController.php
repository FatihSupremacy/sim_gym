<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use App\Models\Pembayaran;
use App\Models\Member;
use App\Models\Paket;
use Illuminate\Validation\Rule;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pembayaran::with(['member', 'paket'])->latest()->get();
        return view('fitur_pembayaran.showpembayaran', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $member = Member::query()
            ->with('pembayarans:id,member_id,status')
            ->where('status', 'pending')
            ->whereDoesntHave('pembayarans', function ($query) {
                $query->where('status', 'pending');
            })
            ->get();
        $paket = Paket::all();

        return view('fitur_pembayaran.create', compact('member', 'paket'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $metodeMap = [
            'qris' => 'midtrans',
            'transfer bank' => 'midtrans',
            'e-wallet' => 'midtrans',
            'tunai' => 'manual',
            'manual' => 'manual',
            'midtrans' => 'midtrans',
        ];

        $metodeInput = strtolower(trim((string) $request->metode));
        $metodeDb = $metodeMap[$metodeInput] ?? null;

        $request->validate([
            'member_id' => [
                'required',
                Rule::exists('tb_member', 'id')->where(function ($query) {
                    $query->where('status', 'pending');
                }),
                Rule::unique('tb_pembayaran', 'member_id')->where(function ($query) {
                    $query->where('status', 'pending');
                }),
            ],
            'paket_id' => 'required|exists:tb_paket,id',
            'metode' => 'required',
            'metode_detail' => 'nullable|string|max:50',
            'ewallet_type' => 'nullable|string|max:30',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf,webp|max:5120',
        ], [
            'member_id.exists' => 'Member harus berstatus pending sebelum melakukan pembayaran.',
            'member_id.unique' => 'Member masih memiliki pembayaran yang menunggu konfirmasi.',
        ]);

        if (!$metodeDb) {
            return back()
                ->withInput()
                ->withErrors(['metode' => 'Metode pembayaran tidak valid.']);
        }

        $paket = Paket::findOrFail($request->paket_id);

        $bukti = null;
        if ($request->hasFile('bukti')) {
            $bukti = $request->file('bukti')->store('pembayaran', 'public');
        }

        $metodeDetail = trim((string) $request->metode_detail);
        if ($metodeInput === 'e-wallet') {
            $ewalletType = trim((string) $request->ewallet_type);
            $metodeDetail = $ewalletType ? 'E-Wallet (' . $ewalletType . ')' : 'E-Wallet';
        }

        if ($metodeDetail === '') {
            $metodeDetail = match ($metodeInput) {
                'qris' => 'QRIS',
                'transfer bank' => 'Transfer Bank',
                'tunai' => 'Tunai',
                default => $metodeDb === 'manual' ? 'Tunai' : 'Non Tunai',
            };
        }

        $payload = [
            'member_id' => $request->member_id,
            'paket_id' => $request->paket_id,
            'nominal' => $paket->harga,
            'metode' => $metodeDb,
            'status' => 'pending',
            'bukti' => $bukti
        ];

        if (Schema::hasColumn('tb_pembayaran', 'metode_detail')) {
            $payload['metode_detail'] = $metodeDetail;
        }

        Pembayaran::create($payload);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pembayaran = Pembayaran::with(['member', 'paket'])->findOrFail($id);
        return view('fitur_pembayaran.detailpembayaran', compact('pembayaran'));
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

    public function approve($id)
    {
        $result = DB::transaction(function () use ($id) {
            $pembayaran = Pembayaran::with('paket')
                ->lockForUpdate()
                ->findOrFail($id);

            if ($pembayaran->status !== 'pending') {
                return false;
            }

            $member = Member::lockForUpdate()->findOrFail($pembayaran->member_id);
            $tanggalAktif = now()->startOfDay();
            $tanggalKadaluwarsa = $tanggalAktif->copy();
            $durasi = max((int) $pembayaran->paket->durasi, 0);

            if ($pembayaran->paket->tipe_durasi === 'bulan') {
                $tanggalKadaluwarsa->addMonthsNoOverflow($durasi);
            } else {
                $tanggalKadaluwarsa->addDays($durasi);
            }

            $pembayaran->update(['status' => 'berhasil']);
            $member->update([
                'paket_id' => $pembayaran->paket_id,
                'tanggal_daftar' => $tanggalAktif,
                'tanggal_kadaluwarsa' => $tanggalKadaluwarsa,
                'status' => 'aktif',
            ]);

            return true;
        });

        if (! $result) {
            return redirect()->route('pembayaran.index')
                ->with('warning', 'Pembayaran ini sudah diproses sebelumnya.');
        }

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran dikonfirmasi dan membership member telah aktif.');
    }

    public function reject($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update(['status' => 'ditolak']);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil di-reject');
    }

    public function bukti($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        if (!$pembayaran->bukti || !Storage::disk('public')->exists($pembayaran->bukti)) {
            abort(404);
        }

        $fullPath = Storage::disk('public')->path($pembayaran->bukti);
        $mime = mime_content_type($fullPath) ?: 'application/octet-stream';

        return response()->file($fullPath, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="' . basename($pembayaran->bukti) . '"',
        ]);
    }
}
