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

{{-- Page Header --}}
<div class="page-header card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body py-3 px-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h1 class="h5 fw-bold mb-1" style="color: #0D6EFD;">Laporan Harian</h1>
                <p class="text-secondary small mb-0">Kelola dan pantau laporan harian</p>
            </div>
            <a href="{{ route('laporan.create') }}" class="btn btn-danger d-inline-flex align-items-center gap-2 rounded-3" style="font-size:13px;" role="button">
                <i class="bi bi-plus-circle-fill" style="line-height:0;" aria-hidden="true"></i>
                Tambah Laporan
            </a>
        </div>
    </div>
</div>

{{-- Card Filter --}}
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('laporan.index') }}" class="d-flex gap-2">
            <label for="tanggal" class="visually-hidden">Filter Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" class="form-control form-control-sm" value="{{ request('tanggal') }}">
            <button type="submit" class="btn btn-primary btn-sm rounded-2">
                <i class="bi bi-search" aria-hidden="true"></i>
            </button>
            <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary btn-sm rounded-2" role="button" aria-label="Reset filter">
                <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
            </a>
        </form>
    </div>
</div>

<div class="row">
    @foreach($laporans as $laporan)
    <div class="col-md-4 mb-3">
        <div class="card p-3 shadow-sm">

            <p class="fw-bold mb-1">Laporan Harian</p>
            <p class="text-muted small">{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') }}</p>

            <div class="mt-3">
                <a href="{{ route('laporan.show', $laporan->id) }}" class="btn btn-sm btn-primary">
                    <i class=" me-1"></i>Detail
                </a>
                <a href="{{ route('laporan.edit', $laporan->id) }}" class="btn btn-sm btn-warning">
                    <i class="me-1"></i>Edit
                </a>
                <button type="button" class="btn btn-sm btn-danger"
                    data-bs-toggle="modal"
                    data-bs-target="#modalHapus"
                    data-id="{{ $laporan->id }}"
                    data-tanggal="{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') }}">
                    <i class="me-1"></i>Hapus
                </button>
            </div>

        </div>
    </div>
    @endforeach
</div>

{{-- ========================= MODAL HAPUS ========================= --}}
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 360px;">
        <div class="modal-content border-0" style="
            border-radius: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,.06), 0 8px 24px rgba(0,0,0,.12);
            padding: 32px 24px 24px;
        ">
            <form id="formHapus" method="POST">
                @csrf
                @method('DELETE')
                <div class="text-center">
                    <div class="mx-auto mb-4 d-flex align-items-center justify-content-center"
                        style="
                            width: 64px;
                            height: 64px;
                            border-radius: 50%;
                            background: rgba(239,68,68,.10);
                        ">
                        <i class="bi bi-trash d-flex align-items-center justify-content-center" style="font-size: 1.4rem; color: #EF4444; line-height: 1; transform: translateY(-1px);" aria-hidden="true"></i>
                    </div>
                    <h5 class="fw-bold mb-2" id="modalHapusLabel" style="font-size: 18px; color: #1F2937;">
                        Hapus Laporan
                    </h5>
                    <p class="mb-4" style="font-size: 14px; color: #6B7280; line-height: 1.5;">
                        Apakah anda yakin ingin menghapus laporan tanggal<br>
                        <strong id="tanggalLaporan" style="color: #1F2937;"></strong>?
                    </p>
                    <div class="d-flex gap-3">
                        <button type="button"
                            class="btn w-50 fw-semibold"
                            data-bs-dismiss="modal"
                            style="
                                height: 44px;
                                border-radius: 999px;
                                font-size: 14px;
                                background: #F3F4F6;
                                border: none;
                                color: #1F2937;
                            ">
                            Batal
                        </button>
                        <button type="submit"
                            class="btn w-50 fw-semibold text-white"
                            style="
                                height: 44px;
                                border-radius: 999px;
                                font-size: 14px;
                                background: #EF4444;
                                border: none;
                            ">
                            Hapus
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script Modal --}}
<script>
    const modalHapus = document.getElementById('modalHapus')
    modalHapus.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget
        const id = button.getAttribute('data-id')
        const tanggal = button.getAttribute('data-tanggal')

        document.getElementById('tanggalLaporan').textContent = tanggal
        document.getElementById('formHapus').action = `/laporan/${id}`
    })
</script>

@endsection
