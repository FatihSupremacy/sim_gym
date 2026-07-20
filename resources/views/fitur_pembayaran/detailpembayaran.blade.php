@extends('layout.master')

@section('content')
<main class="container py-4" style="max-width:860px;">

    {{-- Header --}}
    <header class="card border rounded-3 shadow-none p-4 mb-4" aria-label="Header halaman">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('pembayaran.index') }}"
                class="btn btn-sm btn-danger flex-shrink-0">
                <i class="bi bi-arrow-left-circle"></i>
                Kembali
            </a>
            <div>
                <h1 class="h5 mb-1">Detail pembayaran</h1>
                <p class="text-secondary mb-0" style="font-size:13px;">
                    Informasi transaksi pembayaran member
                </p>
            </div>
        </div>
    </header>

    {{-- Kartu utama --}}
    <section class="card border rounded-3 shadow-none p-4" aria-label="Informasi transaksi">

        <p class="text-uppercase text-secondary fw-semibold mb-3"
            style="font-size:11px; letter-spacing:.06em;">Informasi transaksi</p>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label text-secondary mb-1" style="font-size:12px;">ID transaksi</label>
                <div class="fw-semibold font-monospace" style="font-size:13px;">
                    {{ $pembayaran->id_transaksi ?? 'TRX-' . str_pad($pembayaran->id, 6, '0', STR_PAD_LEFT) }}
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label text-secondary mb-1" style="font-size:12px;">Tanggal</label>
                <div class="fw-semibold">
                    {{ $pembayaran->created_at?->translatedFormat('d M Y') ?? '-' }}
                </div>
            </div>
        </div>

        <hr class="my-3">

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label text-secondary mb-1" style="font-size:12px;">Member</label>
                <div class="fw-semibold">{{ $pembayaran->member->nama ?? '-' }}</div>
                <div class="text-secondary" style="font-size:12px;">
                    {{ $pembayaran->member->kode_member ?? '-' }}
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label text-secondary mb-1" style="font-size:12px;">Paket</label>
                <div class="fw-semibold">{{ $pembayaran->paket->nama_paket ?? '-' }}</div>
            </div>
        </div>

        <hr class="my-3">

        <div class="row g-3 align-items-start">
            <div class="col-md-4">
                <label class="form-label text-secondary mb-1" style="font-size:12px;">Nominal</label>
                <div class="fw-semibold" style="font-size:15px;">
                    Rp {{ number_format($pembayaran->nominal ?? 0, 0, ',', '.') }}
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label text-secondary mb-1" style="font-size:12px;">Metode pembayaran</label>
                <div class="fw-semibold">
                    {{ $pembayaran->metode_detail ?? ucfirst($pembayaran->metode ?? '-') }}
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label d-block text-secondary mb-1" style="font-size:12px;">Status</label>
                @php $status = $pembayaran->status ?? ''; @endphp
                @if($status === 'berhasil')
                <span class="badge rounded-pill bg-success-subtle text-success fw-semibold px-3 py-1">
                    ● Berhasil
                </span>
                @elseif($status === 'pending')
                <span class="badge rounded-pill bg-warning-subtle text-warning fw-semibold px-3 py-1">
                    ● Pending
                </span>
                @else
                <span class="badge rounded-pill bg-danger-subtle text-danger fw-semibold px-3 py-1">
                    ● Ditolak
                </span>
                @endif
            </div>
        </div>

        <hr class="my-3">

        {{-- Bukti pembayaran --}}
        <div>
            <label class="form-label d-block text-secondary mb-2" style="font-size:12px;">
                Bukti pembayaran:
            </label>

            @if($pembayaran->bukti)
            @php
            $ext = strtolower(pathinfo($pembayaran->bukti, PATHINFO_EXTENSION));
            $isImage = in_array($ext, ['jpg','jpeg','png','webp']);
            $isPdf = $ext === 'pdf';
            $buktiUrl = route('pembayaran.bukti', $pembayaran->id);
            @endphp

            <button
                type="button"
                class="btn btn-sm btn-outline-primary"
                data-bs-toggle="collapse"
                data-bs-target="#bukti-preview"
                aria-expanded="false"
                aria-controls="bukti-preview">
                Lihat bukti pembayaran
            </button>

            <div id="bukti-preview" class="collapse mt-3">
                @if($isImage)
                <img src="{{ $buktiUrl }}"
                    alt="Bukti pembayaran"
                    class="img-fluid rounded border"
                    style="max-height:480px; object-fit:contain;">
                @elseif($isPdf)
                <iframe src="{{ $buktiUrl }}"
                    class="w-100 rounded border"
                    style="height:520px;"
                    title="Preview bukti pembayaran"></iframe>
                @else
                <a href="{{ $buktiUrl }}" target="_blank" rel="noopener"
                    class="btn btn-sm btn-outline-secondary">
                    Buka file bukti pembayaran
                </a>
                @endif
            </div>

            @else
            <div>
                <div class="text-danger fw-semibold" style="font-size:13px;">Belum ada bukti</div>
            </div>
            @endif
        </div>

    </section>

</main>
@endsection
