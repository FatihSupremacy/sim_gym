@extends('layout.master')

@section('content')
@php
$totalMember = $totalMember ?? 0;
$memberAktif = $memberAktif ?? 0;
$memberKadaluwarsa = $memberKadaluwarsa ?? 0;
$pembayaranPending = $pembayaranPending ?? 0;
$pendapatanBulanIni = $pendapatanBulanIni ?? 0;
$checkinHariIni = $checkinHariIni ?? 0;
$trendLabels = $trendLabels ?? [];
$trendMemberData = $trendMemberData ?? [];
$trendPendapatanData = $trendPendapatanData ?? [];
$komposisiLabels = $komposisiLabels ?? [];
$komposisiData = $komposisiData ?? [];
$pembayaranTerbaru = $pembayaranTerbaru ?? collect();
$memberTerbaru = $memberTerbaru ?? collect();
$checkinTerbaruHariIni = $checkinTerbaruHariIni ?? collect();
@endphp
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    /* ── CSS Variables (aligned with Bootstrap 5.3 custom props) ── */
    :root {
        --bs-body-font-family: 'Plus Jakarta Sans', sans-serif;
        --bs-border-radius-xl: 16px;
        --dash-bg: #F8FAFC;
        --dash-border: #E5E7EB;
        --dash-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        --dash-shadow-hover: 0 12px 32px rgba(13, 110, 253, 0.10);
    }

    body {
        background-color: var(--dash-bg) !important;
    }

    .page-header {
        background-color: #FFFFFF;
        border-bottom: 1px solid #dee2e6;
    }

    #main>.page-content {
        padding-top: 0 !important;
    }

    /* ── Cards ── */
    .kpi-card,
    .section-card {
        background: #fff;
        border: 1px solid #E5E7EB;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .kpi-card {
        transition: transform .3s ease, box-shadow .3s ease;
    }

    .kpi-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(13, 110, 253, 0.10);
    }

    /* ── KPI Icon ── */
    .kpi-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        flex-shrink: 0;
    }

    .kpi-icon svg {
        width: 22px;
        height: 22px;
    }

    /* ── KPI Badge ── */
    .kpi-badge {
        font-size: 11px;
        font-weight: 600;
        padding: 3px 9px;
        border-radius: 999px;
        white-space: nowrap;
    }

    /* ── Status Badges (pill, soft) ── */
    .badge-soft-success {
        background: rgba(34, 197, 94, .12);
        color: #16a34a;
    }

    .badge-soft-warning {
        background: rgba(245, 158, 11, .12);
        color: #b45309;
    }

    .badge-soft-danger {
        background: rgba(239, 68, 68, .12);
        color: #dc2626;
    }

    .badge-soft-primary {
        background: rgba(13, 110, 253, .10);
        color: #0d6efd;
    }

    .badge-soft-neutral {
        background: rgba(107, 114, 128, .10);
        color: #6b7280;
    }

    /* ── Table overrides ── */
    .dash-table>thead>tr>th {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: .07em;
        text-transform: uppercase;
        color: #9CA3AF;
        border-bottom: 1px solid #F3F4F6;
        padding-block: 10px;
        white-space: nowrap;
        background: transparent;
    }

    .dash-table>tbody>tr>td {
        font-size: 13px;
        vertical-align: middle;
        padding-block: 10px;
        border-bottom: 1px solid #F9FAFB;
    }

    .dash-table>tbody>tr:last-child>td {
        border-bottom: none;
    }

    /* ── Avatar initials ── */
    .avatar-sq {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 700;
        flex-shrink: 0;
    }

    /* ── Date pill ── */
    .date-pill {
        border: 1px solid var(--dash-border);
        border-radius: 10px;
        padding: 8px 16px;
        background: #fff;
    }
</style>

