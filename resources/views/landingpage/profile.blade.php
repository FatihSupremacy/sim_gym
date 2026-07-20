<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Member - Limus Fitness Centre</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --blue: #0d6efd;
            --navy: #08111f;
            --ink: #172033;
            --muted: #6b7280;
            --surface: #ffffff;
            --line: #e7eaf0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            color: var(--ink);
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at 10% 15%, rgba(56, 189, 248, .42), transparent 30%),
                radial-gradient(circle at 90% 85%, rgba(13, 110, 253, .35), transparent 32%),
                linear-gradient(135deg, #dff5ff 0%, #9edcf7 46%, #69bfee 100%);
        }

        a {
            color: inherit;
        }

        .profile-page {
            width: min(1120px, calc(100% - 32px));
            margin: 0 auto;
            padding: 4px 0 48px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 4px;
        }

        .brand,
        .topbar-actions {
            display: flex;
            align-items: center;
        }

        .brand {
            color: var(--navy);
            text-decoration: none;
        }

        .brand img {
            width: 140px;
            height: 140px;
            border-radius: 0;
            object-fit: contain;
            background: transparent;
            box-shadow: none;
        }

        .topbar-actions {
            gap: 10px;
        }

        .icon-button {
            width: 44px;
            height: 44px;
            border: 1px solid rgba(255, 255, 255, .65);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
            background: rgba(255, 255, 255, .45);
            backdrop-filter: blur(12px);
            text-decoration: none;
            cursor: pointer;
            transition: none;
        }

        .icon-button:hover {
            transform: none;
            background: rgba(255, 255, 255, .45);
        }

        .icon-button.danger {
            color: #c52233;
        }

        .profile-shell {
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .7);
            border-radius: 34px;
            background: rgba(255, 255, 255, .86);
            box-shadow: 0 28px 80px rgba(8, 17, 31, .18);
            backdrop-filter: blur(22px);
        }

        .profile-hero {
            min-height: 230px;
            padding: 40px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 28px;
            color: #fff;
            background:
                linear-gradient(120deg, rgba(8, 17, 31, .98), rgba(13, 110, 253, .82)),
                repeating-linear-gradient(120deg, transparent 0 22px, rgba(255, 255, 255, .04) 22px 24px);
            position: relative;
        }

        .profile-hero::after {
            content: '';
            position: absolute;
            width: 240px;
            height: 240px;
            right: -60px;
            top: -90px;
            border: 42px solid rgba(255, 255, 255, .06);
            border-radius: 50%;
        }

        .identity {
            display: flex;
            align-items: center;
            gap: 22px;
            position: relative;
            z-index: 1;
        }

        .avatar {
            width: 112px;
            height: 112px;
            border: 4px solid rgba(255, 255, 255, .92);
            border-radius: 28px;
            display: grid;
            place-items: center;
            overflow: hidden;
            flex-shrink: 0;
            color: #fff;
            background: linear-gradient(145deg, #34b6f3, #0d6efd);
            box-shadow: 0 14px 32px rgba(0, 0, 0, .28);
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.6rem;
            letter-spacing: .04em;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .eyebrow {
            margin: 0 0 5px;
            color: rgba(255, 255, 255, .66);
            font-size: .73rem;
            font-weight: 700;
            letter-spacing: .15em;
            text-transform: uppercase;
        }

        .identity h1 {
            margin: 0;
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(2.2rem, 5vw, 3.6rem);
            font-weight: 400;
            letter-spacing: .035em;
            line-height: 1;
        }

        .member-code {
            margin: 9px 0 0;
            color: rgba(255, 255, 255, .76);
            font-size: .88rem;
        }

        .status-badge {
            position: relative;
            z-index: 1;
            border: 1px solid currentColor;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            font-size: .78rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .07em;
            white-space: nowrap;
        }

        .status-badge::before {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: currentColor;
            box-shadow: 0 0 0 4px rgba(255, 255, 255, .1);
        }

        .status-aktif {
            color: #70f0ad;
            background: rgba(22, 163, 74, .12);
        }

        .status-pending {
            color: #ffd36a;
            background: rgba(245, 158, 11, .12);
        }

        .status-kadaluwarsa {
            color: #ff8d98;
            background: rgba(239, 68, 68, .12);
        }

        .profile-content {
            padding: 36px 40px 42px;
        }

        .section-title {
            margin: 0 0 5px;
            color: var(--ink);
            font-size: 1rem;
            font-weight: 800;
        }

        .section-subtitle {
            margin: 0 0 22px;
            color: var(--muted);
            font-size: .82rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .info-card {
            min-height: 92px;
            padding: 17px 18px;
            border: 1px solid var(--line);
            border-radius: 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            background: rgba(255, 255, 255, .72);
        }

        .info-icon {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            color: var(--blue);
            background: #eaf3ff;
            font-size: 1.05rem;
        }

        .info-label,
        .info-value {
            display: block;
        }

        .info-label {
            margin-bottom: 5px;
            color: var(--muted);
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .info-value {
            color: var(--ink);
            font-size: .9rem;
            font-weight: 700;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .membership-card {
            margin-top: 14px;
            padding: 22px;
            border-radius: 20px;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 24px;
            color: #fff;
            background: var(--navy);
        }

        .membership-card .info-label {
            color: rgba(255, 255, 255, .55);
        }

        .package-name {
            margin: 0;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            font-weight: 400;
            letter-spacing: .035em;
        }

        .membership-period {
            padding-left: 24px;
            border-left: 1px solid rgba(255, 255, 255, .13);
            display: grid;
            align-content: center;
            gap: 6px;
        }

        .period-date {
            font-size: .9rem;
            font-weight: 700;
        }

        .period-note {
            color: rgba(255, 255, 255, .58);
            font-size: .75rem;
        }

        .empty-state {
            max-width: 650px;
            margin: 0 auto;
            padding: 76px 28px;
            text-align: center;
        }

        .empty-icon {
            width: 82px;
            height: 82px;
            margin: 0 auto 22px;
            border-radius: 24px;
            display: grid;
            place-items: center;
            color: var(--blue);
            background: #eaf3ff;
            font-size: 2rem;
        }

        .empty-state h1 {
            margin: 0 0 10px;
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(2rem, 5vw, 3.1rem);
            font-weight: 400;
            letter-spacing: .035em;
        }

        .empty-state p {
            max-width: 520px;
            margin: 0 auto;
            color: var(--muted);
            font-size: .92rem;
            line-height: 1.7;
        }

        .empty-state .note {
            margin-top: 18px;
            padding: 12px 15px;
            border-radius: 14px;
            color: #92400e;
            background: #fff7df;
            font-size: .82rem;
        }

        .primary-button {
            margin-top: 26px;
            padding: 13px 22px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: #fff;
            background: var(--blue);
            box-shadow: 0 8px 24px rgba(13, 110, 253, .28);
            font-size: .86rem;
            font-weight: 800;
            text-decoration: none;
        }

        @media (max-width: 720px) {
            .profile-page {
                width: min(100% - 20px, 1120px);
                padding-top: 4px;
            }

            .profile-shell {
                border-radius: 25px;
            }

            .profile-hero {
                min-height: 0;
                padding: 28px 22px;
                align-items: flex-start;
                flex-direction: column;
            }

            .identity {
                align-items: flex-start;
                flex-direction: column;
                gap: 16px;
            }

            .avatar {
                width: 88px;
                height: 88px;
                border-radius: 23px;
                font-size: 2rem;
            }

            .profile-content {
                padding: 26px 20px 28px;
            }

            .info-grid,
            .membership-card {
                grid-template-columns: 1fr;
            }

            .membership-period {
                padding: 18px 0 0;
                border-top: 1px solid rgba(255, 255, 255, .13);
                border-left: 0;
            }

            .empty-state {
                padding: 58px 20px;
            }
        }
    </style>
</head>

<body>
    @php
    $displayName = $member?->nama ?? $user->name;
    $nameParts = preg_split('/\s+/', trim($displayName));
    $initials = collect($nameParts)
    ->filter()
    ->take(2)
    ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
    ->implode('');
    $status = $member?->status ?? null;
    $statusLabel = match ($status) {
    'aktif' => 'Aktif',
    'pending' => 'Pending',
    'kadaluwarsa' => 'Kadaluwarsa',
    default => 'Belum terdaftar',
    };
    $photoExists = $member?->foto && file_exists(public_path('foto_member/'.$member->foto));
    @endphp

    <main class="profile-page">
        <header class="topbar">
            <a href="{{ route('landingpage') }}" class="brand" aria-label="Kembali ke beranda">
                <img src="{{ asset('assets/Logo-navbar-2.png') }}" alt="Limus Fitness Centre">
            </a>

            <div class="topbar-actions">
                <a href="{{ route('landingpage') }}" class="icon-button" aria-label="Kembali ke beranda" title="Beranda">
                    <i class="bi bi-house-door-fill" aria-hidden="true"></i>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="icon-button danger" aria-label="Keluar dari akun" title="Keluar">
                        <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </header>

        <section class="profile-shell" aria-labelledby="profile-title">
            @if ($member)
            <div class="profile-hero">
                <div class="identity">
                    <div class="avatar">
                        @if ($photoExists)
                        <img src="{{ asset('foto_member/'.$member->foto) }}" alt="Foto {{ $member->nama }}">
                        @else
                        <span>{{ $initials ?: 'M' }}</span>
                        @endif
                    </div>
                    <div>
                        <p class="eyebrow">Profil anggota</p>
                        <h1 id="profile-title">{{ $member->nama }}</h1>
                        <p class="member-code">{{ $member->kode_member }}</p>
                    </div>
                </div>

                <span class="status-badge status-{{ $status }}">{{ $statusLabel }}</span>
            </div>

            <div class="profile-content">
                <h2 class="section-title">Informasi pribadi</h2>
                <p class="section-subtitle">Data anggota yang terhubung dengan akun {{ $user->email }}</p>

                <div class="info-grid">
                    <div class="info-card">
                        <span class="info-icon"><i class="bi bi-person-vcard" aria-hidden="true"></i></span>
                        <span>
                            <span class="info-label">Kode member</span>
                            <span class="info-value">{{ $member->kode_member }}</span>
                        </span>
                    </div>

                    <div class="info-card">
                        <span class="info-icon"><i class="bi bi-gender-ambiguous" aria-hidden="true"></i></span>
                        <span>
                            <span class="info-label">Jenis kelamin</span>
                            <span class="info-value">{{ $member->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                        </span>
                    </div>

                    <div class="info-card">
                        <span class="info-icon"><i class="bi bi-telephone" aria-hidden="true"></i></span>
                        <span>
                            <span class="info-label">Nomor HP</span>
                            <span class="info-value">{{ $member->no_hp ?: '-' }}</span>
                        </span>
                    </div>

                    <div class="info-card">
                        <span class="info-icon"><i class="bi bi-envelope" aria-hidden="true"></i></span>
                        <span>
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $member->email ?: '-' }}</span>
                        </span>
                    </div>
                </div>

                <div class="membership-card">
                    <div>
                        <span class="info-label">Paket membership</span>
                        <p class="package-name">{{ $member->paket?->nama_paket ?? 'Paket tidak tersedia' }}</p>
                    </div>
                    <div class="membership-period">
                        <span class="info-label">Masa aktif membership</span>
                        <span class="period-date">
                            {{ $member->tanggal_daftar?->translatedFormat('d M Y') ?? '-' }}
                            &nbsp;–&nbsp;
                            {{ $member->tanggal_kadaluwarsa?->translatedFormat('d M Y') ?? '-' }}
                        </span>
                        <span class="period-note">
                            @if ($status === 'aktif')
                            Membership dapat digunakan selama periode ini
                            @elseif ($status === 'pending')
                            Menunggu konfirmasi pembayaran dari admin
                            @else
                            Masa membership telah berakhir
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            @else
            <div class="empty-state">
                @if ($pendaftaran?->status_pendaftaran === 'pending')
                <div class="empty-icon"><i class="bi bi-hourglass-split" aria-hidden="true"></i></div>
                <p class="eyebrow" style="color: var(--blue)">Status pendaftaran</p>
                <h1 id="profile-title">Sedang Ditinjau Admin</h1>
                <p>
                    Halo, {{ $user->name }}. Pendaftaran paket
                    <strong>{{ $pendaftaran->paket?->nama_paket ?? 'membership' }}</strong>
                    sudah kami terima. Biodata member akan otomatis tampil di sini setelah dikonfirmasi.
                </p>
                @elseif ($pendaftaran?->status_pendaftaran === 'ditolak')
                <div class="empty-icon"><i class="bi bi-info-circle" aria-hidden="true"></i></div>
                <p class="eyebrow" style="color: var(--blue)">Status pendaftaran</p>
                <h1 id="profile-title">Pendaftaran Belum Disetujui</h1>
                <p>Silakan periksa catatan admin, lalu kirim pendaftaran baru dengan data yang sesuai.</p>
                @if ($pendaftaran->catatan)
                <p class="note"><strong>Catatan admin:</strong> {{ $pendaftaran->catatan }}</p>
                @endif
                <a href="{{ route('pendaftaran') }}" class="primary-button">
                    Daftar kembali <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </a>
                @else
                <div class="empty-icon"><i class="bi bi-person-plus" aria-hidden="true"></i></div>
                <!-- <p class="eyebrow" style="color: var(--blue)">Profil member</p> -->
                <h1 id="profile-title">Anda Belum Menjadi Member</h1>
                <p>
                    Akun Anda sudah siap. Daftar membership menggunakan email
                    <strong>{{ $user->email }}</strong>, lalu data anggota akan tampil setelah admin mengonfirmasinya
                </p>
                <a href="{{ route('pendaftaran') }}" class="primary-button">
                    Daftar sekarang
                </a>
                @endif
            </div>
            @endif
        </section>
    </main>
</body>

</html>
