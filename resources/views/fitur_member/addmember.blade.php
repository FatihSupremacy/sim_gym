@extends('layout.master')

@section('content')
<section aria-labelledby="form-title">

    {{-- Card Header --}}
    <div class="card border-0 shadow-sm mb-0 rounded-bottom-0" style="background-color: #4f6ef7;">
        <div class="card-body py-3 px-4 d-flex align-items-center gap-3">
            <div class="rounded-2 bg-white bg-opacity-25 text-center text-white"
                style="width: 42px; height: 42px; line-height: 42px; font-size: 1.25rem;">
                <i class="bi bi-person-plus-fill" aria-hidden="true"></i>
            </div>
            <div>
                <h1 id="form-title" class="h5 fw-bold text-white mb-0">Tambah Data Member</h1>
                <p class="text-white-50 small mb-0">Isi form berikut untuk menambahkan member baru</p>
            </div>
        </div>
    </div>

    {{-- Card Body --}}
    <div class="card border-0 shadow-sm rounded-top-0">
        <div class="card-body p-4">
            <form action="/members" method="POST" enctype="multipart/form-data" novalidate>
                @csrf

                {{-- Foto Profil --}}
                <fieldset class="mb-4">
                    <legend class="text-uppercase small fw-semibold text-muted mb-3"
                        style="letter-spacing: .06em; font-size: .7rem;">
                        Foto Profil
                    </legend>
                    <div class="mb-2">
                        <label for="foto" class="form-label">Foto</label>
                        <input
                            type="file"
                            id="foto"
                            name="foto"
                            accept="image/*"
                            class="form-control @error('foto') is-invalid @enderror">
                        @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </fieldset>

                {{-- Informasi Pribadi --}}
                <fieldset class="mb-4">
                    <legend class="text-uppercase small fw-semibold text-muted mb-3"
                        style="letter-spacing: .06em; font-size: .7rem;">
                        Informasi Pribadi
                    </legend>
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                placeholder="Masukan nama lengkap"
                                value="{{ old('nama') }}"
                                class="form-control @error('nama') is-invalid @enderror">
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select
                                id="jenis_kelamin"
                                name="jenis_kelamin"
                                class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="no_hp" class="form-label">Nomor HP</label>
                            <input
                                type="tel"
                                id="no_hp"
                                name="no_hp"
                                placeholder="Masukan nomor handphone"
                                value="{{ old('no_hp') }}"
                                class="form-control @error('no_hp') is-invalid @enderror">
                            @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="Masukan email"
                                value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea
                                id="alamat"
                                name="alamat"
                                rows="3"
                                placeholder="Masukan alamat lengkap"
                                class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </fieldset>

                {{-- Data Membership --}}
                <fieldset class="mb-4">
                    <legend class="text-uppercase small fw-semibold text-muted mb-3"
                        style="letter-spacing: .06em; font-size: .7rem;">
                        Data Membership
                    </legend>
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="paket_id" class="form-label">Paket Membership</label>
                            <select
                                id="paket_id"
                                name="paket_id"
                                class="form-select @error('paket_id') is-invalid @enderror">
                                <option value="" disabled {{ old('paket_id') ? '' : 'selected' }}>Pilih Paket</option>
                                @foreach($paket as $p)
                                <option value="{{ $p->id }}" {{ old('paket_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_paket }}
                                </option>
                                @endforeach
                            </select>
                            @error('paket_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal_daftar" class="form-label">Tanggal Daftar</label>
                            <input
                                type="text"
                                id="tanggal_daftar"
                                name="tanggal_daftar"
                                placeholder="Masukan tanggal daftar (dd-mm-yyyy)"
                                value="{{ old('tanggal_daftar') }}"
                                class="form-control @error('tanggal_daftar') is-invalid @enderror">
                            @error('tanggal_daftar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal_kadaluwarsa" class="form-label">Tanggal Kadaluwarsa</label>
                            <input
                                type="text"
                                id="tanggal_kadaluwarsa"
                                name="tanggal_kadaluwarsa"
                                placeholder="Masukan tanggal kadaluwarsa (dd-mm-yyyy)"
                                value="{{ old('tanggal_kadaluwarsa') }}"
                                class="form-control @error('tanggal_kadaluwarsa') is-invalid @enderror"
                                required>
                            @error('tanggal_kadaluwarsa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </fieldset>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-end gap-2 pt-2">
                    <a href="/members" class="btn btn-danger rounded-2">
                        <i class="bi bi-x-circle-fill me-1" aria-hidden="true"></i> Batal
                    </a>
                    <button type="reset" class="btn btn-secondary rounded-2">
                        <i class="bi bi-arrow-counterclockwise me-1" aria-hidden="true"></i> Reset
                    </button>
                    <button type="submit" class="btn rounded-2 text-white" style="background-color: #4f6ef7;">
                        <i class="bi bi-plus-circle-fill me-1" aria-hidden="true"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

</section>
@endsection

@push('scripts')
@php
$paketJs = $paket->map(function ($p) {
return [
'id' => $p->id,
'durasi' => (int) $p->durasi,
'tipe_durasi' => $p->tipe_durasi,
];
})->values();
@endphp
<script>
    const PAKET_DB = @json($paketJs);

    const paketSelect = document.getElementById('paket_id');
    const tanggalDaftarInput = document.getElementById('tanggal_daftar');
    const tanggalKadaluwarsaInput = document.getElementById('tanggal_kadaluwarsa');

    const tanggalDaftarPicker = flatpickr("#tanggal_daftar", {
        dateFormat: "d-m-Y",
        allowInput: true,
        onChange: function() {
            recalculateTanggalKadaluwarsa();
        }
    });

    const tanggalKadaluwarsaPicker = flatpickr("#tanggal_kadaluwarsa", {
        dateFormat: "d-m-Y",
        allowInput: true,
    });

    function parseDmy(dateStr) {
        const match = /^(\d{2})-(\d{2})-(\d{4})$/.exec((dateStr || '').trim());
        if (!match) return null;

        const day = Number(match[1]);
        const month = Number(match[2]);
        const year = Number(match[3]);
        const d = new Date(year, month - 1, day);

        if (
            d.getFullYear() !== year ||
            d.getMonth() !== month - 1 ||
            d.getDate() !== day
        ) {
            return null;
        }

        return d;
    }

    function formatDmy(dateObj) {
        const day = String(dateObj.getDate()).padStart(2, '0');
        const month = String(dateObj.getMonth() + 1).padStart(2, '0');
        const year = dateObj.getFullYear();
        return `${day}-${month}-${year}`;
    }

    function addDuration(startDateStr, duration, tipeDurasi) {
        const startDate = parseDmy(startDateStr);
        if (!startDate) return '';

        const d = new Date(startDate.getTime());
        const amount = parseInt(duration, 10) || 0;
        const tipe = (tipeDurasi || '').toLowerCase();

        if (tipe === 'bulan') {
            d.setMonth(d.getMonth() + amount);
        } else {
            d.setDate(d.getDate() + amount);
        }

        return formatDmy(d);
    }

    function getTodayDmy() {
        return formatDmy(new Date());
    }

    function getSelectedPaket() {
        const paketId = paketSelect.value;
        return PAKET_DB.find(p => String(p.id) === String(paketId));
    }

    function ensureTanggalDaftar() {
        const existing = (tanggalDaftarInput.value || '').trim();
        if (parseDmy(existing)) return existing;

        const today = getTodayDmy();
        tanggalDaftarPicker.setDate(today, true, "d-m-Y");
        return today;
    }

    function recalculateTanggalKadaluwarsa() {
        const paket = getSelectedPaket();
        const startDate = (tanggalDaftarInput.value || '').trim();
        if (!paket || !parseDmy(startDate)) return;

        const endDate = addDuration(startDate, paket.durasi, paket.tipe_durasi);
        if (!endDate) return;

        tanggalKadaluwarsaPicker.setDate(endDate, true, "d-m-Y");
    }

    paketSelect.addEventListener('change', function() {
        if (!paketSelect.value) return;
        ensureTanggalDaftar();
        recalculateTanggalKadaluwarsa();
    });

    tanggalDaftarInput.addEventListener('change', recalculateTanggalKadaluwarsa);
    tanggalDaftarInput.addEventListener('blur', recalculateTanggalKadaluwarsa);

    if (paketSelect.value) {
        const hasTanggalDaftar = !!parseDmy((tanggalDaftarInput.value || '').trim());
        const hasTanggalKadaluwarsa = !!parseDmy((tanggalKadaluwarsaInput.value || '').trim());

        if (!hasTanggalDaftar) {
            ensureTanggalDaftar();
        }
        if (!hasTanggalKadaluwarsa) {
            recalculateTanggalKadaluwarsa();
        }
    }
</script>
@endpush