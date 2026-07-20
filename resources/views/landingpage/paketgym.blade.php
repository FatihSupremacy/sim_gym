@push('styles')
<style>
    .membership-showcase-section {
        padding: 0 clamp(14px, 3vw, 24px) 32px;
    }

    .membership-showcase-card {
        position: relative;
        overflow: hidden;
        width: min(100%, 1320px);
        max-width: 1320px;
        margin: 0 auto;
        min-height: 650px;
        border-radius: clamp(26px, 4vw, 36px);
        background-image: url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=1600&q=80');
        background-size: cover;
        background-position: center;
        padding: clamp(32px, 5vw, 60px) clamp(22px, 5vw, 52px);
        display: flex;
        align-items: center;
        box-shadow: 0 24px 64px rgba(5, 11, 15, .24), 0 6px 18px rgba(5, 11, 15, .14);
    }

    .membership-showcase-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, rgba(10, 10, 20, .82) 0%, rgba(10, 10, 20, .60) 55%, rgba(10, 10, 20, .45) 100%);
        border-radius: inherit;
        z-index: 0;
    }

    .showcase-inner {
        position: relative;
        z-index: 1;
        width: 100%;
    }

    .copy-col {
        padding-right: 40px;
        transform: translateY(-56px);
    }

    .copy-eyebrow {
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: #4da3ff;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .copy-eyebrow::before {
        content: '';
        display: inline-block;
        width: 28px;
        height: 2px;
        background: var(--blue);
        border-radius: 2px;
    }

    .copy-headline {
        font-size: clamp(1.9rem, 3.2vw, 2.75rem);
        font-weight: 800;
        color: #fff;
        line-height: 1.18;
        margin-bottom: 20px;
    }

    .oswald-copy-headline {
        font-family: "Oswald", sans-serif;
        font-optical-sizing: auto;
        font-weight: 700;
        font-style: normal;
    }


    .copy-headline .accent {
        color: #0d6efd;
    }

    .copy-sub {
        font-size: clamp(.92rem, 1.4vw, 1rem);
        color: rgba(255, 255, 255, .82);
        line-height: 1.65;
        margin-bottom: 32px;
        max-width: 420px;
    }

    .montserrat-copy-sub {
        font-family: "Montserrat", sans-serif;
        font-optical-sizing: auto;
        font-weight: 300;
        font-style: normal;
    }


    .copy-features {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .copy-features li {
        display: flex;
        align-items: center;
        gap: 10px;
        color: rgba(255, 255, 255, .92);
        font-size: .93rem;
        font-weight: 500;
    }

    .copy-features li .feat-icon {
        width: 28px;
        height: 28px;
        min-width: 28px;
        background: rgba(13, 110, 253, .22);
        border: 1.5px solid rgba(13, 110, 253, .5);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4da3ff;
        font-size: .78rem;
    }

    .pricing-col {
        display: flex;
        gap: 24px;
        align-items: stretch;
        width: 100%;
    }

    .pricing-card {
        position: relative;
        overflow: hidden;
        flex: 1 1 0;
        min-width: 0;
        min-height: 560px;
        padding: 34px 32px 30px;
        display: flex;
        flex-direction: column;
        color: #16181d;
        background: rgba(255, 255, 255, .78);
        border: 1px solid rgba(255, 255, 255, .55);
        border-radius: clamp(24px, 3vw, 38px);
        box-shadow: 0 18px 45px rgba(0, 0, 0, .16), 0 6px 16px rgba(0, 0, 0, .08);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
    }

    .pricing-badge {
        position: absolute;
        top: 22px;
        right: 24px;
        white-space: nowrap;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .02em;
        text-transform: none;
        border-radius: 999px;
        padding: 7px 12px;
        background: rgba(255, 255, 255, .48);
        border: 1px solid rgba(255, 255, 255, .62);
        color: #3f4652;
        line-height: 1;
    }

    .badge-popular {
        background: rgba(255, 255, 255, .58);
        border-color: rgba(13, 110, 253, .34);
        border-left: 3px solid #0d6efd;
        color: #1f2937;
    }

    .badge-flexible {
        background: rgba(255, 255, 255, .52);
        color: #374151;
    }

    .pricing-card-name {
        padding-right: 118px;
        font-size: 1.55rem;
        font-weight: 700;
        letter-spacing: 0;
        text-transform: none;
        color: #16181d;
        line-height: 1.15;
        margin: 0 0 8px;
    }

    .pricing-card-desc {
        font-size: .95rem;
        color: #4f5865;
        line-height: 1.55;
        margin: 0 0 24px;
    }

    .pricing-price {
        display: flex;
        align-items: flex-end;
        flex-wrap: wrap;
        gap: 8px;
        font-size: 2.85rem;
        font-weight: 800;
        color: #16181d;
        line-height: .95;
        margin: 0 0 8px;
    }

    .pricing-price span {
        font-size: .98rem;
        font-weight: 600;
        color: #3f4652;
        line-height: 1.2;
        margin-bottom: 6px;
    }

    .pricing-note {
        font-size: .86rem;
        color: #6f7681;
        margin: 0 0 22px;
    }

    .pricing-benefit-box {
        display: flex;
        flex-direction: column;
        gap: 16px;
        flex: 1;
        background: transparent;
        border-radius: 0;
        padding: 0;
        margin: 26px 0 0;
    }

    .pricing-benefit-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        font-size: .9rem;
        color: #292d33;
        line-height: 1.45;
        padding: 0;
    }

    .pricing-benefit-item i {
        color: #303238;
        font-size: 1.05rem;
        line-height: 1.35;
        min-width: 20px;
        margin-top: 1px;
    }

    .pricing-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        min-height: 64px;
        padding: 16px 20px;
        border: none;
        border-radius: 24px;
        background: #136FF6;
        color: #fff;
        font-size: .95rem;
        font-weight: 700;
        letter-spacing: .01em;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        box-shadow: none;
        transition: background-color .18s ease, color .18s ease, transform .18s ease, box-shadow .18s ease;
    }

    .pricing-btn:hover,
    .pricing-btn:focus-visible {
        background: #0f5fd4;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(20, 22, 26, .18);
    }

    .pricing-btn:focus-visible {
        outline: 3px solid rgba(255, 255, 255, .9);
        outline-offset: 3px;
    }

    .pricing-footer {
        margin: auto 0 0;
        padding-top: 24px;
        color: #6f7681;
        font-size: .86rem;
        line-height: 1.4;
    }

    @media (max-width: 991px) {
        .membership-showcase-card {
            min-height: auto;
            background-position: center top;
        }

        .copy-col {
            padding-right: 0;
            margin-bottom: 36px;
            transform: none;
        }

        .copy-sub {
            max-width: 100%;
        }

        .pricing-col {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .pricing-card {
            min-height: auto;
            padding: 30px 24px 28px;
        }

        .pricing-card-name {
            padding-right: 104px;
            font-size: 1.42rem;
        }

        .pricing-price {
            font-size: 2.45rem;
        }

        .pricing-btn {
            min-height: 60px;
        }
    }

    @media (max-width: 767px) {
        .membership-showcase-section {
            padding: 0 14px 28px;
        }

        .membership-showcase-card {
            background-position: center top;
        }

        .copy-headline {
            font-size: clamp(1.6rem, 7vw, 2rem);
            line-height: 1.16;
            margin-bottom: 16px;
        }

        .copy-headline br {
            display: none;
        }

        .copy-sub {
            font-size: .92rem;
            line-height: 1.6;
            margin-bottom: 0;
        }

        .copy-col {
            margin-bottom: 24px;
        }

        .pricing-col {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .pricing-card {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            column-gap: 12px;
            row-gap: 10px;
            min-height: auto;
            padding: 22px 18px 20px;
        }

        .pricing-badge {
            position: static;
            grid-column: 2;
            grid-row: 1;
            align-self: start;
            justify-self: end;
            padding: 7px 10px;
            font-size: .66rem;
        }

        .pricing-card-name {
            grid-column: 1;
            grid-row: 1;
            padding-right: 0;
            font-size: 1.32rem;
            margin: 0;
        }

        .pricing-card-desc {
            grid-column: 1 / -1;
            font-size: .9rem;
            line-height: 1.5;
            margin-bottom: 6px;
        }

        .pricing-price {
            grid-column: 1 / -1;
            font-size: clamp(2rem, 10vw, 2.45rem);
            margin-bottom: 0;
        }

        .pricing-price span {
            font-size: .98rem;
            color: #3f4652;
            margin-bottom: 6px;
        }

        .pricing-note {
            grid-column: 1 / -1;
            margin-bottom: 4px;
        }

        .pricing-btn {
            grid-column: 1 / -1;
            min-height: 52px;
            border-radius: 18px;
            padding: 13px 16px;
        }

        .pricing-benefit-box {
            grid-column: 1 / -1;
            gap: 10px;
            margin-top: 4px;
        }

        .pricing-benefit-item {
            font-size: .86rem;
            gap: 10px;
        }
    }

    @media (max-width: 420px) {
        .membership-showcase-section {
            padding-right: 14px;
            padding-left: 14px;
        }

        .membership-showcase-card {
            padding: 28px 16px;
        }

        .pricing-card {
            grid-template-columns: 1fr;
            padding: 20px 16px 18px;
        }

        .pricing-badge {
            grid-column: 1;
            grid-row: auto;
            justify-self: start;
            max-width: 96px;
            text-align: center;
        }

        .pricing-card-name,
        .pricing-card-desc,
        .pricing-price,
        .pricing-note,
        .pricing-btn,
        .pricing-benefit-box {
            grid-column: 1;
        }

        .pricing-card-name {
            grid-row: auto;
            font-size: 1.22rem;
        }

        .pricing-price {
            font-size: clamp(1.8rem, 12vw, 2.2rem);
        }

        .pricing-benefit-item {
            font-size: .82rem;
        }
    }
</style>
@endpush

<section class="membership-showcase-section" id="paket">
    <div class="membership-showcase-card">
        <div class="showcase-inner">
            <div class="row align-items-center g-0">
                <div class="col-lg-5 col-12 copy-col">
                    <h2 class="copy-headline oswald-copy-headline">PILIH <span class="accent">MEMBERSHIP</span> YANG SESUAI UNTUK<br>TARGET FITNESS KAMU</h2>
                    <p class="copy-sub montserrat-copy-sub">Pilih paket latihan yang sesuai dengan kebutuhanmu. Mulai dari latihan harian yang fleksibel hingga membership bulanan untuk progress yang lebih konsisten</p>
                </div>

                <div class="col-lg-7 col-12">
                    <div class="pricing-col">
                        <div class="pricing-card">
                            <span class="pricing-badge badge-flexible">Flexible</span>
                            <p class="pricing-card-name">Harian</p>
                            <p class="pricing-card-desc">Cocok untuk kamu yang ingin latihan fleksibel tanpa komitmen bulanan.</p>
                            <div class="pricing-price">Rp8.000 <span>/hari</span></div>
                            <p class="pricing-note">Bayar sesuai kunjungan</p>
                            <a href="{{ route('pendaftaran') }}" class="pricing-btn">Mulai Latihan</a>
                            <div class="pricing-benefit-box">
                                <div class="pricing-benefit-item"><i class="bi bi-check2"></i> Akses area latihan</div>
                                <div class="pricing-benefit-item"><i class="bi bi-check2"></i> Bebas menggunakan alat gym</div>
                                <div class="pricing-benefit-item"><i class="bi bi-check2"></i> Cocok untuk 1x latihan</div>
                                <div class="pricing-benefit-item"><i class="bi bi-check2"></i> Tidak perlu kontrak membership</div>
                                <div class="pricing-benefit-item"><i class="bi bi-check2"></i> Cocok untuk pemula</div>
                            </div>
                        </div>

                        <div class="pricing-card">
                            <span class="pricing-badge badge-popular">Most Popular</span>
                            <p class="pricing-card-name">Bulanan</p>
                            <p class="pricing-card-desc">Pilihan terbaik untuk latihan rutin dan progress yang lebih konsisten.</p>
                            <div class="pricing-price">Rp50.000 <span>/bulan</span></div>
                            <p class="pricing-note">Bisa diperpanjang kapan saja</p>
                            <a href="{{ route('pendaftaran') }}" class="pricing-btn">Daftar Membership</a>
                            <div class="pricing-benefit-box">
                                <div class="pricing-benefit-item"><i class="bi bi-check2"></i> Akses gym selama 1 bulan</div>
                                <div class="pricing-benefit-item"><i class="bi bi-check2"></i> Lebih hemat untuk latihan rutin</div>
                                <div class="pricing-benefit-item"><i class="bi bi-check2"></i> Bebas menggunakan fasilitas gym</div>
                                <div class="pricing-benefit-item"><i class="bi bi-check2"></i> Area latihan luas dan nyaman</div>
                                <div class="pricing-benefit-item"><i class="bi bi-check2"></i> Cocok untuk membangun konsistensi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