<main class="container-fluid pt-0 pb-3 px-4" aria-label="Halaman dashboard">

    {{-- ── Page Header ── --}}
    <div class="page-header card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body py-3 px-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h1 class="h5 fw-bold mb-1" style="color: #0D6EFD;">Dashboard</h1>
                    <p class="text-secondary small mb-0">Ringkasan performa gym hari ini dan bulan ini</p>
                </div>
                <div class="date-pill d-flex align-items-center gap-2 small fw-semibold text-body-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                        fill="none" stroke="var(--bs-primary)" stroke-width="2.2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    Hari ini &nbsp;&middot;&nbsp; {{ now()->translatedFormat('d F Y') }}
                </div>
            </div>
        </div>
    </div>

    {{-- ── KPI Cards ── --}}
    <div class="row g-3 mb-4">

        {{-- Total Member --}}
        <div class="col-12 col-sm-6 col-xl-4 col-xxl-2">
            <div class="kpi-card h-100 p-3">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="kpi-icon bg-primary bg-opacity-10 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="var(--bs-primary)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <span class="kpi-badge badge-soft-neutral">Total</span>
                </div>
                <p class="mb-1 text-uppercase fw-semibold" style="font-size:10.5px;letter-spacing:.07em;color:#6B7280">Total Member</p>
                <p class="mb-0 fw-bold lh-1" style="font-size:1.5rem;color:#1F2937">{{ number_format($totalMember) }}</p>
            </div>
        </div>

        {{-- Member Aktif --}}
        <div class="col-12 col-sm-6 col-xl-4 col-xxl-2">
            <div class="kpi-card h-100 p-3">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="kpi-icon bg-success bg-opacity-10 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="#22C55E" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22 4 12 14.01 9 11.01" />
                        </svg>
                    </div>
                    <span class="kpi-badge badge-soft-success">Aktif</span>
                </div>
                <p class="mb-1 text-uppercase fw-semibold" style="font-size:10.5px;letter-spacing:.07em;color:#6B7280">Member Aktif</p>
                <p class="mb-0 fw-bold lh-1" style="font-size:1.5rem;color:#22C55E">{{ number_format($memberAktif) }}</p>
            </div>
        </div>

        {{-- Member Kadaluwarsa --}}
        <div class="col-12 col-sm-6 col-xl-4 col-xxl-2">
            <div class="kpi-card h-100 p-3">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="kpi-icon bg-danger bg-opacity-10 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="#EF4444" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                    </div>
                    <span class="kpi-badge badge-soft-danger">Expired</span>
                </div>
                <p class="mb-1 text-uppercase fw-semibold" style="font-size:10.5px;letter-spacing:.07em;color:#6B7280">Kadaluwarsa</p>
                <p class="mb-0 fw-bold lh-1" style="font-size:1.5rem;color:#EF4444">{{ number_format($memberKadaluwarsa) }}</p>
            </div>
        </div>

        {{-- Pembayaran Pending --}}
        <div class="col-12 col-sm-6 col-xl-4 col-xxl-2">
            <div class="kpi-card h-100 p-3">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="kpi-icon bg-warning bg-opacity-10 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="#F59E0B" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                    </div>
                    <span class="kpi-badge badge-soft-warning">Pending</span>
                </div>
                <p class="mb-1 text-uppercase fw-semibold" style="font-size:10.5px;letter-spacing:.07em;color:#6B7280">Pembayaran Pending</p>
                <p class="mb-0 fw-bold lh-1" style="font-size:1.5rem;color:#F59E0B">{{ number_format($pembayaranPending) }}</p>
            </div>
        </div>

        {{-- Pendapatan Bulan Ini --}}
        <div class="col-12 col-sm-6 col-xl-4 col-xxl-2">
            <div class="kpi-card h-100 p-3">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="kpi-icon bg-primary bg-opacity-10 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="var(--bs-primary)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23" />
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                    </div>
                    <span class="kpi-badge badge-soft-success">Bulan ini</span>
                </div>
                <p class="mb-1 text-uppercase fw-semibold" style="font-size:10.5px;letter-spacing:.07em;color:#6B7280">Pendapatan</p>
                <p class="mb-0 fw-bold lh-1 text-primary" style="font-size:1.35rem">Rp&nbsp;{{ number_format($pendapatanBulanIni, 0, ',', '.') }}</p>
            </div>
        </div>

        {{-- Check-in Hari Ini --}}
        <div class="col-12 col-sm-6 col-xl-4 col-xxl-2">
            <div class="kpi-card h-100 p-3">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="kpi-icon bg-primary bg-opacity-10 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="var(--bs-primary)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                            <polyline points="10 17 15 12 10 7" />
                            <line x1="15" y1="12" x2="3" y2="12" />
                        </svg>
                    </div>
                    <span class="kpi-badge badge-soft-primary">Hari ini</span>
                </div>
                <p class="mb-1 text-uppercase fw-semibold" style="font-size:10.5px;letter-spacing:.07em;color:#6B7280">Check-in</p>
                <p class="mb-0 fw-bold lh-1" style="font-size:1.5rem;color:#1F2937">{{ number_format($checkinHariIni) }}</p>
            </div>
        </div>

    </div>

    {{-- ── Charts Row ── --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-6">
            <div class="section-card h-100 p-4">
                <p class="fw-bold mb-1" style="font-size:15px;color:#1F2937">Tren Member Baru</p>
                <p class="mb-3 small text-secondary">Pertumbuhan member per bulan</p>
                <div id="chart-tren-member" style="min-height:270px"></div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="section-card h-100 p-4">
                <p class="fw-bold mb-1" style="font-size:15px;color:#1F2937">Tren Pendapatan</p>
                <p class="mb-3 small text-secondary">Total pendapatan per bulan</p>
                <div id="chart-tren-pendapatan" style="min-height:270px"></div>
            </div>
        </div>
        <div class="col-12">
            <div class="section-card p-4">
                <p class="fw-bold mb-1" style="font-size:15px;color:#1F2937">Komposisi Paket</p>
                <p class="mb-3 small text-secondary">Paket yang paling banyak dipilih member</p>
                <div id="chart-komposisi-paket" style="min-height:300px"></div>
            </div>
        </div>
    </div>

    {{-- ── Bottom Tables ── --}}
    <div class="row g-3">

        {{-- Pembayaran Terbaru --}}
        <div class="col-12 col-xl-4">
            <div class="section-card h-100 p-4">
                <p class="fw-bold mb-1" style="font-size:15px;color:#1F2937">Pembayaran Terbaru</p>
                <p class="mb-3 small text-secondary">10 transaksi terakhir</p>
                <div class="table-responsive">
                    <table class="table table-borderless dash-table mb-0">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Status</th>
                                <th class="text-end">Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pembayaranTerbaru as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-sq bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center">
                                            {{ strtoupper(substr($item->member->nama ?? 'U', 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold small" style="color:#1F2937">{{ $item->member->nama ?? '-' }}</div>
                                            <div class="text-secondary" style="font-size:11px">{{ $item->paket->nama_paket ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($item->status === 'berhasil')
                                    <span class="badge rounded-pill badge-soft-success fw-semibold" style="font-size:11px;padding:4px 10px">Berhasil</span>
                                    @elseif($item->status === 'pending')
                                    <span class="badge rounded-pill badge-soft-warning fw-semibold" style="font-size:11px;padding:4px 10px">Pending</span>
                                    @else
                                    <span class="badge rounded-pill badge-soft-danger fw-semibold" style="font-size:11px;padding:4px 10px">Ditolak</span>
                                    @endif
                                </td>
                                <td class="text-end fw-semibold small" style="color:#1F2937">
                                    Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-secondary py-4 small">Belum ada data pembayaran.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Member Terbaru --}}
        <div class="col-12 col-xl-4">
            <div class="section-card h-100 p-4">
                <p class="fw-bold mb-1" style="font-size:15px;color:#1F2937">Member Terbaru</p>
                <p class="mb-3 small text-secondary">10 member daftar / perpanjang</p>
                <div class="table-responsive">
                    <table class="table table-borderless dash-table mb-0">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Paket</th>
                                <th class="text-end">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($memberTerbaru as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-sq bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center">
                                            {{ strtoupper(substr($item->nama, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold small" style="color:#1F2937">{{ $item->nama }}</div>
                                            <div class="text-secondary" style="font-size:11px">{{ $item->kode_member }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="small text-body-secondary">{{ $item->paket->nama_paket ?? '-' }}</td>
                                <td class="text-end small text-body-secondary">
                                    {{ \Carbon\Carbon::parse($item->tanggal_daftar)->format('d M Y') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-secondary py-4 small">Belum ada data member.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Check-in Terbaru --}}
        <div class="col-12 col-xl-4">
            <div class="section-card h-100 p-4">
                <p class="fw-bold mb-1" style="font-size:15px;color:#1F2937">Check-in Hari Ini</p>
                <p class="mb-3 small text-secondary">Aktivitas masuk terbaru</p>
                <div class="table-responsive">
                    <table class="table table-borderless dash-table mb-0">
                        <thead>
                            <tr>
                                <th>Jam</th>
                                <th>Tipe</th>
                                <th>Member</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($checkinTerbaruHariIni as $item)
                            <tr>
                                <td>
                                    <span class="fw-bold text-primary small">
                                        {{ \Carbon\Carbon::parse($item->checkin_time)->format('H:i') }}
                                    </span>
                                </td>
                                <td>
                                    @if($item->tipe === 'harian')
                                    <span class="badge rounded-pill badge-soft-neutral fw-semibold" style="font-size:11px;padding:4px 10px">Harian</span>
                                    @else
                                    <span class="badge rounded-pill badge-soft-primary fw-semibold" style="font-size:11px;padding:4px 10px">{{ ucfirst($item->tipe) }}</span>
                                    @endif
                                </td>
                                <td class="small" style="color:#374151">{{ $item->member->nama ?? 'Member Harian' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-secondary py-4 small">Belum ada check-in hari ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</main>

@push('scripts')
<script>
    const trendLabels = @json($trendLabels);
    const trendMemberData = @json($trendMemberData);
    const trendPendapatanData = @json($trendPendapatanData);

    const komposisiLabelsRaw = @json($komposisiLabels);
    const komposisiDataSource = @json($komposisiData);
    const komposisiDataRaw = Array.isArray(komposisiDataSource) ?
        komposisiDataSource.map((value) => Number(value) || 0) : [];
    const totalKomposisi = komposisiDataRaw.reduce((s, v) => s + v, 0);
    const komposisiLabels = totalKomposisi > 0 ? komposisiLabelsRaw : ['Belum ada member'];
    const komposisiData = totalKomposisi > 0 ? komposisiDataRaw : [1];

    const FONT = 'Plus Jakarta Sans';
    const BLUE = '#0D6EFD';
    const MUTED = '#9CA3AF';
    const GRID = '#F3F4F6';
    const renderChart = (selector, options) => {
        const element = document.querySelector(selector);

        if (!element || typeof ApexCharts === 'undefined') {
            return;
        }

        new ApexCharts(element, options).render();
    };

    /* ── Area: Tren Member ── */
    renderChart('#chart-tren-member', {
        chart: {
            type: 'area',
            height: 270,
            toolbar: {
                show: false
            },
            animations: {
                speed: 600
            }
        },
        series: [{
            name: 'Member Baru',
            data: trendMemberData
        }],
        xaxis: {
            categories: trendLabels,
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: MUTED,
                    fontSize: '11px',
                    fontFamily: FONT
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: MUTED,
                    fontSize: '11px',
                    fontFamily: FONT
                }
            }
        },
        grid: {
            borderColor: GRID,
            strokeDashArray: 4
        },
        stroke: {
            curve: 'smooth',
            width: 2.5
        },
        fill: {
            type: 'gradient',
            gradient: {
                colorStops: [{
                        offset: 0,
                        color: BLUE,
                        opacity: 0.25
                    },
                    {
                        offset: 100,
                        color: BLUE,
                        opacity: 0.02
                    }
                ]
            }
        },
        colors: [BLUE],
        dataLabels: {
            enabled: false
        },
        markers: {
            size: 4,
            colors: ['#fff'],
            strokeColors: BLUE,
            strokeWidth: 2
        },
        tooltip: {
            style: {
                fontFamily: FONT
            },
            y: {
                formatter: v => v + ' member'
            }
        }
    });

    /* ── Bar: Tren Pendapatan ── */
    renderChart('#chart-tren-pendapatan', {
        chart: {
            type: 'bar',
            height: 270,
            toolbar: {
                show: false
            },
            animations: {
                speed: 600
            }
        },
        series: [{
            name: 'Pendapatan',
            data: trendPendapatanData
        }],
        xaxis: {
            categories: trendLabels,
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: MUTED,
                    fontSize: '11px',
                    fontFamily: FONT
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: MUTED,
                    fontSize: '11px',
                    fontFamily: FONT
                },
                formatter: v => 'Rp ' + (v >= 1e6 ? (v / 1e6).toFixed(1) + 'jt' : v.toLocaleString('id-ID'))
            }
        },
        grid: {
            borderColor: GRID,
            strokeDashArray: 4
        },
        plotOptions: {
            bar: {
                borderRadius: 6,
                columnWidth: '52%'
            }
        },
        colors: [BLUE],
        dataLabels: {
            enabled: false
        },
        tooltip: {
            style: {
                fontFamily: FONT
            },
            y: {
                formatter: v => 'Rp ' + v.toLocaleString('id-ID')
            }
        }
    });

    /* ── Donut: Komposisi Paket ── */
    renderChart('#chart-komposisi-paket', {
        chart: {
            type: 'donut',
            height: 300,
            animations: {
                speed: 600
            }
        },
        series: komposisiData,
        labels: komposisiLabels,
        colors: [BLUE, '#22C55E', '#F59E0B', '#EF4444', '#8B5CF6', '#06B6D4', '#EC4899'],
        legend: {
            position: 'bottom',
            fontFamily: FONT,
            fontSize: '12px',
            labels: {
                colors: '#374151'
            }
        },
        dataLabels: {
            enabled: true,
            style: {
                fontFamily: FONT,
                fontSize: '12px'
            }
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '62%',
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Total',
                            style: {
                                fontFamily: FONT,
                                color: '#6B7280',
                                fontSize: '13px'
                            },
                            formatter: w => w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                        }
                    }
                }
            }
        },
        stroke: {
            width: 0
        },
        tooltip: {
            style: {
                fontFamily: FONT
            }
        }
    });
</script>
@endpush
@endsection
