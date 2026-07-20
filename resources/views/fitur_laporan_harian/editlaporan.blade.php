@extends('layout.master')

@section('content')

{{-- ========================= HEADER ========================= --}}
<div class="card shadow-sm mb-4 bg-primary">
    <div class="card-body">
        <h5 class="fw-bold mb-0 text-white">
            <i class="bi bi-pencil-square me-2"></i>Edit Laporan Harian
        </h5>
        <p class="text-white small mb-0">
            {{ \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') }}
        </p>
    </div>
</div>

<form action="{{ route('laporan.update', $laporan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">

        {{-- OPERASIONAL --}}
        <div class="col-md-6">
            <div class="card p-3 mb-3 shadow-sm">
                <h5 class="mb-3">
                    <i class="bi bi-gear-fill text-primary me-2"></i>Operasional
                </h5>

                <div class="mb-2">
                    <label for="jam_operasional">Jam Operasional</label>
                    <input type="text" id="jam_operasional" name="jam_operasional" class="form-control"
                        value="{{ old('jam_operasional', $laporan->jam_operasional) }}">
                </div>

                <div>
                    <label for="petugas">Petugas</label>
                    <input type="text" id="petugas" name="petugas" class="form-control"
                        value="{{ old('petugas', $laporan->petugas) }}">
                </div>
            </div>
        </div>

        {{-- KEUANGAN --}}
        <div class="col-md-6">
            <div class="card p-3 mb-3 shadow-sm">
                <h5 class="mb-3">
                    <i class="bi bi-cash-stack text-success me-2"></i>Keuangan
                </h5>

                <div class="mb-2">
                    <label for="pendapatan">Pendapatan</label>
                    <input type="number" id="pendapatan" name="pendapatan" class="form-control"
                        value="{{ old('pendapatan', $laporan->pendapatan) }}">
                </div>

                <div>
                    <label for="penjualan_produk">Penjualan Produk</label>
                    <input type="number" id="penjualan_produk" name="penjualan_produk" class="form-control"
                        value="{{ old('penjualan_produk', $laporan->penjualan_produk) }}">
                </div>
            </div>
        </div>

        {{-- FASILITAS --}}
        <div class="col-md-6">
            <div class="card p-3 mb-3 shadow-sm">
                <h5 class="mb-3">
                    <i class="bi bi-tools text-warning me-2"></i>Fasilitas
                </h5>

                <div class="mb-2">
                    <label for="kondisi_alat">Kondisi Alat</label>
                    <textarea id="kondisi_alat" name="kondisi_alat" class="form-control">{{ old('kondisi_alat', $laporan->kondisi_alat) }}</textarea>
                </div>

                <div>
                    <label for="kebersihan">Kebersihan</label>
                    <textarea id="kebersihan" name="kebersihan" class="form-control">{{ old('kebersihan', $laporan->kebersihan) }}</textarea>
                </div>
            </div>
        </div>

        {{-- CATATAN --}}
        <div class="col-md-6">
            <div class="card p-3 mb-3 shadow-sm">
                <h5 class="mb-3">
                    <i class="bi bi-journal-text text-danger me-2"></i>Catatan
                </h5>

                <div class="mb-2">
                    <label for="keluhan">Keluhan</label>
                    <textarea id="keluhan" name="keluhan" class="form-control">{{ old('keluhan', $laporan->keluhan) }}</textarea>
                </div>

                <div class="mb-2">
                    <label for="insiden">Insiden</label>
                    <textarea id="insiden" name="insiden" class="form-control">{{ old('insiden', $laporan->insiden) }}</textarea>
                </div>

                <div>
                    <label for="tindak_lanjut">Tindak Lanjut</label>
                    <textarea id="tindak_lanjut" name="tindak_lanjut" class="form-control">{{ old('tindak_lanjut', $laporan->tindak_lanjut) }}</textarea>
                </div>
            </div>
        </div>

    </div>

    {{-- BUTTON --}}
    <div class="d-flex justify-content-end gap-2 mt-2">
        <a href="{{ route('laporan.index') }}" class="btn btn-danger">
            <i class="bi bi-x-circle-fill me-1"></i> Batal
        </a>
        <button type="reset" class="btn btn-secondary">
            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
        </button>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save-fill me-1"></i> Simpan
        </button>
    </div>

</form>

@endsection