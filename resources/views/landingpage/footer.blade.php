@push('styles')
<style>
    .footer-section {
        margin-top: 25px;
        padding: 0 20px 0;
    }

    .site-footer-card {
        position: relative;
        max-width: 1320px;
        margin: 0 auto;
        background: #111217;
        border-radius: 40px;
        padding: 56px 56px 0;
        overflow: hidden;
        box-shadow: 0 24px 64px rgba(5, 11, 15, .24), 0 6px 18px rgba(5, 11, 15, .14);
    }

    .footer-logo {
        display: inline-flex;
        align-items: center;
        margin-bottom: 18px;
        text-decoration: none;
    }

    .footer-logo-img {
        display: block;
        width: 220px;
        max-width: 100%;
        height: auto;
        object-fit: contain;
        border-radius: 0;
    }

    .footer-desc {
        font-size: .875rem;
        color: rgba(255, 255, 255, .65);
        line-height: 1.7;
        max-width: 260px;
    }

    .footer-col-title {
        color: #fff;
        font-size: .82rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-bottom: 18px;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .footer-links a {
        color: rgba(255, 255, 255, .68);
        text-decoration: none;
        font-size: .9rem;
        transition: color .18s;
    }

    .footer-links a:hover {
        color: var(--blue);
    }

    .footer-contact-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .footer-contact-list li {
        font-size: .875rem;
        color: rgba(255, 255, 255, .68);
        line-height: 1.5;
    }

    .footer-contact-list li strong {
        color: rgba(255, 255, 255, .9);
        display: block;
        font-size: .82rem;
        font-weight: 700;
        letter-spacing: .04em;
    }

    .footer-social {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 4px;
    }

    .footer-social-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .12);
        color: #fff;
        font-size: 1.1rem;
        text-decoration: none;
        transition: background .2s ease, border-color .2s ease, transform .15s ease;
    }

    .footer-social-icon:hover {
        background: var(--blue);
        border-color: var(--blue);
        color: #fff;
        transform: translateY(-2px);
    }

    .footer-divider {
        border: none;
        border-top: 1px solid rgba(255, 255, 255, .1);
        margin: 48px 0 28px;
    }

    .footer-copyright {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        padding-bottom: 28px;
    }

    .footer-copyright-text {
        font-size: .82rem;
        color: rgba(255, 255, 255, .4);
        margin: 0;
    }

    .footer-legal-links {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .footer-legal-links a {
        font-size: .82rem;
        color: rgba(255, 255, 255, .4);
        text-decoration: none;
        transition: color .18s;
    }

    .footer-legal-links a:hover {
        color: rgba(255, 255, 255, .85);
    }

    .footer-brand-text {
        display: flex;
        align-items: flex-end;
        justify-content: center;
        font-size: clamp(28px, 5.6vw, 76px);
        font-weight: 900;
        line-height: .95;
        color: var(--blue);
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        margin-left: -56px;
        margin-right: -56px;
        padding: 12px 28px 0;
        width: calc(100% + 112px);
        margin-bottom: -.1em;
    }

    .footer-brand-text-inner {
        display: inline-block;
        font-family: "Monoton", sans-serif;
        font-weight: 400;
        font-style: normal;
        word-spacing: .28em;
        transform: scaleY(1.5);
        transform-origin: center top;
        margin-bottom: .45em;
    }

    @media (max-width: 991px) {
        .site-footer-card {
            padding: 40px 36px 0;
        }

        .footer-brand-text {
            font-size: clamp(24px, 5.2vw, 60px);
            margin-left: -36px;
            margin-right: -36px;
            padding: 10px 22px 0;
            width: calc(100% + 72px);
        }
    }

    @media (max-width: 767px) {
        .footer-section {
            margin-top: -30px;
            padding: 0 12px;
        }

        .site-footer-card {
            padding: 32px 24px 0;
            border-radius: 26px;
            transform: translateY(28px);
        }

        .footer-desc {
            max-width: 100%;
        }

        .footer-copyright {
            flex-direction: column;
            align-items: flex-start;
        }

        .footer-brand-text {
            font-size: clamp(18px, 5.5vw, 38px);
            margin-left: -24px;
            margin-right: -24px;
            padding: 8px 14px 0;
            width: calc(100% + 48px);
        }
    }
</style>
@endpush

<footer class="footer-section" id="footer">
    <div class="site-footer-card">
        <div class="row g-5 mb-0">
            <div class="col-12 col-sm-6 col-lg-3">
                <a href="#home" class="footer-logo">
                    <img src="{{ asset('assets/logo-navbar-2.png') }}" alt="Limus Fitness Centre" class="footer-logo-img">
                </a>
            </div>

            <div class="col-6 col-sm-6 col-lg-2">
                <p class="footer-col-title">Menu</p>
                <ul class="footer-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#fasilitas">Fasilitas</a></li>
                    <li><a href="#paket">Paket Membership</a></li>
                    <li><a href="#testimoni">Testimoni</a></li>
                    <li><a href="#faq">FAQ</a></li>
                </ul>
            </div>

            <div class="col-6 col-sm-6 col-lg-2">
                <p class="footer-col-title">Membership</p>
                <ul class="footer-links">
                    <li><a href="#paket">Paket Harian</a></li>
                    <li><a href="#paket">Paket Bulanan</a></li>
                    <li><a href="{{ route('register') }}">Daftar Member</a></li>
                    <li><a href="#paket">Cek Promo</a></li>
                </ul>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <p class="footer-col-title">Kontak</p>
                <ul class="footer-contact-list">
                    <li><strong>Limus Fitness Centre</strong>Bekasi, Indonesia</li>
                    <li><strong>WhatsApp</strong>08xx-xxxx-xxxx</li>
                    <li><strong>Email</strong>info@limusfitness.com</li>
                </ul>
            </div>

            <div class="col-12 col-sm-6 col-lg-2">
                <p class="footer-col-title">Ikuti Kami</p>
                <div class="footer-social">
                    <a href="#" class="footer-social-icon" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="footer-social-icon" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    <a href="#" class="footer-social-icon" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
                    <a href="#" class="footer-social-icon" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>

        <hr class="footer-divider">

        <div class="footer-copyright">
            <p class="footer-copyright-text">&copy; 2026 Limus Fitness Centre. All rights reserved.</p>
            <div class="footer-legal-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms &amp; Conditions</a>
                <a href="#footer">Contact</a>
            </div>
        </div>

        <span class="footer-brand-text" aria-hidden="true">
            <span class="footer-brand-text-inner">LIMUS FITNESS CENTRE</span>
        </span>
    </div>
</footer>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script>
    (function() {
        const track = document.getElementById('facilityTrack');
        const prevBtn = document.getElementById('facilityPrev');
        const nextBtn = document.getElementById('facilityNext');
        const dotsWrap = document.getElementById('facilityDots');

        if (!track || !prevBtn || !nextBtn || !dotsWrap) return;

        const cards = track.querySelectorAll('.facility-card');
        const total = cards.length;
        let currentIndex = 0;

        function getVisible() {
            const w = window.innerWidth;
            if (w >= 992) return 3;
            if (w >= 768) return 2;
            return 1;
        }

        function totalSteps() {
            return total - getVisible() + 1;
        }

        function renderDots() {
            dotsWrap.innerHTML = '';
            for (let i = 0; i < totalSteps(); i++) {
                const dot = document.createElement('button');
                dot.className = 'facility-dot' + (i === currentIndex ? ' active' : '');
                dot.setAttribute('aria-label', 'Slide ' + (i + 1));
                dot.addEventListener('click', () => goTo(i));
                dotsWrap.appendChild(dot);
            }
        }

        function updateDots() {
            dotsWrap.querySelectorAll('.facility-dot').forEach((dot, index) => {
                dot.classList.toggle('active', index === currentIndex);
            });
        }

        function goTo(index) {
            currentIndex = Math.max(0, Math.min(index, totalSteps() - 1));
            const gap = window.innerWidth <= 767 ? 16 : 20;
            const cardWidth = cards[0].getBoundingClientRect().width;
            track.style.transform = `translateX(-${currentIndex * (cardWidth + gap)}px)`;
            updateDots();
        }

        function autoNext() {
            goTo(currentIndex >= totalSteps() - 1 ? 0 : currentIndex + 1);
        }

        prevBtn.addEventListener('click', () => goTo(currentIndex - 1));
        nextBtn.addEventListener('click', () => goTo(currentIndex + 1));

        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                currentIndex = 0;
                track.style.transition = 'none';
                track.style.transform = 'translateX(0)';
                setTimeout(() => {
                    track.style.transition = '';
                }, 50);
                renderDots();
            }, 200);
        });

        let touchStartX = 0;
        track.addEventListener('touchstart', event => {
            touchStartX = event.touches[0].clientX;
        }, {
            passive: true
        });
        track.addEventListener('touchend', event => {
            const diff = touchStartX - event.changedTouches[0].clientX;
            if (Math.abs(diff) > 40) diff > 0 ? goTo(currentIndex + 1) : goTo(currentIndex - 1);
        });

        renderDots();
        setInterval(autoNext, 5000);
    })();

    (function() {
        const track = document.getElementById('tTrack');
        const prev = document.getElementById('tPrev');
        const next = document.getElementById('tNext');
        const dotsEl = document.getElementById('tDots');

        if (!track || !prev || !next || !dotsEl) return;

        const cards = track.querySelectorAll('.testimonial-card');
        const total = cards.length;
        let idx = 0;

        function getVisible() {
            const w = window.innerWidth;
            if (w >= 992) return 3;
            if (w >= 768) return 2;
            return 1;
        }

        function getGap() {
            return window.innerWidth <= 767 ? 16 : 22;
        }

        function steps() {
            return total - getVisible() + 1;
        }

        function renderDots() {
            dotsEl.innerHTML = '';
            for (let i = 0; i < steps(); i++) {
                const dot = document.createElement('button');
                dot.className = 't-dot' + (i === idx ? ' active' : '');
                dot.setAttribute('aria-label', 'Slide ' + (i + 1));
                dot.addEventListener('click', () => goTo(i));
                dotsEl.appendChild(dot);
            }
        }

        function updateDots() {
            dotsEl.querySelectorAll('.t-dot').forEach((dot, index) => {
                dot.classList.toggle('active', index === idx);
            });
        }

        function goTo(index) {
            idx = Math.max(0, Math.min(index, steps() - 1));
            const cardWidth = cards[0].getBoundingClientRect().width;
            track.style.transform = `translateX(-${idx * (cardWidth + getGap())}px)`;
            updateDots();
        }

        prev.addEventListener('click', () => goTo(idx - 1));
        next.addEventListener('click', () => goTo(idx + 1));

        let touchStartX = 0;
        track.addEventListener('touchstart', event => {
            touchStartX = event.touches[0].clientX;
        }, {
            passive: true
        });
        track.addEventListener('touchend', event => {
            const diff = touchStartX - event.changedTouches[0].clientX;
            if (Math.abs(diff) > 40) diff > 0 ? goTo(idx + 1) : goTo(idx - 1);
        });

        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                idx = 0;
                track.style.transition = 'none';
                track.style.transform = 'translateX(0)';
                setTimeout(() => {
                    track.style.transition = '';
                }, 50);
                renderDots();
            }, 200);
        });

        renderDots();
    })();

    (function() {
        const searchInput = document.getElementById('faqSearch');
        const searchBtn = document.querySelector('.faq-search-btn');
        const faqItems = document.querySelectorAll('.faq-accordion .accordion-item');

        if (!searchInput || !searchBtn || !faqItems.length) return;

        function filterFAQ() {
            const query = searchInput.value.trim().toLowerCase();
            faqItems.forEach(item => {
                const question = item.getAttribute('data-question') || '';
                const answer = item.querySelector('.accordion-body')?.textContent.toLowerCase() || '';
                const matches = !query || question.includes(query) || answer.includes(query);
                item.classList.toggle('hidden-faq', !matches);
            });
        }

        searchInput.addEventListener('input', filterFAQ);
        searchBtn.addEventListener('click', filterFAQ);
    })();

    (function() {
        const wrapper = document.querySelector('.footer-brand-text');
        const text = document.querySelector('.footer-brand-text-inner');
        const card = document.querySelector('.site-footer-card');

        if (!wrapper || !text || !card) return;

        function fitBrandText() {
            wrapper.style.fontSize = '100px';
            const horizontalPadding = parseFloat(getComputedStyle(wrapper).paddingLeft) * 2;
            const availableWidth = card.clientWidth - horizontalPadding;
            const ratio = availableWidth / text.scrollWidth;
            wrapper.style.fontSize = Math.floor(100 * ratio * .86) + 'px';
        }

        fitBrandText();
        window.addEventListener('resize', fitBrandText);
    })();
</script>
@endpush