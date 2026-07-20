<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Paket;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function members(Request $request)
    {
        $search = $request->keyword;
        $sort   = $request->sort;
        $status = $request->status;
        $tanggalDari   = $request->tanggal_dari;
        $tanggalSampai = $request->tanggal_sampai;

        $data = Member::with('paket')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('kode_member', 'like', "%{$search}%")
                        ->orWhere('nama', 'like', "%{$search}%")
                        ->orWhere('jenis_kelamin', 'like', "%{$search}%")
                        ->orWhere('no_hp', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('alamat', 'like', "%{$search}%")
                        ->orWhereRaw("DATE_FORMAT(tanggal_daftar, '%d %M %Y') like ?", ["%{$search}%"])
                        ->orWhereRaw("DATE_FORMAT(tanggal_daftar, '%Y-%m-%d') like ?", ["%{$search}%"]);
                });
            })
            ->when($sort === 'terbaru', function ($query) {
                return $query->orderBy('tanggal_daftar', 'desc');
            })
            ->when($sort === 'terlama', function ($query) {
                return $query->orderBy('tanggal_daftar', 'asc');
            })
            ->when($sort === 'kadaluwarsa', function ($query) {
                return $query->orderBy('tanggal_kadaluwarsa', 'asc');
            })
            ->when($status === 'aktif', function ($query) {
                return $query->where('status', 'aktif')
                    ->whereDate('tanggal_kadaluwarsa', '>=', now());
            })
            ->when($status === 'kadaluwarsa', function ($query) {
                return $query->where('status', 'aktif')
                    ->whereDate('tanggal_kadaluwarsa', '<', now());
            })
            ->when($status === 'pending', function ($query) {
                return $query->where('status', 'pending');
            })
            ->when($tanggalDari && !$tanggalSampai, function ($query) use ($tanggalDari) {
                return $query->whereDate('tanggal_daftar', Carbon::createFromFormat('d/m/Y', $tanggalDari));
            })
            ->when($tanggalDari && $tanggalSampai, function ($query) use ($tanggalDari, $tanggalSampai) {
                return $query->whereDate('tanggal_daftar', '>=', Carbon::createFromFormat('d/m/Y', $tanggalDari))
                    ->whereDate('tanggal_daftar', '<=', Carbon::createFromFormat('d/m/Y', $tanggalSampai));
            })
            ->get();

        $memberUntukStatistik = Member::all();
        $totalMember       = $memberUntukStatistik->count();
        $memberAktif       = $memberUntukStatistik->filter(fn($m) => $m->status === 'aktif')->count();
        $memberPending     = $memberUntukStatistik->filter(fn($m) => $m->status === 'pending')->count();
        $memberKadaluwarsa = $memberUntukStatistik->filter(fn($m) => $m->status === 'kadaluwarsa')->count();

        return view('fitur_member.showmember', [
            'data_member'       => $data,
            'totalMember'       => $totalMember,
            'memberAktif'       => $memberAktif,
            'memberPending'     => $memberPending,
            'memberKadaluwarsa' => $memberKadaluwarsa,
            'sort'              => $sort,
            'status'            => $status,
            'tanggalDari'       => $tanggalDari,
            'tanggalSampai'     => $tanggalSampai,
        ]);
    }

    public function create() //method members
    {
        $paket = Paket::all(); // TAMBAH - kirim data paket ke view
        return view('fitur_member.addmember', compact('paket'));
    }

    public function store(Request $request)
    {
        // dd(Request()->nama); -> untuk mengecek data yang masuk ke form

        // dd($request->all());

        //validasi data yang masuk ke form
        $request->validate([
            // 'kode_member'   => 'required|unique:tb_member,kode_member', // TAMBAH unique
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // TAMBAH validasi untuk foto
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp'         => 'required|digits_between:10,15',
            'email' => 'nullable|email|unique:tb_member,email',
            'alamat'        => 'required|string',
            'paket_id'      => 'required|exists:tb_paket,id', // TAMBAH exists
            'tanggal_daftar' => 'required|date_format:d-m-Y',
            'tanggal_kadaluwarsa' => 'required|date_format:d-m-Y',
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
            'no_hp.required' => 'Nomor Hp wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'alamat.required' => 'Alamat wajib diisi',
            'paket_id.required' => 'Paket wajib dipilih',
            'paket_id.exists' => 'Paket yang dipilih tidak valid',
            'tanggal_daftar.required' => 'Tanggal daftar wajib diisi',
            'tanggal_daftar.date_format' => 'Format tanggal daftar tidak valid, gunakan dd-mm-yyyy',
            'tanggal_kadaluwarsa.required' => 'Tanggal kadaluwarsa wajib diisi',
            'tanggal_kadaluwarsa.date_format' => 'Format tanggal kadaluwarsa tidak valid, gunakan dd-mm-yyyy',

        ]);
        // BARU - pakai id database
        $lastId = Member::max('id') ?? 0;
        $newNumber = $lastId + 1;
        $kodeMember = 'MBR' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        $namaFile = null;
        if ($request->hasFile('foto')) {
            $namaFile = Str::random(5) . '.' . $request->foto->extension();
            $request->foto->move(public_path('foto_member'), $namaFile);
        }

        $paket = Paket::findOrFail($request->paket_id);
        $tanggalDaftar = Carbon::createFromFormat('d-m-Y', $request->tanggal_daftar);
        $tanggalKadaluwarsa = Carbon::createFromFormat('d-m-Y', $request->tanggal_kadaluwarsa);

        Member::create([
            'kode_member'         => $kodeMember,
            'foto'                => $namaFile,
            'nama'                => $request->nama,
            'jenis_kelamin'       => $request->jenis_kelamin,
            'no_hp'               => $request->no_hp,
            'email'               => $request->email,
            'alamat'              => $request->alamat,
            'paket_id'            => $request->paket_id,
            'tanggal_daftar'      => $tanggalDaftar,
            'tanggal_kadaluwarsa' => $tanggalKadaluwarsa,
            'status'              => 'pending',
        ]);

        //mengarahkan ke halaman /members & mengirimkan pesan berhasil setelah berhasil menambahkan data
        return redirect('/members')->with('pesan', 'Data member berhasil ditambahkan');
    }

    public function show($id)
    {
        $data = Member::findOrFail($id);
        return view('fitur_member.detailmember', [
            'data_member' => $data,
        ]);
    }

    public function edit($id)
    {
        $data = Member::findOrFail($id);
        $paket = Paket::all(); // ini yang kurang
        return view('fitur_member.editmember', compact('data', 'paket'));
    }

    public function perpanjang($id)
    {
        $data = Member::findOrFail($id);
        $paket = Paket::all();
        $paketIdTerpilih = session()->getOldInput('paket_id', $data->paket_id);
        $paketTerpilih = $paket->firstWhere('id', $paketIdTerpilih);

        $tanggalPerpanjangDefault = Carbon::today('Asia/Jakarta');
        $tanggalKadaluwarsaDefault = $tanggalPerpanjangDefault->copy();

        if ($paketTerpilih) {
            $durasi = max((int) $paketTerpilih->durasi, 0);

            if ($paketTerpilih->tipe_durasi === 'bulan') {
                $tanggalKadaluwarsaDefault->addMonthsNoOverflow($durasi);
            } else {
                $tanggalKadaluwarsaDefault->addDays($durasi);
            }
        }

        return view('fitur_member.perpanjangmember', [
            'data' => $data,
            'paket' => $paket,
            'tanggalPerpanjangDefault' => $tanggalPerpanjangDefault->format('d-m-Y'),
            'tanggalKadaluwarsaDefault' => $tanggalKadaluwarsaDefault->format('d-m-Y'),
        ]);
    }

    public function updatePerpanjang(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'paket_id'            => 'required|exists:tb_paket,id',
            'tanggal_daftar'      => 'required|date_format:d-m-Y',
            'tanggal_kadaluwarsa' => 'required|date_format:d-m-Y',
        ], [
            'paket_id.required'            => 'Paket wajib dipilih',
            'paket_id.exists'              => 'Paket yang dipilih tidak valid',
            'tanggal_daftar.required'      => 'Tanggal perpanjang wajib diisi',
            'tanggal_daftar.date_format'   => 'Format tanggal perpanjang tidak valid, gunakan dd-mm-yyyy',
            'tanggal_kadaluwarsa.required' => 'Tanggal kadaluwarsa wajib diisi',
            'tanggal_kadaluwarsa.date_format' => 'Format tanggal kadaluwarsa tidak valid, gunakan dd-mm-yyyy',
        ]);

        $tanggalPerpanjang = Carbon::createFromFormat('d-m-Y', $request->tanggal_daftar);
        $tanggalKadaluwarsa = Carbon::createFromFormat('d-m-Y', $request->tanggal_kadaluwarsa);

        $member->update([
            'paket_id'            => $request->paket_id,
            'tanggal_daftar'      => $tanggalPerpanjang,
            'tanggal_kadaluwarsa' => $tanggalKadaluwarsa,
            'status'              => 'pending',
        ]);

        return redirect('/members')->with(
            'pesan',
            'Perpanjangan berhasil disimpan dan menunggu pembayaran'
        );
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'foto'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama'           => 'required|string|max:255',
            'jenis_kelamin'  => 'required|in:L,P',
            'no_hp'          => 'required|digits_between:10,15',
            'email'          => 'nullable|email|unique:tb_member,email,' . $id,
            'alamat'         => 'required|string',
            'paket_id'       => 'required|exists:tb_paket,id',
            'tanggal_daftar' => 'required|date_format:d-m-Y',
            'tanggal_kadaluwarsa' => 'required|date_format:d-m-Y',
        ], [
            'foto.image'              => 'File harus berupa gambar.',
            'foto.mimes'              => 'Format gambar harus jpeg, png, atau jpg.',
            'foto.max'                => 'Ukuran gambar maksimal 2MB.',
            'nama.required'           => 'Nama wajib diisi',
            'jenis_kelamin.required'  => 'Jenis kelamin wajib diisi',
            'no_hp.required'          => 'Nomor Hp wajib diisi',
            'email.email'             => 'Format email tidak valid',
            'email.unique'            => 'Email sudah digunakan',
            'alamat.required'         => 'Alamat wajib diisi',
            'paket_id.required'       => 'Paket wajib dipilih',
            'tanggal_daftar.required' => 'Tanggal daftar wajib diisi',
            'tanggal_daftar.date_format'     => 'Format tanggal daftar tidak valid, gunakan dd-mm-yyyy',
            'tanggal_kadaluwarsa.required' => 'Tanggal kadaluwarsa wajib diisi',
            'tanggal_kadaluwarsa.date_format'     => 'Format tanggal kadaluwarsa tidak valid, gunakan dd-mm-yyyy',
        ]);

        // Handle foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($member->foto && file_exists(public_path('foto_member/' . $member->foto))) {
                unlink(public_path('foto_member/' . $member->foto));
            }
            $namaFile = Str::random(5) . '.' . $request->foto->extension();
            $request->foto->move(public_path('foto_member'), $namaFile);
        } else {
            $namaFile = $member->foto; // pakai foto lama
        }

        $tanggalDaftar = Carbon::createFromFormat('d-m-Y', $request->tanggal_daftar);
        $tanggalKadaluwarsa = Carbon::createFromFormat('d-m-Y', $request->tanggal_kadaluwarsa);

        $member->update([
            'foto'                => $namaFile,
            'nama'                => $request->nama,
            'jenis_kelamin'       => $request->jenis_kelamin,
            'no_hp'               => $request->no_hp,
            'email'               => $request->email,
            'alamat'              => $request->alamat,
            'paket_id'            => $request->paket_id,
            'tanggal_daftar'      => $tanggalDaftar,
            'tanggal_kadaluwarsa' => $tanggalKadaluwarsa,
        ]);

        return redirect('/members')->with('pesan', 'Data member berhasil diupdate');
    }

    public function destroy($id)
    {
        Member::findOrFail($id)->delete();
        return redirect('/members')->with('pesan', 'Data member berhasil dihapus');
    }
}
