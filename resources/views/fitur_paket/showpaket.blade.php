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

    .paket-table {
        font-size: 13px;
    }

    .paket-table> :not(caption)>*>* {
        vertical-align: middle;
    }

    .paket-table thead th {
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

    .paket-table thead th:first-child {
        padding-left: 20px;
        padding-right: 4px;
    }

    .paket-table thead th:nth-child(2) {
        text-align: center;
    }

    .paket-table thead th:last-child {
        padding-right: 16px;
        text-align: center;
    }

    .paket-table tbody td {
        font-size: 13px;
        padding: 10px 14px;
        border-bottom: 1px solid #F3F4F6;
        color: #374151;
    }

    .paket-table tbody td:first-child {
        padding-left: 20px;
        padding-right: 4px;
    }

    .paket-table tbody td:nth-child(2) {
        padding-left: 24px;
    }

    .paket-table tbody td:last-child {
        padding-right: 16px;
        text-align: center;
    }

    .paket-table tbody tr:last-child td {
        border-bottom: none;
    }

    .paket-table tbody tr:hover {
        background: #FAFBFF;
    }

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

    .addr-text {
        max-width: 220px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #6B7280;
        font-size: 12.5px;
    }

    .m-paket {
        font-weight: 600;
        color: #1F2937;
        font-size: 13px;
        line-height: 1.3;
    }

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

    .dropdown-aksi .dropdown-menu {
        min-width: 150px;
    }
</style>

<section id="daftar-paket" aria-labelledby="page-title">

    {{-- Page Header --}}
    <div class="page-header card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body py-3 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h1 class="h5 fw-bold mb-1" style="color: #0D6EFD;">Paket Membership</h1>
                    <p class="text-secondary small mb-0">Kelola paket membership gym</p>
                </div>
                <a href="/paket/create" class="btn btn-danger d-inline-flex align-items-center gap-2 rounded-3" style="font-size:13px;" role="button">
                    <i class="bi bi-plus-circle-fill" style="line-height: 1;" aria-hidden="true"></i> Tambah Paket
                </a>
            </div>
        </div>
    </div>

    {{-- Alert Session --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-2" role="alert">
        <i class="bi bi-check-circle-fill me-2" aria-hidden="true"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup notifikasi"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-2" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2" aria-hidden="true"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup notifikasi"></button>
    </div>
    @endif

    {{-- Card Pencarian (terpisah) --}}
    <div class="card border-0 shadow-sm rounded-3 mb-3">
        <div class="card-body py-3 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <span class="fw-medium text-body-secondary small">
                    Total Paket:
                    <span class="badge text-bg-success rounded-2 ms-1">{{ $paket->count() }}</span>
                </span>
                <form method="GET" action="/paket" role="search" class="d-flex gap-2">
                    <label for="keyword" class="visually-hidden">Cari paket</label>
                    <input type="search"
                        id="keyword"
                        class="form-control form-control-sm rounded-2"
                        name="keyword"
                        value="{{ request('keyword') }}"
                        placeholder="Cari paket..."
                        style="width: 220px;"
                        aria-label="Cari paket membership">
                    <button type="submit" class="btn btn-primary btn-sm rounded-2">
                        <i class="bi bi-search" aria-hidden="true"></i>
                    </button>
                    <a href="/paket" class="btn btn-outline-secondary btn-sm rounded-2" role="button" aria-label="Reset pencarian">
                        <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                    </a>
                </form>
            </div>
        </div>
    </div>

    {{-- Card Tabel (terpisah) --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table paket-table table-borderless align-middle mb-0"
                aria-label="Tabel daftar paket membership">
                <thead>
                    <tr>
                        <th scope="col" style="width: 50px;">No</th>
                        <th scope="col">Nama Paket</th>
                        <th scope="col">Durasi</th>
                        <th scope="col">Harga</th>
                        <th scope="col" style="min-width: 160px;">Deskripsi</th>
                        <th scope="col" style="width: 80px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($paket as $item)
                    <tr>
                        <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                        <td>
                            <div class="m-name">{{ $item->nama_paket }}</div>
                            <div class="m-sub">Paket membership</div>
                        </td>
                        <td>
                            <span class="badge-status" style="background: rgba(13, 110, 253, .08); color: #0D6EFD;">
                                <span class="dot" style="background: #0D6EFD;"></span>
                                {{ $item->durasi }} {{ ucfirst($item->tipe_durasi) }}
                            </span>
                        </td>
                        <td>
                            <span class="m-paket">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            <div class="addr-text">
                                {{ $item->deskripsi ?? '-' }}
                            </div>
                        </td>
                        <td>
                            <div class="dropdown dropdown-aksi">
                                <button type="button"
                                    class="btn-aksi"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    aria-haspopup="true"
                                    aria-label="Menu aksi paket {{ $item->nama_paket }}">
                                    <i class="bi bi-three-dots-vertical" style="line-height: 1;" aria-hidden="true"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 py-2 px-2">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2" href="/paket/{{ $item->id }}/edit">
                                            <i class="bi bi-pencil-fill text-primary" style="line-height: 1;" aria-hidden="true"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider my-1">
                                    </li>
                                    <li>
                                        <button type="button"
                                            class="dropdown-item d-flex align-items-center gap-2 text-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#hapus{{ $item->id }}">
                                            <i class="bi bi-trash-fill" style="line-height: 1;" aria-hidden="true"></i> Hapus
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-body-secondary">
                            <i class="bi bi-inbox fs-4 d-block mb-2" aria-hidden="true"></i>
                            Tidak ada data paket yang tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(method_exists($paket, 'links'))
        <div class="card-footer bg-body-tertiary border-0 py-3 px-4">
            {{ $paket->links() }}
        </div>
        @endif

    </div>

</section>

{{-- Modal Hapus --}}
@foreach ($paket as $item)
<div class="modal fade" id="hapus{{ $item->id }}" tabindex="-1"
    aria-labelledby="hapusLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 360px;">
        <div class="modal-content border-0" style="
            border-radius: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,.06), 0 8px 24px rgba(0,0,0,.12);
            padding: 32px 24px 24px;
        ">
            <form action="/paket/{{ $item->id }}" method="POST">
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
                    <h5 class="fw-bold mb-2" id="hapusLabel{{ $item->id }}" style="font-size: 18px; color: #1F2937;">
                        Hapus Paket
                    </h5>
                    <p class="mb-4" style="font-size: 14px; color: #6B7280; line-height: 1.5;">
                        Apakah anda yakin ingin menghapus paket<br>
                        <strong style="color: #1F2937;">{{ $item->nama_paket }}</strong>?
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
    document.querySelectorAll('.table-responsive .dropdown').forEach(function(dropdown) {
        const toggle = dropdown.querySelector('[data-bs-toggle="dropdown"]');
        const menu = dropdown.querySelector('.dropdown-menu');

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
