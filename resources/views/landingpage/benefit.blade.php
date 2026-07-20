@push('styles')
<style>
    /* ── Shell & outer ────────────────────────────── */
    .benefit-shell {
        /* background-color: #f4efe3; */
        padding: 0 24px 8px;
    }

    /* ── Wrapper card hitam ───────────────────────── */
    .benefit-wrapper {
        max-width: 1320px;
        margin: 0 auto;
        background: #111111;
        border-radius: 40px;
        overflow: hidden;
        padding: 56px 64px;
        box-shadow: 0 24px 64px rgba(5, 11, 15, .22), 0 4px 16px rgba(5, 11, 15, .14);
    }

    /* ── Header ───────────────────────────────────── */
    .benefit-heading {
        font-size: clamp(1.8rem, 3.5vw, 2.6rem);
        font-weight: 800;
        color: #ffffff;
        text-transform: uppercase;
        line-height: 1.05;
        letter-spacing: -.3px;
        margin-bottom: 12px;
    }

    .oswald-benefit-heading {
        font-family: "Oswald", sans-serif;
        font-optical-sizing: auto;
        font-weight: 700;
        font-style: normal;
    }

    .benefit-heading-accent {
        color: #0d6efd;
    }


    .benefit-subtext {
        font-size: 1rem;
        color: rgba(255, 255, 255, .58);
        max-width: 560px;
        line-height: 1.65;
        margin-bottom: 0;
    }

    .montserrat-benefit-subtext {
        font-family: "Montserrat", sans-serif;
        font-optical-sizing: auto;
        font-weight: 300;
        font-style: normal;
    }

    /* ── Image ────────────────────────────────────── */
    .benefit-image-card {
        border-radius: 24px;
        height: 100%;
        overflow: hidden;
    }

    .benefit-image-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* ── List kolom ───────────────────────────────── */
    .benefit-list-wrap {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    /* ── List item ────────────────────────────────── */
    .benefit-list-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 16px;
        border-radius: 16px;
        border: 1.5px solid rgba(0, 194, 255, .36);
        background: linear-gradient(135deg, rgba(5, 18, 38, .96), rgba(8, 35, 74, .86));
        box-shadow: 0 0 0 1px rgba(13, 110, 253, .12), 0 0 22px rgba(0, 194, 255, .12);
    }

    .benefit-list-item .feat-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        background: rgba(0, 194, 255, .16);
        border: 1.5px solid rgba(0, 194, 255, .72);
        border-radius: 50%;
        color: #7ee7ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.05rem;
        line-height: 1;
        box-shadow: 0 0 14px rgba(0, 194, 255, .38);
        flex-shrink: 0;
    }

    .benefit-list-item .feat-icon i {
        display: block;
        line-height: 1;
    }

    .benefit-item-title {
        font-weight: 700;
        color: #ffffff;
        margin: 0 0 4px;
        font-size: .98rem;
    }

    .benefit-item-desc {
        color: rgba(255, 255, 255, .55);
        font-size: .88rem;
        margin: 0;
        line-height: 1.55;
    }

    /* ── CTA strip ────────────────────────────────── */
    .benefit-cta-strip {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-top: 16px;
        margin-top: auto;
        border-top: 1.5px solid rgba(255, 255, 255, .12);
    }

    .benefit-cta-label {
        font-weight: 600;
        color: rgba(255, 255, 255, .75);
        font-size: .95rem;
    }

    .btn-benefit {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #0d6efd;
        color: #fff;
        padding: 10px 22px;
        border-radius: 16px;
        text-decoration: none;
        font-weight: 700;
        font-size: .9rem;
        border: none;
        box-shadow: 0 4px 14px rgba(13, 110, 253, .35);
        transition: background-color .2s ease, transform .2s ease, box-shadow .2s ease;
    }

    .btn-benefit:hover {
        color: #fff;
        background-color: #0b5ed7;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(13, 110, 253, .45);
    }

    /* ── Divider header ───────────────────────────── */
    .benefit-header-divider {
        border: none;
        border-top: 1.5px solid rgba(255, 255, 255, .10);
        margin: 32px 0 0;
    }

    .benefit-content-row {
        margin-top: 32px;
    }

    /* ── Responsive ───────────────────────────────── */
    @media (max-width: 991px) {
        .benefit-wrapper {
            padding: 40px 36px;
        }
    }

    @media (max-width: 767px) {
        .benefit-shell {
            padding: 0 14px 8px;
        }

        .benefit-wrapper {
            padding: 32px 22px;
            border-radius: 26px;
        }

        .benefit-image-card {
            min-height: 240px;
            border-radius: 18px;
        }

        .benefit-cta-strip {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-benefit {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

<section class="benefit-shell" id="benefit">
    <div class="benefit-wrapper">

        {{-- Header --}}
        <div>
            <h2 class="benefit-heading oswald-benefit-heading">Benefit <span class="benefit-heading-accent">ANGGOTA</span></h2>
            <p class="benefit-subtext montserrat-benefit-subtext">Nikmati pengalaman latihan yang lebih nyaman dengan fasilitas lengkap, paket fleksibel, dan lingkungan gym yang mendukung progres latihan anda</p>
        </div>

        {{-- Row: image + list --}}
        <div class="row g-4 align-items-stretch benefit-content-row">

            {{-- Kolom gambar --}}
            <div class="col-lg-6 d-flex">
                <div class="benefit-image-card w-100">
                    <img
                        src="https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?auto=format&fit=crop&w=1920&q=80"
                        alt="Fasilitas Gym">
                </div>
            </div>

            {{-- Kolom list --}}
            <div class="col-lg-6 d-flex">
                <div class="benefit-list-wrap w-100 d-flex flex-column gap-3">

                    <div class="benefit-list-item">
                        <span class="feat-icon"><i class="bi bi-grid-3x3-gap"></i></span>
                        <div>
                            <p class="benefit-item-title">Fasilitas Gym Lengkap</p>
                            <p class="benefit-item-desc">Area parkir luas, loker penyimpanan tersedia, dan area latihan yang lega untuk kenyamanan maksimal.</p>
                        </div>
                    </div>

                    <div class="benefit-list-item">
                        <span class="feat-icon"><i class="bi bi-calendar2-check"></i></span>
                        <div>
                            <p class="benefit-item-title">Paket Membership Fleksibel</p>
                            <p class="benefit-item-desc">Pilihan paket harian dan bulanan sesuai kebutuhan dan ritme latihan kamu.</p>
                        </div>
                    </div>

                    <div class="benefit-list-item">
                        <span class="feat-icon"><i class="bi bi-box-seam"></i></span>
                        <div>
                            <p class="benefit-item-title">Alat Latihan Lengkap</p>
                            <p class="benefit-item-desc">Peralatan untuk berbagai kebutuhan dari strength training hingga body shaping.</p>
                        </div>
                    </div>

                    <div class="benefit-list-item">
                        <span class="feat-icon"><i class="bi bi-wallet2"></i></span>
                        <div>
                            <p class="benefit-item-title">Harga Terjangkau</p>
                            <p class="benefit-item-desc">Investasi fitness yang ramah di kantong tanpa mengorbankan kualitas fasilitas.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
