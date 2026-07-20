@extends('layout.master')

@section('content')
<style>
    .member-avatar {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .member-avatar-placeholder {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #EEF2FF;
        flex-shrink: 0;
    }

    /* ── Table ── */
    .member-table {
        font-size: 13px;
    }

    .member-table> :not(caption)>*>* {
        vertical-align: middle;
    }

    .member-table thead th {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .05em;
        color: #9CA3AF;
        background: #F9FAFB;
        border-bottom: 1px solid #F3F4F6;
        padding: 10px 14px;
        white-space: nowrap;
    }

    .member-table thead th:first-child {
        padding-left: 20px;
        padding-right: 4px;
    }

    .member-table thead th:nth-child(2) {
        text-align: center;
    }

    .member-table thead th:last-child {
        padding-right: 16px;
        text-align: center;
    }

    .member-table tbody td {
        font-size: 13px;
        padding: 10px 14px;
        border-bottom: 1px solid #F3F4F6;
        color: #374151;
    }

    .member-table tbody td:first-child {
        padding-left: 20px;
        padding-right: 4px;
    }

    .member-table tbody td:nth-child(2) {
        padding-left: 24px;
    }

    .member-table thead th:nth-child(5),
    .member-table tbody td:nth-child(5) {
        padding-left: 2px;
    }

    .member-table tbody td:last-child {
        padding-right: 16px;
        text-align: center;
    }

    .member-table tbody tr:last-child td {
        border-bottom: none;
    }

    .member-table tbody tr:hover {
        background: #FAFBFF;
    }

    /* ── Member Cell ── */
    .m-name {
        font-weight: 600;
        color: #1F2937;
        font-size: 13.5px;
        line-height: 1.25;
    }

    .m-sub {
        font-size: 11.5px;
        color: #9CA3AF;
        line-height: 1.35;
        max-width: 180px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .m-sub .sep {
        margin: 0 5px;
        opacity: .5;
    }

    .m-email {
        font-size: 11.5px;
        color: #9CA3AF;
        line-height: 1.35;
        max-width: 180px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* ── Badge Gender ── */
    .badge-gender {
        font-size: 11px;
        font-weight: 600;
        padding: 3px 9px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        white-space: nowrap;
    }

    .badge-gender i {
        font-size: 11px;
    }

    /* ── Badge Status ── */
    .badge-status {
        font-size: 10.5px;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        white-space: nowrap;
    }

    .badge-status .dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
    }

    /* ── Address ── */
    .addr-text {
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #6B7280;
        font-size: 12.5px;
    }

    /* ── Membership Cell ── */
    .m-paket {
        font-weight: 600;
        color: #1F2937;
        font-size: 13px;
        line-height: 1.3;
    }

    .m-date {
        font-size: 11.5px;
        color: #9CA3AF;
        line-height: 1.3;
    }

    /* ── Aksi Button ── */
    .btn-aksi {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        font-size: 15px;
        color: #9CA3AF;
        background: transparent;
        border: 1px solid transparent;
        transition: all .15s ease;
        cursor: pointer;
    }

    .btn-aksi:hover {
        background: #F3F4F6;
        color: #374151;
        border-color: #E5E7EB;
    }

    .dropdown-aksi .dropdown-item {
        font-size: 13px;
        padding: 7px 12px;
        border-radius: 6px;
    }

    .dropdown-aksi .dropdown-item i {
        font-size: 14px;
        width: 18px;
    }

    /* ── Page Header ── */
    .page-header {
        background-color: #FFFFFF;
        border-bottom: 1px solid #dee2e6;
    }

    #main>.page-content {
        padding-top: 0 !important;
    }

    .page-header .btn-warning {
        background-color: #0D6EFD;
        border-color: #0D6EFD;
        color: #fff;
    }

    .page-header .btn-warning:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }

    /* ── KPI Card ── */
    .kpi-card {
        background: #fff;
        border: 1px solid #E5E7EB;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .kpi-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        flex-shrink: 0;
    }

    .kpi-icon i {
        line-height: 0;
        display: block;
        font-size: 1.1rem;
    }

    .kpi-badge {
        font-size: 11px;
        font-weight: 600;
        padding: 3px 9px;
        border-radius: 999px;
        white-space: nowrap;
    }

    .badge-soft-primary {
        background: rgba(13, 110, 253, .10);
        color: #0d6efd;
    }

    .badge-soft-success {
        background: rgba(34, 197, 94, .12);
        color: #16a34a;
    }

    .badge-soft-warning {
        background: rgba(245, 158, 11, .15);
        color: #b45309;
    }

    .badge-soft-danger {
        background: rgba(239, 68, 68, .12);
        color: #dc2626;
    }
