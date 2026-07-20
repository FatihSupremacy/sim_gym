@push('styles')
<style>
    /* ── Outer shell ─────────────────────────────────────── */
    .hero-shell {
        /* background-color: #f4efe3; */
        margin-top: -32px;
        padding: 0 24px 8px;
    }

    /* ── Card ────────────────────────────────────────────── */
    .hero-card {
        position: relative;
        max-width: 1320px;
        margin: 0 auto;
        min-height: 720px;
        border-radius: 40px;
        overflow: hidden;
        background-image: url('https://images.unsplash.com/photo-1605296867304-46d5465a13f1?auto=format&fit=crop&w=1920&q=85');
        background-size: cover;
        background-position: right center;
        background-repeat: no-repeat;
        display: flex;
        flex-direction: column;
        box-shadow: 0 24px 64px rgba(5, 11, 15, .22), 0 4px 16px rgba(5, 11, 15, .12);
    }

    /* Dark overlay */
    .hero-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(100deg,
                rgba(5, 11, 15, .88) 0%,
                rgba(5, 11, 15, .54) 50%,
                rgba(5, 11, 15, .18) 100%);
        z-index: 1;
    }

    /* ── Inner content ───────────────────────────────────── */
    .hero-inner {
        position: relative;
        z-index: 2;
        flex: 1;
        display: flex;
        align-items: flex-end;
        padding: 0 64px 150px;
    }

    /* ── Typography ──────────────────────────────────────── */
    .hero-heading {
        color: #fff;
        font-weight: 800;
        text-transform: uppercase;
        line-height: 1;
        font-size: clamp(2.4rem, 5vw, 5rem);
        letter-spacing: -.5px;
    }


    .oswald-hero-heading {
        font-family: "Oswald", sans-serif;
        font-optical-sizing: auto;
        font-weight: 700;
        font-style: normal;
    }

    .hero-desc {
        color: rgba(255, 255, 255, .82);
        max-width: 560px;
        font-size: 1.08rem;
        margin-top: 1.25rem;
        line-height: 1.65;
    }

    .montserrat-hero-desc {
        font-family: "Montserrat", sans-serif;
        font-optical-sizing: auto;
        font-weight: 300;
        font-style: normal;
    }


    /* ── Button ──────────────────────────────────────────── */
    .btn-hero {
        display: inline-block;
        background-color: #0d6efd;
        color: #fff;
        border: none;
        border-radius: 16px;
        padding: .9rem 2rem;
        font-size: 1rem;
        font-weight: 700;
        text-decoration: none;
        transition: background-color .2s ease, transform .2s ease, box-shadow .2s ease;
        box-shadow: 0 4px 14px rgba(13, 110, 253, .35);
    }

    .btn-hero:hover {
        background-color: #0b5ed7;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(13, 110, 253, .45);
    }

    /* ── Stats ───────────────────────────────────────────── */
    .hero-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .hero-stat {
        display: flex;
        align-items: center;
        gap: .45rem;
        color: rgba(255, 255, 255, .78);
        font-size: .88rem;
        font-weight: 500;
        white-space: nowrap;
    }

    .hero-stat i {
        font-size: 1rem;
        color: #0d6efd;
        flex-shrink: 0;
    }

    /* ── Responsive ──────────────────────────────────────── */
    @media (max-width: 991px) {
        .hero-card {
            min-height: 640px;
        }

        .hero-inner {
            padding: 0 40px 120px;
        }
    }

    @media (max-width: 767px) {
        .hero-shell {
            margin-top: -18px;
            padding: 0 14px 8px;
        }

        .hero-card {
            border-radius: 26px;
            min-height: 620px;
            background-position: center center;
        }

        .hero-card::before {
            background: linear-gradient(180deg,
                    rgba(5, 11, 15, .30) 0%,
                    rgba(5, 11, 15, .88) 100%);
        }

        .hero-inner {
            padding: 24px 24px 86px;
            align-items: flex-end;
        }

        .hero-heading {
            font-size: clamp(2.2rem, 8vw, 2.8rem);
        }

        .hero-desc {
            max-width: 100%;
            font-size: .95rem;
        }

        .btn-hero {
            width: 100%;
            text-align: center;
        }

        .hero-stats {
            gap: 1rem;
        }

        .hero-stat {
            font-size: .82rem;
        }
    }
</style>
@endpush

<section class="hero-shell" id="home">
    <div class="hero-card">
        <div class="hero-inner">
            <div style="width:100%;">
                <h1 class="hero-heading oswald-hero-heading">
                    BUILD YOUR STRONGER<br>BODY
                </h1>
                <p class="hero-desc montserrat-hero-desc">
                    Mulai perjalanan fitness kamu dengan fasilitas lengkap dan suasana gym yang mendukung progres setiap hari
                </p>
                <div class="mt-4">
                    <a href="{{ route('pendaftaran') }}" class="btn-hero">Daftar Sekarang</a>
                </div>
                <div class="hero-stats">
                    <span class="hero-stat">
                        <i class="bi bi-people-fill"></i>
                        1000+ Member Terdaftar
                    </span>
                    <span class="hero-stat">
                        <i class="bi bi-calendar2-check"></i>
                        Paket Harian &amp; Bulanan
                    </span>
                    <span class="hero-stat">
                        <i class="bi bi-lightning-charge-fill"></i>
                        Alat Latihan Lengkap
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
