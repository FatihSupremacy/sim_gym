<div id="sidebar">
    <div class="sidebar-wrapper active">
        <style>
            .sidebar-wrapper {
                display: flex;
                flex-direction: column;
            }

            .sidebar-menu {
                display: flex;
                flex-direction: column;
                flex: 1;
                min-height: 0;
            }

            #sidebar .sidebar-wrapper .sidebar-header {
                padding-top: .75rem;
                padding-bottom: 0;
            }

            #sidebar .sidebar-wrapper .menu {
                margin-top: .25rem;
                padding-left: 20px;
                padding-right: 20px;
            }

            #sidebar .sidebar-wrapper .menu .sidebar-item .sidebar-link {
                padding-left: 14px;
                padding-right: 14px;
                border-radius: 12px;
            }

            .sidebar-user-panel-wrap {
                margin-top: auto;
                padding: 10px 16px 16px;
            }

            .sidebar-user-panel {
                display: block;
                padding: 10px 12px;
                border-radius: 12px;
                background: linear-gradient(135deg, #e9f2ff 0%, #d8e9ff 100%);
                border: 1px solid #cde0ff;
                box-shadow: 0 6px 16px rgba(37, 99, 235, .08);
                text-decoration: none;
                transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
            }

            .sidebar-user-panel:hover {
                transform: translateY(-2px);
                box-shadow: 0 14px 30px rgba(37, 99, 235, .18);
                border-color: #b4d1ff;
            }

            .sidebar-user-avatar {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-weight: 700;
                font-size: .75rem;
                background: linear-gradient(135deg, #5b7cff 0%, #4b63f0 100%);
                box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .25);
                flex-shrink: 0;
            }

            .sidebar-user-name {
                margin: 0;
                font-size: .8rem;
                font-weight: 700;
                color: #1d3366;
                line-height: 1.15;
            }

            .sidebar-user-email {
                margin: 1px 0 0;
                font-size: .7rem;
                color: #6b7da8;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            /* Hilangkan animasi hover pada sub menu Member */
            .submenu-link,
            .submenu-link:hover,
            .submenu-link:focus {
                transition: none !important;
                animation: none !important;
            }
        </style>
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo d-flex align-items-center gap-0" style="margin-left: -30px;">
                    <img src="{{ asset('assets/img/limus_logo_biru.png') }}" alt="Logo Limus Fitness Centre" style="width: 110px; height: 110px; object-fit: contain;">
                    <h1 class="mb-0 lh-sm" style="margin-left: -18px; font-size: 1.15rem;">Limus Fitness Centre</h1>
                </div>
                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li
                    class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li
                    class="sidebar-item has-sub {{ request()->is('members', 'members/*', 'pendaftaran-member', 'pendaftaran-member/*') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Member</span>
                    </a>

                    <ul class="submenu {{ request()->is('members', 'members/*', 'pendaftaran-member', 'pendaftaran-member/*') ? 'active' : '' }}">
                        <li class="submenu-item {{ request()->is('members') ? 'active' : '' }}">
                            <a href="{{ url('/members') }}" class="submenu-link">Daftar Member</a>
                        </li>
                        @if (auth()->check() && auth()->user()->role === 'admin')
                        <li class="submenu-item {{ request()->routeIs('admin.pendaftaran.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.pendaftaran.index') }}" class="submenu-link">Pendaftaran Member</a>
                        </li>
                        @endif
                    </ul>
                </li>

                <li
                    class="sidebar-item {{ request()->is('absen', 'absen/*') ? 'active' : '' }}">
                    <a href="/absen" class='sidebar-link'>
                        <i class="bi bi-clipboard-check-fill"></i>
                        <span>Absen</span>
                    </a>
                </li>

                <li
                    class="sidebar-item {{ request()->is('paket', 'paket/*') ? 'active' : '' }}">
                    <a href="/paket" class='sidebar-link'>
                        <i class="bi bi-box-seam-fill"></i>
                        <span>Paket Membership</span>
                    </a>
                </li>

                <li
                    class="sidebar-item {{ request()->is('laporan', 'laporan/*') ? 'active' : '' }}">
                    <a href="/laporan" class='sidebar-link'>
                        <i class="bi bi-file-text-fill"></i>
                        <span>Laporan Harian</span>
                    </a>
                </li>
                <li
                    class="sidebar-item {{ request()->is('pembayaran', 'pembayaran/*') ? 'active' : '' }}">
                    <a href="/pembayaran" class='sidebar-link'>
                        <i class="bi bi-currency-dollar"></i>
                        <span>Pembayaran</span>
                    </a>
                </li>
                <!-- <li
                    class=" sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-question-square-fill"></i>
                        <span>Pertanyaan</span>
                    </a>

                    <ul class="submenu ">

                        <li class="submenu-item  ">
                            <a href="extra-component-avatar.html" class="submenu-link">Semua Pertanyaan</a>

                        </li>

                        <li class="submenu-item  ">
                            <a href="extra-component-divider.html" class="submenu-link">Tambah Pertanyaan</a>

                        </li>
                    </ul>
                </li> -->
            </ul>
            @auth
            @php
            $currentUser = auth()->user();
            $avatarInitial = strtoupper(substr($currentUser->name ?? 'U', 0, 1));
            @endphp
            <div class="sidebar-user-panel-wrap">
                <a href="{{ route('account.profile') }}" class="sidebar-user-panel">
                    <div class="d-flex align-items-center gap-3">
                        <span class="sidebar-user-avatar">{{ $avatarInitial }}</span>
                        <div style="min-width: 0;">
                            <p class="sidebar-user-name text-truncate">{{ $currentUser->name }}</p>
                            <p class="sidebar-user-email">{{ $currentUser->email }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endauth
        </div>
    </div>
</div>
