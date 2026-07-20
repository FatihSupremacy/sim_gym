@extends('layout.master')

@section('content')
<style>
    .page-header {
        background-color: #FFFFFF;
        border-bottom: 1px solid #dee2e6;
    }

    #main>.page-content {
        padding-top: 0 !important;
    }
</style>

{{-- Alert Messages --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill me-2" aria-hidden="true"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup notifikasi"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-triangle-fill me-2" aria-hidden="true"></i>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup notifikasi"></button>
</div>
@endif

{{-- Page Header --}}
<div class="page-header card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body py-3 px-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">

            {{-- Judul --}}
            <div>
                <h1 class="h5 fw-bold mb-1" style="color: #0D6EFD;">Absensi Member</h1>
                <p class="text-secondary small mb-0">Halaman untuk mengelola absensi member</p>
            </div>

            {{-- Search --}}
            <form method="GET" action="/absen" role="search" class="d-flex gap-2">
                <label for="keyword" class="visually-hidden">Cari member</label>
                <div class="input-group">
                    <input
                        type="search"
                        id="keyword"
                        name="keyword"
                        value="{{ request('keyword') }}"
                        placeholder="Cari member..."
                        class="form-control form-control-sm"
                        aria-label="Cari member">
                    <button class="btn btn-primary btn-sm" type="submit" aria-label="Cari">
                        <i class="bi bi-search" aria-hidden="true"></i>
                    </button>
                </div>
                <a href="/absen" class="btn btn-outline-secondary btn-sm" role="button" aria-label="Reset pencarian">
                    <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                </a>
            </form>

        </div>
    </div>
</div>

{{-- Check-in Harian --}}
<div class="card shadow-sm border-primary mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h6 fw-semibold mb-1">Member Harian</h2>
                <p class="text-muted small mb-0">Absen untuk member harian</p>
            </div>
            <form action="{{ route('absen.harian') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success btn-sm rounded-2">
                    <i class="bi bi-person-check-fill me-1" aria-hidden="true"></i>
                    Check-in Harian
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Member List --}}
<section aria-label="Daftar member">
    <div class="row g-3">
        @forelse($members as $member)
        <div class="col-md-6">
            <article class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">

                    {{-- Avatar --}}
                    <div style="flex-shrink: 0;">
                        @if($member->foto && file_exists(public_path('foto_member/' . $member->foto)))
                        <img
                            src="{{ asset('foto_member/' . $member->foto) }}"
                            alt="Foto {{ $member->nama }}"
                            width="100" height="100"
                            class="rounded-circle object-fit-cover border">
                        @else
                        <div class="rounded-circle bg-secondary-subtle border text-center text-secondary"
                            style="width:100px; height:100px; line-height: 100px; font-size: 3rem;">
                            <i class="bi bi-person-fill" aria-hidden="true"></i>
                        </div>
                        @endif
                    </div>
                    {{-- Info Member --}}
                    <div class=" min-w-0">

                        {{-- Nama + Status --}}
                        <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                            <h3 class="h6 fw-semibold mb-0 text-truncate">{{ $member->nama }}</h3>
                            @if($member->status === 'aktif')
                            <span class="badge text-bg-success ">Aktif</span>
                            @elseif($member->status === 'pending')
                            <span class="badge text-bg-warning">Pending</span>
                            @else
                            <span class="badge text-bg-danger">Kadaluwarsa</span>
                            @endif
                        </div>

                        {{-- Detail --}}
                        <dl class="row row-cols-1 g-0 text-muted small mb-2">
                            <div class="col d-flex gap-1">
                                <dt class="fw-normal">Kode:</dt>
                                <dd class="fw-semibold text-body mb-0">{{ $member->kode_member }}</dd>
                            </div>
                            <div class="col d-flex gap-1">
                                <dt class="fw-normal">Paket:</dt>
                                <dd class="fw-semibold text-body mb-0">{{ $member->paket->nama_paket }}</dd>
                            </div>
                        </dl>

                        {{-- Tombol Check-in --}}
                        <form action="{{ route('absen.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="member_id" value="{{ $member->id }}">
                            @if($member->status !== 'aktif')
                            <button type="button" class="btn btn-warning btn-sm rounded-2 mt-2" disabled aria-disabled="true">
                                <i class="bi bi-hourglass-split me-1" aria-hidden="true"></i>
                                {{ $member->status === 'pending' ? 'Menunggu Pembayaran' : 'Membership Kadaluwarsa' }}
                            </button>
                            @elseif(in_array($member->id, $checkedInToday))
                            <button type="button" class="btn btn-secondary btn-sm rounded-2" disabled aria-disabled="true">
                                <i class="bi bi-check2-circle me-1" aria-hidden="true"></i>
                                Sudah Check-in
                            </button>
                            @else
                            <button type="submit" class="btn btn-success btn-sm rounded-2 mt-2">
                                <i class="bi bi-box-arrow-in-right me-1" aria-hidden="true"></i>
                                Check-in
                            </button>
                            @endif
                        </form>

                    </div>
                </div>
            </article>
        </div>
        @empty
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body text-center py-5 text-muted">
                    <i class="bi bi-people-fill mb-2" style="font-size: 2.5rem;" aria-hidden="true"></i>
                    <p class="mb-0">Tidak ada member ditemukan.</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</section>

{{-- Auto-dismiss alert --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => {
                bootstrap.Alert.getOrCreateInstance(el).close();
            });
        }, 3000);
    });
</script>

@endsection
