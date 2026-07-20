@extends('layout.master')

@section('content')

{{-- ========================= HEADER ========================= --}}
<div class="card shadow-sm mb-4 bg-primary">
    <div class="card-body">
        <h5 class="fw-bold mb-2 text-white">
            <i class="bi bi-clipboard-data-fill me-2"></i>Detail Laporan Harian
        </h5>
        <p class="text-white small mb-0">
            {{ \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') }}
        </p>
    </div>
</div>

{{-- ========================= AUTO DATA ========================= --}}
<div class="row">
    <div class="col-md-3">
        <div class="card shadow-sm p-3 text-center border-start border-primary border-4">
            <dt class="text-muted small">Total Hadir</dt>
            <dd class="fw-bold fs-4 mb-0 text-primary">{{ $total }}</dd>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm p-3 text-center border-start border-success border-4">
            <dt class="text-muted small">Member Bulanan</dt>
            <dd class="fw-bold fs-4 mb-0 text-success">{{ $bulanan }}</dd>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm p-3 text-center border-start border-warning border-4">
            <dt class="text-muted small">Member Harian</dt>
            <dd class="fw-bold fs-4 mb-0 text-warning">{{ $harian }}</dd>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm p-3 text-center border-start border-danger border-4">
            <dt class="text-muted small">Member Baru</dt>
            <dd class="fw-bold fs-4 mb-0 text-danger">{{ $memberBaru }}</dd>
        </div>
    </div>
</div>

{{-- ========================= DETAIL LAPORAN ========================= --}}
<div class="row">

    {{-- OPERASIONAL --}}
    <div class="col-md-6">
        <div class="card p-3 mb-3 shadow-sm">
            <h5 class="mb-3">
                <i class="bi bi-gear-fill text-primary me-2"></i>Operasional
            </h5>
            <p><b>Jam Operasional:</b><br>
                <span class="text-muted">{{ $laporan->jam_operasional ?? '-' }}</span>
            </p>
            <p class="mb-0"><b>Petugas:</b><br>
                <span class="text-muted">{{ $laporan->petugas ?? '-' }}</span>
            </p>
        </div>
    </div>

    {{-- KEUANGAN --}}
    <div class="col-md-6">
        <div class="card p-3 mb-3 shadow-sm">
            <h5 class="mb-3">
                <i class="bi bi-cash-stack text-success me-2"></i>Keuangan
            </h5>
            <p><b>Pendapatan:</b><br>
                <span class="text-muted">Rp {{ number_format($laporan->pendapatan ?? 0) }}</span>
            </p>
            <p class="mb-0"><b>Penjualan Produk:</b><br>
                <span class="text-muted">Rp {{ number_format($laporan->penjualan_produk ?? 0) }}</span>
            </p>
        </div>
    </div>

    {{-- FASILITAS --}}
    <div class="col-md-6">
        <div class="card p-3 mb-3 shadow-sm">
            <h5 class="mb-3">
                <i class="bi bi-tools text-warning me-2"></i>Fasilitas
            </h5>
            <p><b>Kondisi Alat:</b><br>
                <span class="text-muted">{{ $laporan->kondisi_alat ?? '-' }}</span>
            </p>
            <p class="mb-0"><b>Kebersihan:</b><br>
                <span class="text-muted">{{ $laporan->kebersihan ?? '-' }}</span>
            </p>
        </div>
    </div>

    {{-- CATATAN --}}
    <div class="col-md-6">
        <div class="card p-3 mb-3 shadow-sm">
            <h5 class="mb-3">
                <i class="bi bi-journal-text text-danger me-2"></i>Catatan
            </h5>
            <p><b>Keluhan:</b><br>
                <span class="text-muted">{{ $laporan->keluhan ?? '-' }}</span>
            </p>
            <p><b>Insiden:</b><br>
                <span class="text-muted">{{ $laporan->insiden ?? '-' }}</span>
            </p>
            <p class="mb-0"><b>Tindak Lanjut:</b><br>
                <span class="text-muted">{{ $laporan->tindak_lanjut ?? '-' }}</span>
            </p>
        </div>
    </div>

</div>

{{-- ========================= TOMBOL AKSI ========================= --}}
<div class="d-flex justify-content-end gap-2 mt-3">
    <a href="{{ route('laporan.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left-circle-fill me-1"></i> Kembali
    </a>
    <a href="{{ route('laporan.edit', $laporan->id) }}" class="btn btn-warning">
        <i class="bi bi-pencil-square me-1"></i> Edit
    </a>
    <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST" class="d-inline">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger"
            onclick="return confirm('Yakin hapus laporan ini?')">
            <i class="bi bi-trash3-fill me-1"></i> Hapus
        </button>
    </form>
</div>

@endsection