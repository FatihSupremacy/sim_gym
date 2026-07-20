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

    .registration-table {
        width: 100%;
        table-layout: fixed;
        font-size: 13px;
        margin-bottom: 0;
    }

    .registration-table> :not(caption)>*>* {
        vertical-align: middle;
    }

    .registration-table thead th {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .05em;
        color: #9CA3AF;
        background: #F9FAFB;
        border-bottom: 1px solid #F3F4F6;
        padding: 10px 14px;
        line-height: 1.25;
        white-space: normal;
    }

    .registration-table thead th:first-child {
        padding-left: 20px;
        padding-right: 4px;
    }

    .registration-table thead th:nth-child(2) {
        text-align: center;
    }

    .registration-table thead th:last-child {
        padding-left: 14px;
        padding-right: 14px;
        text-align: center;
    }

    .registration-table tbody td {
        font-size: 13px;
        padding: 10px 14px;
        border-bottom: 1px solid #F3F4F6;
        color: #374151;
        overflow-wrap: anywhere;
    }

    .registration-table tbody td:first-child {
        padding-left: 20px;
        padding-right: 4px;
    }

    .registration-table tbody td:nth-child(2) {
        text-align: center;
    }

    .registration-table tbody td:last-child {
        padding-left: 14px;
        padding-right: 14px;
        text-align: center;
    }

    .registration-table tbody tr:last-child td {
        border-bottom: none;
    }

    .registration-table tbody tr:hover {
        background: #FAFBFF;
    }

    .applicant-name {
        font-weight: 600;
        color: #1F2937;
        font-size: 13.5px;
        line-height: 1.25;
    }

    .applicant-meta,
    .applicant-contact {
        font-size: 11.5px;
        color: #9CA3AF;
        line-height: 1.35;
        overflow-wrap: anywhere;
    }

    .applicant-meta .sep,
    .applicant-meta.sep {
        margin: 0 5px;
        opacity: .5;
    }

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

    .addr-text,
    .note-text {
        color: #6B7280;
        font-size: 12.5px;
        line-height: 1.4;
        overflow-wrap: anywhere;
    }

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

    .btn-aksi i {
        line-height: 0;
        display: block;
        font-size: 15px;
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

    @media (max-width: 991px) {
        .registration-table thead th,
        .registration-table tbody td {
            padding-left: 10px;
            padding-right: 10px;
        }
    }
</style>

<main class="container-fluid pt-0 pb-3 px-4" aria-label="Pendaftaran member">
    <div class="page-header card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body py-3 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h1 class="h5 fw-bold mb-1" style="color: #0D6EFD;">Pendaftaran Member</h1>
                    <p class="text-secondary small mb-0">Tinjau pendaftaran dari landing page dan konfirmasi menjadi member.</p>
                </div>
                <span class="badge rounded-pill text-bg-warning px-3 py-2">
                    {{ $pendaftaran->where('status_pendaftaran', 'pending')->count() }} pending di halaman ini
                </span>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-3">
            {{ $errors->first() }}
        </div>
    @endif

    <section class="card border-0 shadow-sm rounded-4 overflow-hidden" aria-label="Tabel data pendaftaran">
        <div class="table-responsive">
            <table class="table registration-table table-borderless align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 24%;">Pendaftar</th>
                        <th style="width: 12%;">Jenis Kelamin</th>
                        <th style="width: 18%;">Alamat</th>
                        <th style="width: 16%;">Membership</th>
                        <th style="width: 22%;">Status & Catatan</th>
                        <th style="width: 48px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendaftaran as $item)
                        <tr>
                            <td>
                                <div class="applicant-name">{{ $item->nama }}</div>
                                <div class="applicant-meta">Dikirim {{ $item->created_at->format('d M Y, H:i') }}</div>
                                <div class="applicant-contact">{{ $item->no_hp }}<span class="applicant-meta sep" aria-hidden="true">&bull;</span>{{ $item->email }}</div>
                            </td>
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
                            <td>
                                <div class="addr-text">{{ $item->alamat }}</div>
                            </td>
                            <td>
                                <div class="m-paket">{{ $item->paket->nama_paket }}</div>
                                <div class="m-date">{{ $item->paket->durasi }} {{ $item->paket->tipe_durasi }}</div>
                            </td>
                            <td>
                                @if($item->status_pendaftaran === 'pending')
                                <span class="badge-status" style="background:rgba(245,158,11,.12);color:#D97706;width:fit-content;">
                                    <span class="dot" style="background:#F59E0B;"></span>Pending
                                </span>
                                @elseif($item->status_pendaftaran === 'dikonfirmasi')
                                <span class="badge-status" style="background:rgba(34,197,94,.10);color:#16A34A;width:fit-content;">
                                    <span class="dot" style="background:#16A34A;"></span>Dikonfirmasi
                                </span>
                                @else
                                <span class="badge-status" style="background:rgba(239,68,68,.10);color:#DC2626;width:fit-content;">
                                    <span class="dot" style="background:#DC2626;"></span>Ditolak
                                </span>
                                @endif
                                <div class="note-text mt-1">{{ $item->catatan ?: '-' }}</div>
                            </td>
                            <td>
                                <div class="dropdown dropdown-aksi d-flex justify-content-center">
                                    <button type="button" class="btn-aksi" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Aksi pendaftaran {{ $item->nama }}">
                                        <i class="bi bi-three-dots-vertical" style="line-height:1;" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 py-2 px-2" style="min-width:170px;">
                                        @if ($item->status_pendaftaran === 'pending')
                                        <li>
                                            <form action="{{ route('admin.pendaftaran.confirm', $item) }}" method="POST"
                                                onsubmit="return confirm('Konfirmasi pendaftar ini menjadi member?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="dropdown-item d-flex align-items-center gap-2 text-success">
                                                    <i class="bi bi-check-lg" style="font-size:14px;width:18px;line-height:1;" aria-hidden="true"></i> Konfirmasi
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item d-flex align-items-center gap-2 text-danger"
                                                data-bs-toggle="modal" data-bs-target="#rejectModal{{ $item->id }}">
                                                <i class="bi bi-x-lg" style="font-size:14px;width:18px;line-height:1;" aria-hidden="true"></i> Tolak
                                            </button>
                                        </li>
                                        @else
                                        <li><span class="dropdown-item text-secondary">Sudah diproses</span></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-5 text-center text-secondary">
                                <i class="bi bi-inbox fs-2 text-secondary d-block mb-2"></i>
                                <span class="fw-semibold text-secondary">Belum ada data pendaftaran.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($pendaftaran->hasPages())
            <div class="d-flex align-items-center justify-content-between border-top px-4 py-3">
                <span class="small text-secondary">
                    Halaman {{ $pendaftaran->currentPage() }} dari {{ $pendaftaran->lastPage() }}
                </span>
                <div class="d-flex gap-2">
                    @if ($pendaftaran->onFirstPage())
                        <span class="btn btn-sm btn-light disabled">Sebelumnya</span>
                    @else
                        <a href="{{ $pendaftaran->previousPageUrl() }}" class="btn btn-sm btn-outline-primary">Sebelumnya</a>
                    @endif

                    @if ($pendaftaran->hasMorePages())
                        <a href="{{ $pendaftaran->nextPageUrl() }}" class="btn btn-sm btn-outline-primary">Berikutnya</a>
                    @else
                        <span class="btn btn-sm btn-light disabled">Berikutnya</span>
                    @endif
                </div>
            </div>
        @endif
    </section>
</main>

@foreach ($pendaftaran as $item)
    @if ($item->status_pendaftaran === 'pending')
        <div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="rejectModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow">
                    <form action="{{ route('admin.pendaftaran.reject', $item) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="modal-header border-0 px-4 pt-4">
                            <h2 class="modal-title fs-5 fw-bold" id="rejectModalLabel{{ $item->id }}">
                                Tolak Pendaftaran
                            </h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body px-4">
                            <p class="text-secondary small">
                                Tuliskan alasan penolakan untuk pendaftaran <strong>{{ $item->nama }}</strong>.
                            </p>
                            <label for="catatan{{ $item->id }}" class="form-label fw-semibold">Catatan</label>
                            <textarea id="catatan{{ $item->id }}" name="catatan" class="form-control" rows="4"
                                maxlength="1000" required></textarea>
                        </div>
                        <div class="modal-footer border-0 px-4 pb-4">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Tolak Pendaftaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
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
