@push('styles')
<style>
    .navbar-wrapper {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: calc(100% - 48px);
        max-width: 800px;
        z-index: 1000;
    }

    .navbar-pill {
        background: rgba(255, 255, 255, .24);
        border: 1px solid rgba(255, 255, 255, .42);
        border-radius: 999px;
        padding: 6px 8px;
        box-shadow: 0 8px 32px rgba(5, 11, 15, .14);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        width: 100%;
    }

    .navbar-logo {
        flex-shrink: 0;
        width: 86px;
        height: 86px;
        margin: -12px 0 -12px 20px;
        transform: translateY(0);
        border-radius: 0;
        background: transparent;
        overflow: visible;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .navbar-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }

    .navbar-menu {
        display: flex;
        align-items: center;
        gap: 4px;
        flex: 1;
        justify-content: flex-start;
        list-style: none;
        margin: 0;
        padding: 0 0 0 16px;
    }

    .navbar-menu li a {
        display: inline-block;
        font-size: .86rem;
        font-weight: 500;
        color: #1a1a1a;
        text-decoration: none;
        padding: 7px 12px;
        border-radius: 999px;
        transition: background-color .18s ease, color .18s ease;
        white-space: nowrap;
    }

    .navbar-menu li a:hover {
        background-color: rgba(255, 255, 255, .44);
        color: #000;
    }

    .navbar-menu li a.active,
    .navbar-collapse-menu li a.active {
        background-color: rgba(255, 255, 255, .58);
        color: #000;
        font-weight: 600;
    }

    .navbar-cta {
        flex-shrink: 0;
    }

    .navbar-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-right: 30px;
        flex-shrink: 0;
    }

    .navbar-profile-link {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #fff;
        background: radial-gradient(circle at 30% 25%, #3a3a3a, #0f0f0f);
        text-decoration: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .25);
        transition: none;
    }

    .navbar-profile-link:hover,
    .navbar-profile-link:focus-visible {
        color: #fff;
        transform: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .25);
    }

    .navbar-profile-link i {
        font-size: 1.25rem;
        line-height: 1;
    }

    .btn-navbar-cta {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: radial-gradient(circle at 30% 30%, #3a3a3a, #0f0f0f);
        color: #fff;
        font-size: .875rem;
        font-weight: 600;
        padding: 14px 28px;
        border-radius: 999px;
        border: none;
        text-decoration: none;
        cursor: pointer;
        white-space: nowrap;
        transition: transform .18s ease, box-shadow .18s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .25);
    }

    .btn-navbar-cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, .32);
        color: #fff;
    }

    .navbar-toggler-pill {
        flex-shrink: 0;
        display: none;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .54);
        border: none;
        cursor: pointer;
        color: #1a1a1a;
        font-size: 1.2rem;
    }

    .navbar-toggler-pill:hover {
        background: rgba(255, 255, 255, .72);
    }

    .navbar-collapse-menu {
        display: none;
        position: absolute;
        top: calc(100% + 12px);
        left: 0;
        right: 0;
        background: rgba(255, 255, 255, .86);
        border: 1px solid rgba(255, 255, 255, .52);
        border-radius: 28px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, .12);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        padding: 16px;
        list-style: none;
        margin: 0;
    }

    .navbar-collapse-menu.open {
        display: block;
    }

    .navbar-collapse-menu li a {
        display: block;
        font-size: .95rem;
        font-weight: 500;
        color: #1a1a1a;
        text-decoration: none;
        padding: 11px 16px;
        border-radius: 14px;
        transition: background-color .15s ease;
    }

    .navbar-collapse-menu li a:hover {
        background-color: #f4f4f4;
    }

    @media (max-width: 767px) {
        .navbar-wrapper {
            width: calc(100% - 40px);
            top: 16px;
        }

        .navbar-pill {
            padding: 5px 8px;
        }

        .navbar-menu {
            display: none;
        }

        .navbar-toggler-pill {
            display: flex;
        }

        .btn-navbar-cta {
            padding: 11px 18px;
            font-size: .8rem;
        }

        .navbar-logo {
            width: 72px;
            height: 72px;
            margin: -8px 0 -8px 4px;
            transform: translateY(0);
        }

        .navbar-profile-link {
            width: 38px;
            height: 38px;
        }

        .navbar-actions {
            margin-right: 8px;
        }
    }
</style>
@endpush

<div class="navbar-wrapper">
    <nav class="navbar-pill" role="navigation" aria-label="Main navigation">
        <a href="#home" class="navbar-logo" aria-label="Homepage">
            <img src="{{ asset('assets/logo-navbar-2.png') }}" alt="Logo">
        </a>

        <ul class="navbar-menu" id="desktopMenu">
            <li><a href="#home" class="active">Home</a></li>
            <li><a href="#benefit">Benefit</a></li>
            <li><a href="#paket">Membership</a></li>
            <li><a href="#fasilitas">Fasilitas</a></li>
            <li><a href="#testimoni">Testimoni</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#footer">Contact</a></li>
        </ul>

        <div class="navbar-actions">
            <a
                href="{{ auth()->check() && auth()->user()->role === 'customer'
                    ? route('member.profile')
                    : route('login', ['redirect' => 'profile']) }}"
                class="navbar-profile-link"
                aria-label="Buka profil member"
                title="Profil">
                <i class="bi bi-person-fill" aria-hidden="true"></i>
            </a>

            <button class="navbar-toggler-pill" id="mobileToggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="mobileMenu">
                <i class="bi bi-list" id="toggleIcon"></i>
            </button>
        </div>
    </nav>

    <ul class="navbar-collapse-menu" id="mobileMenu" role="menu">
        <li><a href="#home" class="active">Home</a></li>
        <li><a href="#benefit">Benefit</a></li>
        <li><a href="#paket">Membership</a></li>
        <li><a href="#fasilitas">Fasilitas</a></li>
        <li><a href="#testimoni">Testimoni</a></li>
        <li><a href="#faq">FAQ</a></li>
        <li><a href="#footer">Contact</a></li>
    </ul>
</div>

<script>
    const toggle = document.getElementById('mobileToggle');
    const menu = document.getElementById('mobileMenu');
    const icon = document.getElementById('toggleIcon');
    const navLinks = document.querySelectorAll('#desktopMenu a, #mobileMenu a');

    const setActiveMenu = (target) => {
        navLinks.forEach(link => {
            link.classList.toggle('active', link.getAttribute('href') === target);
        });
    };

    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            setActiveMenu(link.getAttribute('href'));
        });
    });

    toggle.addEventListener('click', () => {
        const isOpen = menu.classList.toggle('open');
        toggle.setAttribute('aria-expanded', isOpen);
        icon.className = isOpen ? 'bi bi-x-lg' : 'bi bi-list';
    });

    menu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            menu.classList.remove('open');
            toggle.setAttribute('aria-expanded', false);
            icon.className = 'bi bi-list';
        });
    });

    document.addEventListener('click', (e) => {
        if (!toggle.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.remove('open');
            toggle.setAttribute('aria-expanded', false);
            icon.className = 'bi bi-list';
        }
    });
</script>