</style>

<main class="container-fluid pt-0 pb-3 px-4" aria-label="Halaman daftar member">

    {{-- ── Page Header ── --}}
    <div class="page-header card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body py-3 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h1 class="h5 fw-bold mb-1" style="color: #0D6EFD;">Daftar Member</h1>
                    <p class="text-secondary small mb-0">Kelola seluruh data member yang terdaftar</p>
                </div>
                <a href="members/create" class="btn btn-danger d-inline-flex align-items-center gap-2 rounded-3" style="font-size:13px;" aria-label="Tambah member baru">
                    <i class="bi bi-person-plus-fill" style="line-height:0;" aria-hidden="true"></i>
                    Tambah Member
                </a>
            </div>
        </div>
    </div>

    {{-- ── KPI Cards ── --}}
    <section aria-label="Ringkasan statistik member" class="mb-4">
        <div class="row g-3">

            {{-- Total Member --}}
            <div class="col-12 col-sm-6 col-xl-4 col-xxl-2">
                <div class="kpi-card h-100 p-3">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="kpi-icon bg-primary bg-opacity-10 d-flex align-items-center justify-content-center">
                            <i class="bi bi-people-fill text-primary"></i>
                        </div>
                        <span class="kpi-badge badge-soft-primary">Total</span>
                    </div>
                    <p class="mb-1 text-uppercase fw-semibold" style="font-size:10.5px;letter-spacing:.07em;color:#6B7280">Total Member</p>
                    <p class="mb-0 fw-bold lh-1" style="font-size:1.5rem;color:#1F2937">{{ $totalMember }}</p>
                </div>
            </div>

            {{-- Aktif --}}
            <div class="col-12 col-sm-6 col-xl-4 col-xxl-2">
                <div class="kpi-card h-100 p-3">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="kpi-icon bg-success bg-opacity-10 d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-check-fill text-success"></i>
                        </div>
                        <span class="kpi-badge badge-soft-success">Aktif</span>
                    </div>
                    <p class="mb-1 text-uppercase fw-semibold" style="font-size:10.5px;letter-spacing:.07em;color:#6B7280">Member Aktif</p>
                    <p class="mb-0 fw-bold lh-1" style="font-size:1.5rem;color:#22C55E">{{ $memberAktif }}</p>
                </div>
            </div>

            {{-- Pending --}}
            <div class="col-12 col-sm-6 col-xl-4 col-xxl-2">
                <div class="kpi-card h-100 p-3">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="kpi-icon bg-warning bg-opacity-10 d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-dash-fill text-warning"></i>
                        </div>
                        <span class="kpi-badge badge-soft-warning">Pending</span>
                    </div>
                    <p class="mb-1 text-uppercase fw-semibold" style="font-size:10.5px;letter-spacing:.07em;color:#6B7280">Menunggu Pembayaran</p>
                    <p class="mb-0 fw-bold lh-1" style="font-size:1.5rem;color:#F59E0B">{{ $memberPending }}</p>
                </div>
            </div>

            {{-- Kadaluwarsa --}}
            <div class="col-12 col-sm-6 col-xl-4 col-xxl-2">
                <div class="kpi-card h-100 p-3">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="kpi-icon bg-danger bg-opacity-10 d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-x-fill text-danger"></i>
                        </div>
                        <span class="kpi-badge badge-soft-danger">Expired</span>
                    </div>
                    <p class="mb-1 text-uppercase fw-semibold" style="font-size:10.5px;letter-spacing:.07em;color:#6B7280">Kadaluwarsa</p>
                    <p class="mb-0 fw-bold lh-1" style="font-size:1.5rem;color:#EF4444">{{ $memberKadaluwarsa }}</p>
                </div>
            </div>

        </div>
    </section>

    {{-- ── Toolbar ── --}}
    <section aria-label="Filter dan pencarian member" class="mb-4">
        <div class="card border shadow-sm rounded-4">
            <div class="card-body py-3 px-5">
                <div class="d-flex align-items-end flex-wrap gap-4">

                    {{-- Sort --}}
                    <div>
                        <label class="text-uppercase text-secondary fw-semibold d-block mb-1" style="font-size:10px; letter-spacing:.07em;">Sortir Data</label>
                        <div class="dropdown">
                            <button class="btn btn-light border dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"
                                style="min-width:160px; font-size:14px;">
                                @if($sort === 'terbaru') Member Terbaru
                                @elseif($sort === 'terlama') Member Terlama
                                @elseif($sort === 'kadaluwarsa') Akan Kadaluwarsa
                                @else Pilih Sortir
                                @endif
                            </button>
                            <ul class="dropdown-menu shadow-sm border rounded-3" style="font-size:13px;">
                                <li><a class="dropdown-item rounded-2 {{ $sort === 'terbaru' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['sort' => 'terbaru']) }}">Member Terbaru</a></li>
                                <li><a class="dropdown-item rounded-2 {{ $sort === 'terlama' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['sort' => 'terlama']) }}">Member Terlama</a></li>
                                <li><a class="dropdown-item rounded-2 {{ $sort === 'kadaluwarsa' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['sort' => 'kadaluwarsa']) }}">Akan Kadaluwarsa</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item rounded-2 text-danger" href="{{ request()->fullUrlWithQuery(['sort' => null]) }}">Reset Sortir</a></li>
                            </ul>
                        </div>
                    </div>

                    {{-- Filter Status --}}
                    <div>
                        <label class="text-uppercase text-secondary fw-semibold d-block mb-1" style="font-size:10px; letter-spacing:.07em;">Filter Status</label>
                        <div class="dropdown">
                            <button class="btn btn-light border dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"
                                style="min-width:160px; font-size:14px;">
                                @if($status === 'aktif') Aktif
                                @elseif($status === 'pending') Pending
                                @elseif($status === 'kadaluwarsa') Kadaluwarsa
                                @else Semua Status
                                @endif
                            </button>
                            <ul class="dropdown-menu shadow-sm border rounded-3" style="font-size:13px;">
                                <li><a class="dropdown-item rounded-2 {{ $status === 'aktif' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['status' => 'aktif']) }}">Aktif</a></li>
                                <li><a class="dropdown-item rounded-2 {{ $status === 'pending' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}">Pending</a></li>
                                <li><a class="dropdown-item rounded-2 {{ $status === 'kadaluwarsa' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['status' => 'kadaluwarsa']) }}">Kadaluwarsa</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item rounded-2 text-danger" href="{{ request()->fullUrlWithQuery(['status' => null]) }}">Reset Filter</a></li>
                            </ul>
                        </div>
                    </div>

                    {{-- Rentang Tanggal --}}
                    <div>
                        <label class="text-uppercase text-secondary fw-semibold d-block mb-1" style="font-size:10px; letter-spacing:.07em;">Rentang Tanggal</label>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="text" id="dateRange" class="form-control" style="max-width:200px; font-size:14px;"
                                placeholder="Pilih tanggal"
                                value="{{ $tanggalDari ? ($tanggalDari . ($tanggalSampai ? ' sampai ' . $tanggalSampai : '')) : '' }}">
                            <button type="button" id="btnApplyDate" class="btn btn-primary" style="font-size:14px;">Cari</button>
                            <a href="/members" class="btn btn-outline-secondary btn-sm" role="button" aria-label="Reset pencarian">
                                <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                            </a>
                        </div>
                        <input type="hidden" id="inputDari" name="tanggal_dari" value="{{ $tanggalDari }}">
                        <input type="hidden" id="inputSampai" name="tanggal_sampai" value="{{ $tanggalSampai }}">
                    </div>

                    {{-- Cari Data --}}
                    <div>
                        <label class="text-uppercase text-secondary fw-semibold d-block mb-1" style="font-size:10px; letter-spacing:.07em;">Cari Data</label>
                        <form method="GET" action="/members" role="search" aria-label="Cari member">
                            <div class="d-flex gap-2">
                                <input type="text" class="form-control" name="keyword"
                                    value="{{ request('keyword') }}"
                                    placeholder="Nama, email, kode..."
                                    style="max-width:200px; font-size:14px;"
                                    aria-label="Kata kunci pencarian">
                                <button type="submit" class="btn btn-primary" style="font-size:14px;">Cari</button>
                                <a href="/members" class="btn btn-outline-secondary btn-sm" role="button" aria-label="Reset pencarian">
                                    <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                                </a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- ── Table ── --}}
    <section aria-label="Tabel data member">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table member-table table-borderless align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width:36px;">No</th>
                            <th style="width:220px;">Member</th>
                            <th style="width:110px;">Jenis Kelamin</th>
                            <th style="width:150px;">Alamat</th>
                            <th style="width:110px;">Tgl Daftar</th>
                            <th style="width:120px;">Membership</th>
                            <th style="width:48px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_member as $item)
                        <tr>
                            {{-- No --}}
                            <td class="text-secondary" style="font-size:12px;">{{ $loop->iteration }}</td>

                            {{-- Member --}}
                            <td>
                                <div class="d-flex align-items-start gap-2">
                                    @if($item->foto)
                                    <img src="{{ asset('foto_member/' . $item->foto) }}" alt="Foto {{ $item->nama }}" class="member-avatar">
                                    @else
                                    <div class="member-avatar-placeholder" aria-hidden="true">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="#a5b4fc">
                                            <circle cx="12" cy="8" r="4" />
                                            <path d="M20 21a8 8 0 1 0-16 0" />
                                        </svg>
                                    </div>
                                    @endif
                                    <div class="d-flex flex-column" style="gap:1px;">
                                        <span class="m-name">{{ $item->nama }}</span>
                                        <span class="m-sub">{{ $item->kode_member }}<span class="sep">&bull;</span>{{ $item->no_hp }}</span>
                                        <span class="m-email">{{ $item->email }}</span>
                                    </div>
                                </div>
                            </td>

                            {{-- Jenis Kelamin --}}
                            <td>
                                @if($item->jenis_kelamin === 'L')
                                <span class="badge-gender" style="background:rgba(13,110,253,.08);color:#0D6EFD;">
                                    <i class="bi bi-gender-male"></i>Laki-laki
                                </span>
                                @else
                                <span class="badge-gender" style="background:#FDF2F8;color:#9D174D;">
                                    <i class="bi bi-gender-female"></i>Perempuan
                                </span>
                                @endif
                            </td>

                            {{-- Alamat --}}
                            <td>
                                <div class="addr-text" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $item->alamat }}">{{ $item->alamat }}</div>
                            </td>

                            {{-- Tgl Daftar --}}
                            <td style="font-size:12.5px;color:#6B7280;">{{ $item->tanggal_daftar->day . ' ' . ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'][$item->tanggal_daftar->month - 1] . ' ' . $item->tanggal_daftar->year }}</td>

                            {{-- Membership --}}
                            <td>
                                <div class="d-flex flex-column" style="gap:2px;">
                                    <span class="m-paket">{{ $item->paket->nama_paket ?? '-' }}</span>
                                    @if($item->status === 'aktif')
                                    <span class="badge-status" style="background:rgba(34,197,94,.10);color:#16A34A;width:fit-content;">
                                        <span class="dot" style="background:#16A34A;"></span>Aktif
                                    </span>
                                    @elseif($item->status === 'pending')
                                    <span class="badge-status" style="background:rgba(245,158,11,.12);color:#D97706;width:fit-content;">
                                        <span class="dot" style="background:#F59E0B;"></span>Pending
                                    </span>
                                    @else
                                    <span class="badge-status" style="background:rgba(239,68,68,.10);color:#DC2626;width:fit-content;">
                                        <span class="dot" style="background:#DC2626;"></span>Kadaluwarsa
                                    </span>
                                    @endif
                                </div>
                            </td>

                            {{-- Aksi --}}
                            <td>
                                <div class="dropdown dropdown-aksi d-flex justify-content-center">
                                    <button type="button" class="btn-aksi" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Aksi untuk {{ $item->nama }}">
                                        <i class="bi bi-three-dots-vertical" style="line-height:1;" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 py-2 px-2" style="min-width:160px;">
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2" href="/members/{{ $item->id }}">
                                                <i class="bi bi-eye text-primary" style="font-size:14px;width:18px;line-height:1;" aria-hidden="true"></i> Detail
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2" href="/members/{{ $item->id }}/edit">
                                                <i class="bi bi-pencil text-secondary" style="font-size:14px;width:18px;line-height:1;" aria-hidden="true"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2 text-success" href="/members/{{ $item->id }}/perpanjang">
                                                <i class="bi bi-arrow-repeat" style="font-size:14px;width:18px;line-height:1;" aria-hidden="true"></i> Perpanjang
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li>
                                            <button type="button" class="dropdown-item d-flex align-items-center gap-2 text-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $item->id }}">
                                                <i class="bi bi-trash" style="font-size:14px;width:18px;line-height:1;" aria-hidden="true"></i> Hapus
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-secondary">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mb-2 d-block mx-auto opacity-50" aria-hidden="true">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="M21 21l-4.35-4.35" />
                                </svg>
                                <p class="mb-0" style="font-size:14px;">Data yang anda cari tidak ditemukan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</main>

{{-- ── Modal Hapus ── --}}
@foreach($data_member as $item)
<div class="modal fade" id="hapus{{ $item->id }}" tabindex="-1" aria-labelledby="hapusLabel{{ $item->id }}" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 360px;">
        <div class="modal-content border-0" style="
            border-radius: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,.06), 0 8px 24px rgba(0,0,0,.12);
            padding: 32px 24px 24px;
        ">
            <form action="/members/{{ $item->id }}" method="POST">
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
                        <i class="bi bi-trash d-flex align-items-center justify-content-center" style="font-size: 1.4rem; color: #EF4444; line-height: 1; transform: translateY(-1px);"></i>
                    </div>
                    <h5 class="fw-bold mb-2" style="font-size: 18px; color: #1F2937;">
                        Hapus Member
                    </h5>
                    <p class="mb-4" style="font-size: 14px; color: #6B7280; line-height: 1.5;">
                        Apakah anda yakin ingin menghapus data<br>
                        <strong style="color: #1F2937;">{{ $item->nama }}</strong>?
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
@endforeach

@push('scripts')
<script>
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));

    flatpickr("#dateRange", {
        mode: "range",
        dateFormat: "d/m/Y",
        locale: {
            rangeSeparator: " sampai "
        },
        onClose: function(selectedDates) {
            const pad = n => String(n).padStart(2, '0');
            const fmt = d => `${pad(d.getDate())}/${pad(d.getMonth()+1)}/${d.getFullYear()}`;
            if (selectedDates.length >= 1) document.getElementById('inputDari').value = fmt(selectedDates[0]);
            if (selectedDates.length === 2) document.getElementById('inputSampai').value = fmt(selectedDates[1]);
            else document.getElementById('inputSampai').value = '';
        }
    });

    document.getElementById('btnApplyDate').addEventListener('click', function() {
        const dari = document.getElementById('inputDari').value;
        const sampai = document.getElementById('inputSampai').value;
        if (!dari) {
            alert('Pilih tanggal terlebih dahulu!');
            return;
        }
        const url = new URL(window.location.href);
        url.searchParams.set('tanggal_dari', dari);
        sampai ? url.searchParams.set('tanggal_sampai', sampai) : url.searchParams.delete('tanggal_sampai');
        window.location.href = url.toString();
    });

    // Teleport dropdown agar tidak terpotong tabel
    document.querySelectorAll('.table-responsive .dropdown').forEach(function(dropdown) {
        const toggle = dropdown.querySelector('[data-bs-toggle="dropdown"]');
        const menu = dropdown.querySelector('.dropdown-menu');
        if (!toggle || !menu) return;

        document.body.appendChild(menu);
        menu.style.position = 'fixed';
        menu.style.display = 'none';
        menu.style.zIndex = '9999';
        menu.setAttribute('data-teleported', 'true');

        toggle.addEventListener('click', function(e) {
            e.stopPropagation();
            document.querySelectorAll('.dropdown-menu[data-teleported]').forEach(m => {
                m.style.display = 'none';
            });
            const isVisible = menu.dataset.open === 'true';
            if (isVisible) {
                menu.dataset.open = 'false';
                menu.style.display = 'none';
                return;
            }
            menu.style.visibility = 'hidden';
            menu.style.display = 'block';
            menu.dataset.open = 'true';

            const rect = toggle.getBoundingClientRect();
            const menuWidth = menu.offsetWidth;
            const menuHeight = menu.offsetHeight;

            let leftPos = rect.right - menuWidth;
            if (leftPos < 8) leftPos = 8;
            if (leftPos + menuWidth > window.innerWidth - 8) leftPos = window.innerWidth - menuWidth - 8;

            let topPos = rect.bottom + 4;
            if (topPos + menuHeight > window.innerHeight - 8) topPos = rect.top - menuHeight - 4;

            menu.style.left = leftPos + 'px';
            menu.style.top = topPos + 'px';
            menu.style.visibility = 'visible';
        });
    });

    document.addEventListener('click', function() {
        document.querySelectorAll('.dropdown-menu[data-teleported]').forEach(m => {
            m.style.display = 'none';
            m.dataset.open = 'false';
        });
    });
</script>
@endpush

@endsection
