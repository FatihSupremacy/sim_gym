@push('styles')
<style>
    .facility-section {
        padding: 0 20px 8px;
    }

    .facility-showcase-card {
        max-width: 1320px;
        margin: 0 auto;
        background: #111;
        border-radius: 40px;
        padding: 52px 48px 48px;
        overflow: hidden;
        box-shadow: 0 24px 64px rgba(5, 11, 15, .24), 0 6px 18px rgba(5, 11, 15, .14);
    }

    .facility-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 36px;
        gap: 24px;
        flex-wrap: wrap;
    }

    .facility-header-text {
        flex: 1;
        min-width: 0;
    }

    .facility-eyebrow {
        font-size: .75rem;
        font-weight: 700;
        letter-spacing: .15em;
        text-transform: uppercase;
        color: #4da3ff;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .facility-eyebrow::before {
        content: '';
        display: inline-block;
        width: 24px;
        height: 2px;
        background: var(--blue);
        border-radius: 2px;
    }

    .facility-title {
        font-size: clamp(1.6rem, 2.8vw, 2.4rem);
        font-weight: 800;
        color: #fff;
        line-height: 1.18;
        margin: 0 0 12px;
    }

    .oswald-facility-title {
        font-family: "Oswald", sans-serif;
        font-optical-sizing: auto;
        font-weight: 700;
        font-style: normal;
    }

    .facility-title-accent {
        color: #0d6efd;
    }


    .facility-desc {
        font-size: .93rem;
        color: rgba(255, 255, 255, .72);
        line-height: 1.6;
        max-width: 520px;
        margin: 0;
    }

    .montserrat-facility-desc {
        font-family: "Montserrat", sans-serif;
        font-optical-sizing: auto;
        font-weight: 300;
        font-style: normal;
    }


    .facility-nav {
        display: flex;
        gap: 10px;
        flex-shrink: 0;
    }

    .nav-btn {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        border: 1.5px solid rgba(255, 255, 255, .22);
        background: rgba(255, 255, 255, .08);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.05rem;
        cursor: pointer;
        transition: background .18s, border-color .18s, transform .15s;
    }

    .nav-btn:hover {
        background: rgba(255, 255, 255, .18);
        border-color: rgba(255, 255, 255, .5);
        transform: scale(1.06);
    }

    .facility-carousel-wrapper {
        overflow: hidden;
        margin: 0 -4px;
    }

    .facility-track {
        display: flex;
        gap: 20px;
        transition: transform .42s cubic-bezier(.45, .05, .35, .95);
        will-change: transform;
    }

    .facility-card {
        flex: 0 0 calc((100% - 40px) / 3);
        height: 460px;
        border-radius: 28px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
        box-shadow: 0 4px 24px rgba(0, 0, 0, .35);
    }

    .facility-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .5s ease;
    }

    .facility-card:hover img {
        transform: scale(1.06);
    }

    .facility-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(8, 12, 18, .92) 0%, rgba(8, 12, 18, .35) 45%, transparent 75%);
        pointer-events: none;
    }

    .facility-card-name {
        position: absolute;
        bottom: 22px;
        left: 22px;
        right: 22px;
        color: #fff;
        font-size: 1.18rem;
        font-weight: 800;
        line-height: 1.25;
        text-shadow: 0 2px 8px rgba(0, 0, 0, .5);
    }

    .noto-sans-facility-desc {
        font-family: "Noto Sans", sans-serif;
        font-optical-sizing: auto;
        font-weight: 400;
        font-style: normal;
        font-variation-settings:
            "wdth" 100;
    }


    .facility-dots {
        display: flex;
        justify-content: center;
        gap: 7px;
        margin-top: 28px;
    }

    .facility-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .22);
        cursor: pointer;
        transition: background .2s, transform .2s;
        border: none;
        padding: 0;
    }

    .facility-dot.active {
        background: #fff;
        transform: scale(1.25);
    }

    @media (max-width: 991px) {
        .facility-showcase-card {
            padding: 40px 36px;
            border-radius: 32px;
        }

        .facility-card {
            flex: 0 0 calc((100% - 20px) / 2);
            height: 420px;
        }
    }

    @media (max-width: 767px) {
        .facility-section {
            padding: 0 12px 8px;
        }

        .facility-showcase-card {
            padding: 28px 20px;
            border-radius: 26px;
        }

        .facility-header {
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 24px;
        }

        .facility-nav {
            align-self: flex-end;
        }

        .facility-card {
            flex: 0 0 100%;
            height: 390px;
        }

        .facility-track {
            gap: 16px;
        }

        .nav-btn {
            width: 42px;
            height: 42px;
            font-size: 1rem;
        }
    }
</style>
@endpush

<section class="facility-section" id="fasilitas">
    <div class="facility-showcase-card">
        <div class="facility-header">
            <div class="facility-header-text">
                <h2 class="facility-title oswald-facility-title">FASILITAS <span class="facility-title-accent">LATIHAN</span> KAMI</h2>
                <p class="facility-desc montserrat-facility-desc">Nikmati pengalaman latihan yang lebih nyaman dengan fasilitas gym yang lengkap, area luas, dan lingkungan yang mendukung progres latihan kamu</p>
            </div>
            <div class="facility-nav">
                <button class="nav-btn" id="facilityPrev" aria-label="Sebelumnya"><i class="bi bi-chevron-left"></i></button>
                <button class="nav-btn" id="facilityNext" aria-label="Berikutnya"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>

        <div class="facility-carousel-wrapper">
            <div class="facility-track" id="facilityTrack">
                <div class="facility-card">
                    <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=800&q=80" alt="Area Latihan Luas" loading="lazy">
                    <div class="facility-card-overlay"></div>
                    <div class="facility-card-name noto-sans-facility-desc">Area Latihan Luas</div>
                </div>
                <div class="facility-card">
                    <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=800&q=80" alt="Alat Gym Lengkap" loading="lazy">
                    <div class="facility-card-overlay"></div>
                    <div class="facility-card-name noto-sans-facility-desc">Alat Gym Lengkap</div>
                </div>
                <div class="facility-card">
                    <img src="https://images.unsplash.com/photo-1540497077202-7c8a3999166f?w=800&q=80" alt="Area Cardio" loading="lazy">
                    <div class="facility-card-overlay"></div>
                    <div class="facility-card-name noto-sans-facility-desc">Area Cardio</div>
                </div>
                <div class="facility-card">
                    <img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=800&q=80" alt="Loker Penyimpanan" loading="lazy">
                    <div class="facility-card-overlay"></div>
                    <div class="facility-card-name noto-sans-facility-desc">Loker Penyimpanan</div>
                </div>
                <div class="facility-card">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80" alt="Parkir Luas" loading="lazy">
                    <div class="facility-card-overlay"></div>
                    <div class="facility-card-name noto-sans-facility-desc">Parkir Luas</div>
                </div>
                <div class="facility-card">
                    <img src="https://images.unsplash.com/photo-1576678927484-cc907957088c?w=800&q=80" alt="Ruang Latihan Nyaman" loading="lazy">
                    <div class="facility-card-overlay"></div>
                    <div class="facility-card-name noto-sans-facility-desc">Ruang Latihan Nyaman</div>
                </div>
            </div>
        </div>
        <div class="facility-dots" id="facilityDots"></div>
    </div>
</section>
