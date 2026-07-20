@push('styles')
<style>
    /* ── Section ─────────────────────────────── */
    .t-section {
        width: calc(100% - 40px);
        max-width: 1320px;
        padding: 64px 0 32px;
        margin: 0 auto;
    }

    /* ── Header ──────────────────────────────── */
    .t-eyebrow {
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .16em;
        text-transform: uppercase;
        color: #0d6efd;
        margin-bottom: 10px;
    }

    .t-title {
        font-size: clamp(1.9rem, 4vw, 3rem);
        font-weight: 800;
        color: #1a1a1a;
        text-transform: uppercase;
        line-height: 1.05;
        letter-spacing: -.3px;
        margin-bottom: 0;
        text-align: center;
    }

    .t-title-highlight {
        color: #0d6efd;
    }

    .oswald-t-title {
        font-family: "Oswald", sans-serif;
        font-optical-sizing: auto;
        font-weight: 800;
        font-style: normal;
    }

    .t-header {
        position: relative;
        display: flex;
        justify-content: center;
        margin-bottom: 3rem;
    }

    /* ── Clip window ─────────────────────────── */
    .t-clip {
        overflow: hidden;
    }

    /* ── Track ───────────────────────────────── */
    .t-track {
        display: flex;
        gap: 20px;
        transition: transform .44s cubic-bezier(.45, .05, .35, .95);
        will-change: transform;
    }

    /* ── Card ────────────────────────────────── */
    .t-card {
        flex: 0 0 calc((100% - 40px) / 3);
        background: rgba(255, 255, 255, .34);
        border-radius: 28px;
        border: 1.5px solid rgba(255, 255, 255, .42);
        box-shadow: none;
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        display: flex;
        flex-direction: column;
        min-height: 360px;
        overflow: hidden;
        transition: border-color .22s ease;
    }

    .t-card:hover {
        border-color: rgba(13, 110, 253, .42);
        background: rgba(255, 255, 255, .44);
    }

    /* ── Quote body ──────────────────────────── */
    .t-quote-body {
        flex: 1;
        padding: 40px 32px 28px;
        display: flex;
        align-items: flex-start;
    }

    .t-quote-text {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1a1a1a;
        line-height: 1.65;
        margin: 0;
    }

    .elms-sans-t-quote-text {
        font-family: "Elms Sans", sans-serif;
        font-optical-sizing: auto;
        font-weight: 400;
        font-style: normal;
    }

    /* ── Profile footer ──────────────────────── */
    .t-profile {
        padding: 24px 32px 32px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .t-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(13, 110, 253, .12);
        border: 2px solid rgba(13, 110, 253, .18);
        color: #0d6efd;
        font-size: 1.65rem;
        line-height: 1;
        flex-shrink: 0;
    }

    .t-avatar i {
        line-height: 1;
    }

    .t-name {
        font-size: 1rem;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }

    .t-label {
        font-size: .8rem;
        color: #6b7280;
        margin: 0;
    }

    /* ── Nav ─────────────────────────────────── */
    .t-nav {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .t-header .t-nav {
        position: absolute;
        right: 0;
        bottom: 0;
    }

    .t-btn {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: #111111;
        border: 1.5px solid #111111;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        cursor: pointer;
        transition: background .18s, border-color .18s, transform .15s;
    }

    .t-btn:hover {
        background: #000000;
        border-color: #000000;
        color: #ffffff;
        transform: scale(1.08);
    }

    .t-btn:disabled {
        opacity: .35;
        cursor: default;
        transform: none;
    }

    /* ── Dots ────────────────────────────────── */
    .t-dots {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .t-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: rgba(26, 26, 26, .22);
        border: none;
        padding: 0;
        cursor: pointer;
        transition: background .2s, transform .2s;
    }

    .t-dot.active {
        background: #1a1a1a;
        transform: scale(1.4);
    }

    /* ── Responsive ──────────────────────────── */
    @media (max-width: 991px) {
        .t-card {
            flex: 0 0 calc((100% - 20px) / 2);
        }
    }

    @media (max-width: 767px) {
        .t-section {
            width: calc(100% - 24px);
            padding: 48px 0 32px;
        }

        .t-card {
            flex: 0 0 100%;
            min-height: 300px;
        }

        .t-track {
            gap: 16px;
        }

        .t-quote-body {
            padding: 28px 24px 20px;
        }

        .t-profile {
            padding: 18px 24px 26px;
        }

        .facility-nav {
            display: flex;
            gap: 10px;
            flex-shrink: 0;
        }
    }
</style>
@endpush

<section class="t-section" id="testimoni">

    <div class="t-header">
        <div>
            <h2 class="t-title oswald-t-title">Apa Kata<br><span class="t-title-highlight">Member</span> Kami</h2>
        </div>
        <div class="t-nav d-none d-md-flex">
            <button class="t-btn" id="tPrev" aria-label="Sebelumnya"><i class="bi bi-chevron-left"></i></button>
            <button class="t-btn" id="tNext" aria-label="Berikutnya"><i class="bi bi-chevron-right"></i></button>
        </div>
    </div>

    <div class="t-clip">
        <div class="t-track" id="tTrack">

            <div class="t-card">
                <div class="t-quote-body">
                    <p class="t-quote-text elms-sans-t-quote-text">Tempatnya nyaman, alatnya lengkap, dan suasananya bikin latihan lebih konsisten setiap hari.</p>
                </div>
                <div class="t-profile">
                    <span class="t-avatar" aria-hidden="true"><i class="bi bi-person-fill"></i></span>
                    <div>
                        <p class="t-name">Andi Pratama</p>
                        <p class="t-label">Member Bulanan</p>
                    </div>
                </div>
            </div>

            <div class="t-card">
                <div class="t-quote-body">
                    <p class="t-quote-tex elms-sans-t-quote-textt">Area latihannya luas, jadi tidak terasa sempit meskipun sedang ramai. Betah latihan lama.</p>
                </div>
                <div class="t-profile">
                    <span class="t-avatar" aria-hidden="true"><i class="bi bi-person-fill"></i></span>
                    <div>
                        <p class="t-name">Rizky Maulana</p>
                        <p class="t-label">Member Aktif</p>
                    </div>
                </div>
            </div>

            <div class="t-card">
                <div class="t-quote-body">
                    <p class="t-quote-text elms-sans-t-quote-text">Saya suka karena tersedia paket harian dan bulanan, jadi lebih fleksibel sesuai jadwal kerja.</p>
                </div>
                <div class="t-profile">
                    <span class="t-avatar" aria-hidden="true"><i class="bi bi-person-fill"></i></span>
                    <div>
                        <p class="t-name">Fajar Ramadhan</p>
                        <p class="t-label">Member Harian</p>
                    </div>
                </div>
            </div>

            <div class="t-card">
                <div class="t-quote-body">
                    <p class="t-quote-text elms-sans-t-quote-text">Lokasinya mudah dijangkau, parkirnya luas, dan fasilitasnya cukup lengkap untuk semua kebutuhan.</p>
                </div>
                <div class="t-profile">
                    <span class="t-avatar" aria-hidden="true"><i class="bi bi-person-fill"></i></span>
                    <div>
                        <p class="t-name">Dimas Saputra</p>
                        <p class="t-label">Member Bulanan</p>
                    </div>
                </div>
            </div>

            <div class="t-card">
                <div class="t-quote-body">
                    <p class="t-quote-text elms-sans-t-quote-text">Cocok untuk pemula karena tempatnya nyaman dan tidak membuat canggung saat pertama kali datang.</p>
                </div>
                <div class="t-profile">
                    <span class="t-avatar" aria-hidden="true"><i class="bi bi-person-fill"></i></span>
                    <div>
                        <p class="t-name">Aldi Nugraha</p>
                        <p class="t-label">Member Baru</p>
                    </div>
                </div>
            </div>

            <div class="t-card">
                <div class="t-quote-body">
                    <p class="t-quote-text elms-sans-t-quote-text">Loker tersedia dan area gym bersih, jadi latihan terasa lebih aman, nyaman, dan fokus.</p>
                </div>
                <div class="t-profile">
                    <span class="t-avatar" aria-hidden="true"><i class="bi bi-person-fill"></i></span>
                    <div>
                        <p class="t-name">Bima Setiawan</p>
                        <p class="t-label">Member Aktif</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="t-nav d-flex d-md-none justify-content-center mt-4">
        <button class="t-btn" id="tPrevMob" aria-label="Sebelumnya"><i class="bi bi-arrow-left"></i></button>
        <div class="t-dots" id="tDotsMob"></div>
        <button class="t-btn" id="tNextMob" aria-label="Berikutnya"><i class="bi bi-arrow-right"></i></button>
    </div>

</section>

@push('scripts')
<script>
    (function() {
        const track = document.getElementById('tTrack');
        if (!track) return;

        const cards = Array.from(track.children);
        const total = cards.length;
        let current = 0;

        const sets = {
            prev: [document.getElementById('tPrev'), document.getElementById('tPrevMob')],
            next: [document.getElementById('tNext'), document.getElementById('tNextMob')],
            dots: [document.getElementById('tDots'), document.getElementById('tDotsMob')],
        };

        function perView() {
            if (window.innerWidth >= 992) return 3;
            if (window.innerWidth >= 768) return 2;
            return 1;
        }

        function maxPage() {
            return total - perView();
        }

        function buildDots() {
            const n = maxPage() + 1;
            sets.dots.forEach(el => {
                if (!el) return;
                el.innerHTML = '';
                for (let i = 0; i < n; i++) {
                    const d = document.createElement('button');
                    d.className = 't-dot' + (i === current ? ' active' : '');
                    d.setAttribute('aria-label', 'Slide ' + (i + 1));
                    d.addEventListener('click', () => goTo(i));
                    el.appendChild(d);
                }
            });
        }

        function goTo(index) {
            current = Math.max(0, Math.min(index, maxPage()));

            const gap = parseInt(getComputedStyle(track).gap) || 20;
            const cardW = cards[0].getBoundingClientRect().width;
            track.style.transform = `translateX(-${current * (cardW + gap)}px)`;

            sets.dots.forEach(el => {
                if (!el) return;
                el.querySelectorAll('.t-dot').forEach((d, i) =>
                    d.classList.toggle('active', i === current)
                );
            });

            sets.prev.forEach(b => {
                if (b) b.disabled = current === 0;
            });
            sets.next.forEach(b => {
                if (b) b.disabled = current >= maxPage();
            });
        }

        function autoNext() {
            goTo(current >= maxPage() ? 0 : current + 1);
        }

        sets.prev.forEach(b => b && b.addEventListener('click', () => goTo(current - 1)));
        sets.next.forEach(b => b && b.addEventListener('click', () => goTo(current + 1)));

        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                if (current > maxPage()) current = maxPage();
                buildDots();
                goTo(current);
            }, 120);
        });

        buildDots();
        goTo(0);
        setInterval(autoNext, 5000);
    })();
</script>
@endpush
