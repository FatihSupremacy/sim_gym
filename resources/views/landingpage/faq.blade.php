@push('styles')
<style>
    .faq-section {
        padding: 0 20px 8px;
    }

    .faq-showcase-card {
        position: relative;
        max-width: 1320px;
        margin: 0 auto;
        min-height: 620px;
        border-radius: 40px;
        overflow: hidden;
        padding: 56px;
        background-image: url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=1600&q=80');
        background-size: cover;
        background-position: center;
        box-shadow: 0 24px 64px rgba(5, 11, 15, .24), 0 6px 18px rgba(5, 11, 15, .14);
    }

    .faq-showcase-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(10, 10, 18, .88) 0%, rgba(15, 20, 35, .80) 100%);
        z-index: 0;
    }

    .faq-inner {
        position: relative;
        z-index: 1;
    }

    .faq-left-col {
        color: #fff;
        padding-right: 32px;
    }

    .faq-title {
        font-size: clamp(2.55rem, 5.2vw, 4.2rem);
        font-weight: 800;
        line-height: 1.05;
        margin-bottom: 18px;
        color: #0d6efd;
    }

    .oswald-faq-title {
        font-family: "Oswald", sans-serif;
        font-optical-sizing: auto;
        font-weight: 700;
        font-style: normal;
    }

    .faq-desc {
        font-size: 1rem;
        color: rgba(255, 255, 255, .78);
        line-height: 1.65;
        margin-bottom: 32px;
        max-width: 340px;
    }

    .montserrat-faq-desc {
        font-family: "Montserrat", sans-serif;
        font-optical-sizing: auto;
        font-weight: 400;
        font-style: normal;
    }

    .btn-faq-contact {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fff;
        color: #111;
        border: none;
        border-radius: 50px;
        padding: 13px 26px;
        font-weight: 600;
        font-size: .92rem;
        text-decoration: none;
        transition: background .2s ease, transform .15s ease, box-shadow .2s ease;
    }

    .btn-faq-contact:hover {
        background: #f0f0f0;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, .25);
        color: #111;
    }

    .faq-deco {
        margin-top: 44px;
        opacity: .18;
        line-height: 1;
    }

    .faq-deco i {
        font-size: 6.5rem;
        color: #4dd9c0;
    }

    .faq-right-col {
        padding-left: 8px;
    }

    .faq-search-wrap {
        position: relative;
        margin-bottom: 22px;
    }

    .faq-search-input {
        width: 100%;
        height: 54px;
        border-radius: 50px;
        border: 1.5px solid rgba(255, 255, 255, .32);
        background: rgba(255, 255, 255, .14);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        padding: 0 54px 0 22px;
        font-size: .95rem;
        color: #fff;
        outline: none;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .28), 0 12px 32px rgba(0, 0, 0, .18);
        transition: border-color .2s, box-shadow .2s, background .2s;
    }

    .faq-search-input::placeholder {
        color: rgba(255, 255, 255, .72);
    }

    .faq-search-input:focus {
        border-color: rgba(13, 110, 253, .72);
        background: rgba(255, 255, 255, .18);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .32), 0 0 0 3px rgba(13, 110, 253, .18), 0 14px 36px rgba(0, 0, 0, .22);
    }

    .faq-search-btn {
        position: absolute;
        right: 6px;
        top: 50%;
        transform: translateY(-50%);
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .92);
        border: none;
        color: #111;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        cursor: pointer;
        transition: background .2s;
    }

    .faq-search-btn:hover {
        background: #fff;
    }

    .faq-accordion {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .faq-accordion .accordion-item {
        border: 1.5px solid rgba(255, 255, 255, .12);
        border-radius: 24px !important;
        overflow: hidden;
        background: #fff;
    }

    .faq-accordion .accordion-button {
        background: #fff;
        color: #111;
        font-weight: 600;
        font-size: .95rem;
        border-radius: 24px !important;
        padding: 18px 22px;
        line-height: 1.4;
        box-shadow: none !important;
        transition: background .15s;
    }

    .faq-accordion .accordion-button:not(.collapsed) {
        background: #f7f7f7;
        color: #111;
        border-radius: 24px 24px 0 0 !important;
    }

    .faq-accordion .accordion-button:focus {
        box-shadow: none;
        outline: none;
    }

    .faq-accordion .accordion-button::after {
        display: none;
    }

    .faq-accordion .accordion-button .faq-chevron {
        margin-left: auto;
        flex-shrink: 0;
        font-size: 1.05rem;
        color: #666;
        transition: transform .25s ease;
    }

    .faq-accordion .accordion-button:not(.collapsed) .faq-chevron {
        transform: rotate(180deg);
        color: #333;
    }

    .faq-accordion .accordion-body {
        background: #fff;
        color: #555;
        font-size: .92rem;
        line-height: 1.75;
        padding: 6px 22px 20px;
        border-radius: 0 0 24px 24px;
    }

    .faq-accordion .accordion-item.hidden-faq {
        display: none;
    }

    @media (max-width: 991px) {
        .faq-left-col {
            padding-right: 0;
            margin-bottom: 40px;
            text-align: center;
        }

        .faq-desc {
            max-width: 100%;
        }

        .faq-deco {
            display: none;
        }

        .faq-showcase-card {
            padding: 40px 36px;
            border-radius: 32px;
        }
    }

    @media (max-width: 767px) {
        .faq-section {
            padding: 0 12px 8px;
        }

        .faq-showcase-card {
            padding: 28px 20px;
            border-radius: 26px;
        }
    }

    @media (max-width: 575px) {
        .faq-section {
            padding: 0 12px 8px;
        }

        .faq-title {
            font-size: 2.15rem;
        }

        .faq-search-input {
            height: 50px;
            font-size: .9rem;
        }
    }
</style>
@endpush

<section class="faq-section" id="faq">
    <div class="faq-showcase-card">
        <div class="faq-inner">
            <div class="row align-items-center g-0">
                <div class="col-lg-5">
                    <div class="faq-left-col">
                        <h2 class="faq-title oswald-faq-title">FREQUENTLY ASKED<br>QUESTION</h2>
                        <p class="faq-desc montserrat-faq-desc">Punya pertanyaan seputar membership, fasilitas, atau jadwal latihan? Temukan jawabannya di sini</p>
                        <a href="#footer" class="btn-faq-contact">Contact Us <i class="bi bi-arrow-right-circle-fill"></i></a>
                        <div class="faq-deco"><i class="bi bi-dumbbell"></i></div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="faq-right-col">
                        <div class="faq-search-wrap">
                            <input type="text" class="faq-search-input" id="faqSearch" placeholder="Cari pertanyaan...">
                            <button class="faq-search-btn" aria-label="Cari"><i class="bi bi-search"></i></button>
                        </div>
                        <div class="faq-accordion" id="faqAccordion">
                            <div class="accordion-item" data-question="jam operasional gym buka jam berapa">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                        Jam operasional gym buka jam berapa?
                                        <i class="bi bi-chevron-down faq-chevron"></i>
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Gym buka setiap hari dari pukul 09.00 hingga 22.00 WIB. Pada hari libur nasional, jam operasional bisa berubah dan akan diinformasikan melalui media sosial kami.</div>
                                </div>
                            </div>
                            <div class="accordion-item" data-question="apakah ada paket trial atau coba sebelum daftar">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                        Apakah ada paket trial atau coba sebelum daftar?
                                        <i class="bi bi-chevron-down faq-chevron"></i>
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Ya, kami menyediakan paket harian seharga Rp15.000 yang bisa Anda gunakan untuk mencoba fasilitas gym sebelum memutuskan menjadi member bulanan.</div>
                                </div>
                            </div>
                            <div class="accordion-item" data-question="bagaimana cara mendaftar menjadi member">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                        Bagaimana cara mendaftar menjadi member?
                                        <i class="bi bi-chevron-down faq-chevron"></i>
                                    </button>
                                </h2>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Anda bisa mendaftar langsung di lokasi atau melalui website kami. Pilih paket yang diinginkan, lalu ikuti langkah pendaftaran yang tersedia.</div>
                                </div>
                            </div>
                            <div class="accordion-item" data-question="apakah membership bisa dipindahkan ke orang lain">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                        Apakah membership bisa dipindahkan ke orang lain?
                                        <i class="bi bi-chevron-down faq-chevron"></i>
                                    </button>
                                </h2>
                                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">Maaf, membership tidak dapat dipindahkan ke orang lain. Namun, Anda bisa mengajukan pembekuan membership dalam kondisi tertentu.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
