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

    .payment-table {
        font-size: 13px;
    }

    .payment-table> :not(caption)>*>* {
        vertical-align: middle;
    }

    .payment-table thead th {
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

    .payment-table thead th:first-child {
        padding-left: 20px;
        padding-right: 4px;
    }

    .payment-table thead th:nth-child(2) {
        padding-left: 24px;
    }

    .payment-table thead th:last-child {
        padding-right: 16px;
        text-align: center;
    }

    .payment-table tbody td {
        font-size: 13px;
        padding: 10px 14px;
        border-bottom: 1px solid #F3F4F6;
        color: #374151;
    }

    .payment-table tbody td:first-child {
        padding-left: 20px;
        padding-right: 4px;
    }

    .payment-table tbody td:nth-child(2) {
        padding-left: 24px;
    }

    .payment-table thead th:nth-child(5),
    .payment-table tbody td:nth-child(5) {
        padding-left: 2px;
    }

    .payment-table thead th:last-child {
        padding-right: 16px;
        text-align: center;
    }

    .payment-table tbody td:last-child {
        padding-right: 16px;
        text-align: center;
    }

    .payment-table tbody tr:last-child td {
        border-bottom: none;
    }

    .payment-table tbody tr:hover {
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

    .m-paket,
    .payment-amount {
        font-weight: 600;
        color: #1F2937;
        font-size: 13px;
        line-height: 1.3;
    }

    .payment-method {
        color: #6B7280;
        font-size: 12.5px;
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
</style>

<main class="container-fluid pt-0 pb-3 px-4" aria-label="Halaman data pembayaran">

    {{-- Page Header --}}
    <div class="page-header card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body py-3 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h1 class="h5 fw-bold mb-1" style="color: #0D6EFD;">Data Pembayaran</h1>
                    <p class="text-secondary small mb-0">Kelola seluruh data pembayaran member</p>
                </div>
                <a href="{{ route('pembayaran.create') }}" class="btn btn-danger d-inline-flex align-items-center gap-2 rounded-3" style="font-size:13px;" aria-label="Tambah pembayaran baru">
                    <i class="bi bi-plus-circle-fill" style="line-height:0;" aria-hidden="true"></i>
                    Tambah Pembayaran
                </a>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <section aria-label="Tabel data pembayaran">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table payment-table table-borderless align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width:220px;">Member</th>
                            <th style="width:140px;">Paket</th>
                            <th style="width:130px;">Nominal</th>
                            <th style="width:130px;">Metode</th>
                            <th style="width:110px;">Status</th>
                            <th style="width:48px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $d)
                        @php
                        if (!empty($d->metode_detail)) {
                            $metodeLabel = $d->metode_detail;
                        } elseif ($d->metode === 'manual') {
                            $metodeLabel = 'Tunai';
                        } elseif ($d->metode === 'midtrans') {
                            $metodeLabel = 'Non Tunai';
                        } else {
                            $metodeLabel = $d->metode ?? '-';
                        }
                        @endphp
                        <tr>
                            <td>
                                <div class="d-flex flex-column" style="gap:1px;">
                                    <span class="m-name">{{ $d->member->nama ?? '-' }}</span>
                                    <span class="m-sub">{{ $d->member->kode_member ?? 'Kode member tidak tersedia' }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="m-paket">{{ $d->paket->nama_paket ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="payment-amount">Rp {{ number_format($d->nominal, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                <span class="payment-method">{{ $metodeLabel }}</span>
                            </td>
                            <td>
                                @if ($d->status == 'pending')
                                <span class="badge-status" style="background:rgba(245,158,11,.12);color:#D97706;width:fit-content;">
                                    <span class="dot" style="background:#F59E0B;"></span>Pending
                                </span>
                                @elseif ($d->status == 'berhasil')
                                <span class="badge-status" style="background:rgba(34,197,94,.10);color:#16A34A;width:fit-content;">
                                    <span class="dot" style="background:#16A34A;"></span>Berhasil
                                </span>
                                @else
                                <span class="badge-status" style="background:rgba(239,68,68,.10);color:#DC2626;width:fit-content;">
                                    <span class="dot" style="background:#DC2626;"></span>Ditolak
                                </span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown dropdown-aksi d-flex justify-content-center">
                                    <button type="button" class="btn-aksi" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Aksi pembayaran {{ $d->member->nama ?? 'member' }}">
                                        <i class="bi bi-three-dots-vertical" style="line-height:1;" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 py-2 px-2" style="min-width:160px;">
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('pembayaran.show', $d->id) }}">
                                                <i class="bi bi-eye text-primary" style="font-size:14px;width:18px;line-height:1;" aria-hidden="true"></i> Detail
                                            </a>
                                        </li>

                                        @if ($d->status == 'pending')
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2 text-success" href="{{ route('pembayaran.approve', $d->id) }}">
                                                <i class="bi bi-check2-circle" style="font-size:14px;width:18px;line-height:1;" aria-hidden="true"></i> Terima
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-2 text-danger" href="{{ route('pembayaran.reject', $d->id) }}">
                                                <i class="bi bi-x-circle" style="font-size:14px;width:18px;line-height:1;" aria-hidden="true"></i> Tolak
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-secondary">
                                <p class="mb-0" style="font-size:14px;">Data pembayaran belum tersedia</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</main>

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
