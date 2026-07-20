@extends('layout.master')

@section('content')

<style>
    .md-root {
        width: 100%;
        margin: 0;
        padding: 0 1.5rem 1rem;
        color: #374151;
    }

    #main>.page-content {
        padding-top: 0 !important;
    }

    .md-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 1.5rem;
        padding: 0.25rem 0;
    }

    .md-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
        color: #6B7280;
        text-decoration: none;
        padding: 8px 14px;
        border-radius: 8px;
        border: 1px solid #E5E7EB;
        background: #fff;
        transition: background 0.15s;
    }

    .md-back:hover {
        background: #F9FAFB;
        color: #374151;
    }

    .md-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .md-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
        padding: 9px 18px;
        border-radius: 8px;
        border: 1px solid #D1D5DB;
        background: #fff;
        color: #374151;
        cursor: pointer;
        transition: background 0.15s;
        font-family: inherit;
        text-decoration: none;
    }

    .md-btn:hover {
        background: #F9FAFB;
    }

    .md-btn.primary {
        background: #0D6EFD;
        color: #fff;
        border-color: #0D6EFD;
    }

    .md-btn.primary:hover {
        background: #0b5ed7;
    }

    /* Hero */
    .md-hero {
        background: #fff;
        border: 1px solid #E5E7EB;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        margin-bottom: 1.25rem;
    }

    .md-hero-inner {
        display: grid;
        grid-template-columns: 260px 1fr;
    }

    .md-avatar-col {
        background: #EEF2FF;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 300px;
    }

    .md-avatar-col img {
        width: 260px;
        height: 100%;
        min-height: 300px;
        object-fit: cover;
        display: block;
    }

    .md-avatar-placeholder {
        width: 100%;
        height: 100%;
        min-height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .md-info-col {
        padding: 2rem 2.5rem;
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        justify-content: center;
    }

    .md-badges {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .md-badge-status {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 10.5px;
        font-weight: 600;
        letter-spacing: 0;
        padding: 3px 8px;
        border-radius: 999px;
    }

    .md-badge-status.aktif {
        background: rgba(34, 197, 94, .10);
        color: #16A34A;
    }

    .md-badge-status.expired {
        background: rgba(239, 68, 68, .10);
        color: #DC2626;
    }

    .md-badge-status.pending {
        background: rgba(245, 158, 11, .12);
        color: #D97706;
    }


    .md-badge-status .dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    .md-badge-kode {
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.06em;
        padding: 5px 12px;
        border-radius: 999px;
        background: #F3F4F6;
        color: #6B7280;
        border: 1px solid #E5E7EB;
        font-family: monospace;
    }

    .md-name {
        font-size: clamp(1.6rem, 3vw, 2.1rem);
        font-weight: 700;
        letter-spacing: -0.02em;
        margin: 0 0 6px;
        line-height: 1.2;
        color: #111827;
    }

    .md-meta {
        font-size: 13px;
        color: #6B7280;
        margin: 0 0 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .md-meta i {
        display: inline-flex;
        align-items: center;
        font-size: 14px;
        line-height: 1;
        vertical-align: middle;
        margin-bottom: 2px;
    }

    .md-meta .sep {
        opacity: 0.4;
    }

    .md-chips {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .md-chip {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 10px 18px;
        border-radius: 10px;
        background: #EEF2FF;
        border: 1px solid rgba(13, 110, 253, .16);
    }

    .md-chip-icon {
        width: 36px;
        height: 36px;
        border-radius: 9px;
        background: rgba(13, 110, 253, .10);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .md-chip-text {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .md-chip-label {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.07em;
        color: #0D6EFD;
        text-transform: uppercase;
    }

    .md-chip-value {
        font-size: 14px;
        font-weight: 600;
        color: #1F2937;
    }

    /* Info grid */
    .md-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
        gap: 1.25rem;
    }

    .md-card {
        background: #fff;
        border: 1px solid #E5E7EB;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 1.75rem;
    }

    .md-card-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #F3F4F6;
    }

    .md-card-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: #EEF2FF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .md-card-title {
        font-size: 13.5px;
        font-weight: 600;
        color: #111827;
        margin: 0;
    }

    .md-field {
        margin-bottom: 1rem;
    }

    .md-field:last-child {
        margin-bottom: 0;
    }

    .md-field-label {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.08em;
        color: #9CA3AF;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .md-field-value {
        font-size: 13px;
        color: #1F2937;
        background: #F9FAFB;
        border: 1px solid #E5E7EB;
        border-radius: 9px;
        padding: 11px 14px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .md-field-value svg {
        flex-shrink: 0;
        color: #9CA3AF;
    }

    @media (max-width: 680px) {
        .md-hero-inner {
            grid-template-columns: 1fr;
        }

        .md-avatar-col {
            min-height: 200px;
        }

        .md-avatar-col img {
            width: 100%;
            height: 200px;
            min-height: unset;
        }

        .md-name {
            font-size: 24px;
        }

        .md-info-col {
            padding: 1.5rem;
        }

        .md-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<article class="md-root" aria-label="Detail member">

    {{-- Top bar --}}
    <header class="md-topbar">
        <a href="/members" class="md-back" aria-label="Kembali ke daftar member">
            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M10 13L5 8l5-5" />
            </svg>
            Kembali ke Daftar Member
        </a>

        <nav class="md-actions" aria-label="Aksi profil member">
            <a href="/members/{{ $data_member->id }}/edit" class="md-btn" aria-label="Edit profil member">
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M11 2l3 3-9.5 9.5H1v-3.5L11 2z" />
                </svg>
                Edit Profile
            </a>

            <a href="/members/{{ $data_member->id }}/perpanjang" class="md-btn primary" aria-label="Perpanjang Membership">
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="2" y="3" width="12" height="11" rx="1.5" />
                    <path d="M11 1v4M5 1v4M2 7h12" />
                    <path d="M6 10l1.4 1.4L10.5 8.3" />
                </svg>
                Perpanjang Membership
            </a>
        </nav>
    </header>

    {{-- Hero card --}}
    <section class="md-hero" aria-label="Profil utama member">
        <div class="md-hero-inner">

            <figure class="md-avatar-col" aria-label="Foto member" style="margin:0;">
                @if($data_member->foto)
                <img src="{{ asset('foto_member/' . $data_member->foto) }}"
                    alt="Foto {{ $data_member->nama }}">
                @else
                <div class="md-avatar-placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#0D6EFD" viewBox="0 0 24 24" aria-hidden="true" opacity="0.35">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M20 21a8 8 0 1 0-16 0" />
                    </svg>
                </div>
                @endif
            </figure>

            <div class="md-info-col">
                @php
                $statusMembership = strtolower($data_member->status);
                $isActive = $statusMembership === 'aktif';
                $isPending = $statusMembership === 'pending';
                $statusBadgeClass = $isPending ? 'pending' : ($isActive ? 'aktif' : 'expired');
                $statusLabel = $isPending ? 'Pending' : ($isActive ? 'Aktif' : 'Kadaluwarsa');
                $expiredDate = \Carbon\Carbon::parse($data_member->tanggal_kadaluwarsa);
                @endphp

                <div class="md-badges">
                    <span class="md-badge-status {{ $statusBadgeClass }}" role="status">
                        <span class="dot" aria-hidden="true"></span>
                        {{ $statusLabel }}
                    </span>
                    <span class="md-badge-kode" aria-label="Kode member: {{ $data_member->kode_member }}">
                        {{ $data_member->kode_member }}
                    </span>
                </div>

                <div>
                    <h1 class="md-name">{{ $data_member->nama }}</h1>
                    <p class="md-meta">
                        @if($data_member->jenis_kelamin == 'L')
                        <i class="bi bi-gender-male" style="color: #3B82F6; font-size: 15px; position: relative; top: 3px;"></i>
                        Laki-laki
                        @else
                        <i class="bi bi-gender-female" style="color: #EC4899; font-size: 15px; position: relative; top: 2px;"></i>
                        Perempuan
                        @endif
                        <span class="sep" aria-hidden="true">-</span>
                        Member sejak {{ \Carbon\Carbon::parse($data_member->tanggal_daftar)->locale('id')->isoFormat('MMM Y') }}
                    </p>

                    <div class="md-chips" role="list" aria-label="Informasi paket">
                        <div class="md-chip" role="listitem">
                            <div class="md-chip-icon" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 16 16" fill="none" stroke="#0D6EFD" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 1l1.93 3.9L14 5.76l-3 2.93.71 4.14L8 10.77l-3.71 2.06L5 8.69 2 5.76l4.07-.86z" />
                                </svg>
                            </div>
                            <div class="md-chip-text">
                                <span class="md-chip-label">Paket</span>
                                <span class="md-chip-value">{{ $data_member->paket->nama_paket ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="md-chip" role="listitem">
                            <div class="md-chip-icon" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 16 16" fill="none" stroke="#0D6EFD" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="3" width="12" height="11" rx="1.5" />
                                    <path d="M11 1v4M5 1v4M2 7h12" />
                                </svg>
                            </div>
                            <div class="md-chip-text">
                                <span class="md-chip-label">Kadaluwarsa</span>
                                <span class="md-chip-value">
                                    {{ $expiredDate->locale('id')->isoFormat('D MMM YYYY') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Info cards --}}
    <div class="md-grid">

        {{-- Kontak --}}
        <section class="md-card" aria-labelledby="info-kontak-heading">
            <header class="md-card-header">
                <div class="md-card-icon" aria-hidden="true">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="#0D6EFD" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="8" cy="5.5" r="2.5" />
                        <path d="M2 14a6 6 0 0112 0" />
                    </svg>
                </div>
                <h2 class="md-card-title" id="info-kontak-heading">Informasi Kontak</h2>
            </header>

            <dl>
                <div class="md-field">
                    <dt class="md-field-label">Email</dt>
                    <dd class="md-field-value" style="margin:0;">
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="1" y="3" width="14" height="10" rx="1.5" />
                            <path d="M1 5l7 5 7-5" />
                        </svg>
                        {{ $data_member->email }}
                    </dd>
                </div>

                <div class="md-field">
                    <dt class="md-field-label">Nomor Handphone</dt>
                    <dd class="md-field-value" style="margin:0;">
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M1 2.5A1.5 1.5 0 012.5 1h2.22l1.2 2.99-1.39.93a8.01 8.01 0 004.56 4.56l.93-1.39L13 9.28V11.5A1.5 1.5 0 0111.5 13 9.5 9.5 0 011 2.5z" />
                        </svg>
                        {{ $data_member->no_hp }}
                    </dd>
                </div>

                <div class="md-field">
                    <dt class="md-field-label">Alamat</dt>
                    <dd class="md-field-value" style="margin:0; align-items:flex-start;">
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" style="margin-top:2px;" aria-hidden="true">
                            <path d="M8 1a5 5 0 00-5 5c0 4 5 9 5 9s5-5 5-9a5 5 0 00-5-5z" />
                            <circle cx="8" cy="6" r="1.5" />
                        </svg>
                        {{ $data_member->alamat }}
                    </dd>
                </div>
            </dl>
        </section>

        {{-- Keanggotaan --}}
        <section class="md-card" aria-labelledby="info-membership-heading">
            <header class="md-card-header">
                <div class="md-card-icon" aria-hidden="true">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="#0D6EFD" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 1l1.93 3.9L14 5.76l-3 2.93.71 4.14L8 10.77l-3.71 2.06L5 8.69 2 5.76l4.07-.86z" />
                    </svg>
                </div>
                <h2 class="md-card-title" id="info-membership-heading">Detail Keanggotaan</h2>
            </header>

            <dl>
                <div class="md-field">
                    <dt class="md-field-label">Tanggal Daftar</dt>
                    <dd class="md-field-value" style="margin:0;">
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="2" y="3" width="12" height="11" rx="1.5" />
                            <path d="M11 1v4M5 1v4M2 7h12" />
                        </svg>
                        {{ \Carbon\Carbon::parse($data_member->tanggal_daftar)->locale('id')->isoFormat('D MMMM YYYY') }}
                    </dd>
                </div>

                <div class="md-field">
                    <dt class="md-field-label">Paket Aktif</dt>
                    <dd class="md-field-value" style="margin:0;">
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M8 1l1.93 3.9L14 5.76l-3 2.93.71 4.14L8 10.77l-3.71 2.06L5 8.69 2 5.76l4.07-.86z" />
                        </svg>
                        {{ $data_member->paket->nama_paket ?? '-' }}
                    </dd>
                </div>

            </dl>
        </section>

    </div>

</article>

@endsection
