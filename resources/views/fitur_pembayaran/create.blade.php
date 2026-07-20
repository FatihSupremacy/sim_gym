@extends('layout.master')

@section('content')

<style>
    /* ── Font ── */
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* ── Stepper ── */
    .stepper {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .stepper li {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .step-num {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1.5px solid #dee2e6;
        background: #fff;
        color: #6c757d;
        transition: all .2s;
    }

    .step-num.active {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }

    .step-num.done {
        background: #d1e7dd;
        border-color: #a3cfbb;
        color: #146c43;
    }

    .step-connector {
        width: 28px;
        height: 1px;
        background: #dee2e6;
    }

    .step-connector.done {
        background: #a3cfbb;
    }

    #btn-next.disabled {
        pointer-events: none;
        opacity: 0.6;
    }

    /* ── Member list ── */
    .member-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
        max-height: 260px;
        overflow-y: auto;
        padding: 0;
        margin-top: .5rem;
    }

    .member-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        cursor: pointer;
        list-style: none;
        transition: border-color .15s, background .15s;
    }

    .member-item:hover {
        border-color: #9ec5fe;
        background: #f0f6ff;
    }

    /* ── Avatar ── */
    .avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        font-size: 12px;
        font-weight: 600;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ── Selected member card ── */
    .selected-member-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 12px 14px;
        background: #f0f6ff;
        border: 1px solid #9ec5fe;
        border-radius: 8px;
    }

    /* ── Metode grid ── */
    .metode-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }

    .metode-btn {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 12px 8px 10px;
        text-align: center;
        cursor: pointer;
        background: #fff;
        font-family: inherit;
        font-size: 12px;
        font-weight: 500;
        color: #495057;
        transition: border-color .15s, background .15s, color .15s;
    }

    .metode-btn:hover {
        border-color: #9ec5fe;
        background: #f0f6ff;
        color: #0d6efd;
    }

    .metode-btn.active {
        border: 2px solid #0d6efd;
        background: #f0f6ff;
        color: #0d6efd;
    }

    .metode-btn .metode-icon {
        font-size: 22px;
        display: block;
        margin-bottom: 5px;
    }

    /* ── Metode detail panel ── */
    .metode-detail-panel {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 1rem 1.25rem;
    }

    /* QR placeholder */
    .qr-box {
        width: 90px;
        height: 90px;
        background: #dee2e6;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 11px;
        text-align: center;
    }

    /* Dropzone */
    .dropzone {
        border: 1.5px dashed #dee2e6;
        border-radius: 8px;
        padding: 1.25rem;
        text-align: center;
        cursor: pointer;
        transition: border-color .15s;
    }

    .dropzone:hover {
        border-color: #0d6efd;
    }

    /* Bank table */
    .bank-table td {
        padding: 4px 0;
        font-size: 13px;
    }

    .bank-table td:first-child {
        color: #6c757d;
        width: 50%;
    }

    .bank-table td:last-child {
        font-weight: 600;
        color: #212529;
        text-align: right;
    }

    /* Summary */
    .summary-row {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        padding: 4px 0;
    }

    .summary-row span:first-child {
        color: #6c757d;
    }

    .summary-row span:last-child {
        font-weight: 500;
        color: #212529;
    }

    /* Section label */
    .section-label {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: #6c757d;
        margin-bottom: .75rem;
    }`r`n
    @media (max-width: 480px) {
        .metode-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<main class="container py-4" style="max-width: 700px;">

    <section class="card border rounded-3 overflow-hidden shadow-sm" aria-label="Form tambah transaksi pembayaran">

        {{-- Header + stepper --}}
        <header class="card-header bg-white d-flex align-items-center justify-content-between py-3 px-4">
            <h1 class="fs-6 fw-semibold mb-0">Tambah transaksi pembayaran</h1>
            <ol class="stepper" aria-label="Progress pembayaran">
                <li><span class="step-num active" id="dot1">1</span></li>
                <li aria-hidden="true">
                    <div class="step-connector" id="conn1"></div>
                </li>
                <li><span class="step-num" id="dot2">2</span></li>
                <li aria-hidden="true">
                    <div class="step-connector" id="conn2"></div>
                </li>
                <li><span class="step-num" id="dot3">3</span></li>
                <li><span class="text-muted ms-1" style="font-size:12px;" id="step-label">Langkah 1 dari 3</span></li>
            </ol>
        </header>

        <form id="form-pembayaran" action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="metode" id="metode" value="QRIS">
            <input type="hidden" name="metode_detail" id="metode_detail" value="QRIS">

        {{-- Step 1 --}}
        @include('fitur_pembayaran.step1_member')

        {{-- Step 2 --}}
        @include('fitur_pembayaran.step2_tagihan')

        {{-- Step 3 --}}
        @include('fitur_pembayaran.step3_pembayaran')

        {{-- Footer --}}
        <footer class="card-footer bg-light d-flex justify-content-between align-items-center px-4 py-3">
            <div id="footer-left">
                <button type="button" class="btn btn-link btn-sm text-secondary text-decoration-underline p-0"
                    id="btn-back" onclick="goBack()" style="display:none;">
                    Kembali
                </button>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-primary disabled" id="btn-next" onclick="goNext()">
                    Lanjut ke Tagihan
                </button>
            </div>
        </footer>
        </form>

    </section>

    {{-- Toast --}}
    <div id="toast" role="alert" aria-live="assertive"
        class="alert alert-success mt-3 d-none">
        <strong>Transaksi berhasil disimpan!</strong><br>
        Kwitansi dikirim ke member. Transaksi tercatat di daftar pembayaran.
    </div>

</main>

<script>
    const PAKET_DB = @json($paket ?? []);

    let currentStep = 1;
    let selectedMetode = 'QRIS';
    let selectedMember = null;

    function selectMember(element, id, nama, kode, hp, status) {
        selectedMember = {
            id: id,
            nama: nama,
            kode: kode,
            hp: hp,
            status: status,
            paket_id: element.dataset.paket
        };

        document.getElementById('member_id').value = id;

        document.querySelectorAll('.member-item').forEach(el => {
            el.classList.remove('active');
        });

        element.classList.add('active');

        const btnNext = document.getElementById('btn-next');
        btnNext.classList.remove('disabled', 'btn-secondary');
        btnNext.classList.add('btn-primary');
    }

    /* ── Helpers ── */
    function formatDate(str) {
        if (!str) return '—';
        return new Date(str).toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
    }

    /* ── Step navigation ── */
    function showStep(n) {
        const memberId = document.getElementById('member_id').value;
        if (n > 1 && !memberId) {
            alert('Silakan pilih member terlebih dahulu di Step 1.');
            return;
        }

        if (n > 2) {
            const paket = document.getElementById('paket').value;
            const tglBayar = document.getElementById('tgl-bayar').value;
            const tglMulai = document.getElementById('tgl-mulai').value;
            if (!paket || !tglBayar || !tglMulai) {
                alert('Harap lengkapi Detail tagihan terlebih dahulu.');
                return;
            }
        }

        currentStep = n;

        const step1 = document.getElementById('panel-step1');
        const step2 = document.getElementById('panel-step2');
        const step3 = document.getElementById('panel-step3');

        step1.style.display = 'none';
        step2.style.display = 'none';
        step3.style.display = 'none';

        if (n === 1) step1.style.display = 'block';
        if (n === 2) step2.style.display = 'block';
        if (n === 3) step3.style.display = 'block';

        updateStepperUI();
        console.log("PINDAH KE STEP:", n);
    }

    function updateStepperUI() {
        const dot1 = document.getElementById('dot1');
        const dot2 = document.getElementById('dot2');
        const dot3 = document.getElementById('dot3');
        const conn1 = document.getElementById('conn1');
        const conn2 = document.getElementById('conn2');
        const stepLabel = document.getElementById('step-label');
        const btnBack = document.getElementById('btn-back');
        const btnNext = document.getElementById('btn-next');

        [dot1, dot2, dot3].forEach(el => el.classList.remove('active', 'done'));
        [conn1, conn2].forEach(el => el.classList.remove('done'));

        if (currentStep === 1) {
            dot1.classList.add('active');
        } else if (currentStep === 2) {
            dot1.classList.add('done');
            dot2.classList.add('active');
            conn1.classList.add('done');
        } else {
            dot1.classList.add('done');
            dot2.classList.add('done');
            dot3.classList.add('active');
            conn1.classList.add('done');
            conn2.classList.add('done');
        }

        stepLabel.textContent = `Langkah ${currentStep} dari 3`;
        btnBack.style.display = currentStep > 1 ? 'inline-block' : 'none';
        if (currentStep === 1) btnNext.textContent = 'Lanjut ke Tagihan';
        else if (currentStep === 2) btnNext.textContent = 'Lanjut ke Pembayaran';
        else btnNext.textContent = 'Konfirmasi Pembayaran';

    }

    function goNext() {

        // STEP 1 → VALIDASI MEMBER
        if (currentStep === 1) {
            const memberId = document.getElementById('member_id').value;

            if (!memberId) {
                alert('Silakan pilih member terlebih dahulu!');
                return;
            }

            fillStep2Member();
            setDefaultPaket();

            console.log("CURRENT STEP:", currentStep);

            showStep(2);
            return;
        }

        // STEP 2 → VALIDASI TAGIHAN
        if (currentStep === 2) {
            const paket = document.getElementById('paket').value;
            const tglBayar = document.getElementById('tgl-bayar').value;
            const tglMulai = document.getElementById('tgl-mulai').value;

            if (!paket || !tglBayar || !tglMulai) {
                alert('Harap lengkapi semua field wajib terlebih dahulu.');
                return;
            }

            updateSummaryFull();
            showStep(3);
            return;
        }

        // STEP 3 → KONFIRMASI
        if (currentStep === 3) {
            konfirmasi();
        }
    }

    function goBack() {
        if (currentStep > 1) showStep(currentStep - 1);
    }

    function updateHarga() {
        const id = document.getElementById('paket').value;
        const paket = PAKET_DB.find(p => p.id == id);

        if (paket) {
            document.getElementById('nominal').value = rupiah(paket.harga);
        }

        updateAkhir();
        updateSummary();
        updateSelectedMemberPaketLabel();
    }


    function updateSummaryFull() {
        updateSummary();
        const mulai = document.getElementById('tgl-mulai').value;
        const akhir = document.getElementById('tgl-akhir').value;
        document.getElementById('sum-berlaku').textContent = formatDate(mulai) + ' – ' + formatDate(akhir);
        if (selectedMember) document.getElementById('sum-member').textContent = selectedMember.nama;
        const val = document.getElementById('paket').value;
        if (val) {
            const paket = PAKET_DB.find(p => p.id == val);
            if (paket) {
                document.getElementById('sum-paket').textContent = paket.nama_paket;
            }
        }
        document.getElementById('sum-metode').textContent = getMetodeDetailLabel();
    }

    /* ── Metode (step 3) ── */
    function pilihMetode(m) {
        selectedMetode = m;
        const metodeInput = document.getElementById('metode');
        const buktiPembayaranInput = document.getElementById('bukti-pembayaran');
        const buktiPanel = document.getElementById('panel-bukti-nontunai');
        const buktiLabel = document.getElementById('bukti-label');
        if (metodeInput) metodeInput.value = m;
        const isNonTunai = m !== 'Tunai';
        if (buktiPanel) buktiPanel.style.display = isNonTunai ? 'block' : 'none';
        if (buktiLabel) {
            buktiLabel.textContent = m === 'Transfer Bank'
                ? 'Upload bukti transfer bank'
                : m === 'E-Wallet'
                    ? 'Upload bukti pembayaran E-Wallet'
                    : 'Upload bukti pembayaran QRIS';
        }
        syncMetodeDetailInput();
        const map = {
            'QRIS': 'm-qris',
            'Transfer Bank': 'm-transfer',
            'E-Wallet': 'm-ewallet',
            'Tunai': 'm-tunai'
        };
        Object.entries(map).forEach(([key, btnId]) => {
            const btn = document.getElementById(btnId);
            btn.className = 'metode-btn' + (key === m ? ' active' : '');
            btn.setAttribute('aria-checked', key === m ? 'true' : 'false');
        });
        ['QRIS', 'Transfer Bank', 'E-Wallet', 'Tunai'].forEach(key => {
            const el = document.getElementById('detail-' + key);
            if (el) el.style.display = key === m ? 'block' : 'none';
        });
        document.getElementById('sum-metode').textContent = getMetodeDetailLabel();
    }

    function hitungKembalian() {
        const nom = parseInt(document.getElementById('nominal').value.replace(/[^0-9]/g, '')) || 0;
        const disc = parseInt(document.getElementById('diskon').value.replace(/[^0-9]/g, '')) || 0;
        const total = Math.max(0, nom - disc);
        const terima = parseInt(document.getElementById('uang-terima').value.replace(/[^0-9]/g, '')) || 0;
        document.getElementById('kembalian').value = rupiah(Math.max(0, terima - total));
    }

    /* ── Actions ── */
    function saveDraft() {
        alert('Transaksi disimpan sebagai draft.');
    }

    function konfirmasi() {
        const metodeInput = document.getElementById('metode');
        if (metodeInput) metodeInput.value = selectedMetode;
        syncMetodeDetailInput();
        document.getElementById('form-pembayaran').submit();
    }

    /* ── Init ── */
    (function init() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tgl-bayar').value = today;
        document.getElementById('tgl-mulai').value = today;
        updateAkhir();
        initBuktiPembayaranUpload();
        initMemberSearch();
        initEwalletSync();
        pilihMetode('QRIS');
        showStep(1);
    })();

    function initBuktiPembayaranUpload() {
        const input = document.getElementById('bukti-pembayaran');
        const label = document.getElementById('bukti-pembayaran-name');
        if (!input || !label) return;

        input.addEventListener('change', () => {
            const fileName = input.files && input.files[0] ? input.files[0].name : '';
            label.textContent = fileName || 'Belum ada file dipilih';
        });
    }

    function getMetodeDetailLabel() {
        if (selectedMetode !== 'E-Wallet') return selectedMetode;
        const ewalletType = document.getElementById('ewallet-type');
        const provider = ewalletType ? ewalletType.value : '';
        return provider ? `E-Wallet (${provider})` : 'E-Wallet';
    }

    function syncMetodeDetailInput() {
        const metodeDetailInput = document.getElementById('metode_detail');
        if (metodeDetailInput) {
            metodeDetailInput.value = getMetodeDetailLabel();
        }
    }

    function initEwalletSync() {
        const ewalletType = document.getElementById('ewallet-type');
        if (!ewalletType) return;

        ewalletType.addEventListener('change', () => {
            syncMetodeDetailInput();
            if (selectedMetode === 'E-Wallet') {
                document.getElementById('sum-metode').textContent = getMetodeDetailLabel();
            }
        });
    }

    function initMemberSearch() {
        const input = document.getElementById('search-member');
        const emptyState = document.getElementById('member-empty-state');
        const items = Array.from(document.querySelectorAll('#member-list .member-item'));

        if (!input || !items.length) return;

        const runFilter = () => {
            const keyword = (input.value || '').trim().toLowerCase();
            let visibleCount = 0;

            items.forEach(item => {
                const id = (item.dataset.id || '').toLowerCase();
                const kode = (item.dataset.kode || '').toLowerCase();
                const nama = (item.dataset.nama || '').toLowerCase();
                const isMatch = !keyword || id.includes(keyword) || kode.includes(keyword) || nama.includes(keyword);

                item.style.display = isMatch ? '' : 'none';
                if (isMatch) visibleCount++;
            });

            if (emptyState) {
                emptyState.classList.toggle('d-none', visibleCount > 0);
            }
        };

        input.addEventListener('input', runFilter);
        input.addEventListener('keyup', e => {
            if (e.key === 'Enter') runFilter();
        });
    }

    function fillStep2Member() {
        if (!selectedMember) return;
        const avatarEl = document.getElementById('sel-avatar');
        const namaEl = document.getElementById('sel-nama');
        const detailEl = document.getElementById('sel-detail');

        // Avatar
        if (avatarEl) avatarEl.textContent = initials(selectedMember.nama);

        // Nama
        if (namaEl) {
            namaEl.innerHTML =
                selectedMember.nama +
                statusBadge(selectedMember.status);
        }

        // Detail
        if (detailEl) {
            detailEl.innerHTML =
                'ID: ' + selectedMember.kode +
                ' | ' + selectedMember.hp +
                ' | Paket: -';
        }
    }

    function setDefaultPaket() {
        if (!selectedMember) return;

        const paketSelect = document.getElementById('paket');

        const paketMember = (PAKET_DB || []).find(p => p.id == selectedMember.paket_id);

        if (paketMember) {
            paketSelect.value = paketMember.id;
            updateHarga();
        }
    }

    function updateSelectedMemberPaketLabel() {
        if (!selectedMember) return;
        const detailEl = document.getElementById('sel-detail');
        if (!detailEl) return;

        const id = document.getElementById('paket').value;
        const paket = (PAKET_DB || []).find(p => p.id == id);
        const paketLabel = paket ? paket.nama_paket : '-';

        detailEl.innerHTML =
            'ID: ' + selectedMember.kode +
            ' | ' + selectedMember.hp +
            ' | Paket: ' + paketLabel;
    }

    function updateAkhir() {
        const id = document.getElementById('paket').value;
        const mulai = document.getElementById('tgl-mulai').value;

        const paket = PAKET_DB.find(p => p.id == id);

        if (paket && mulai) {
            const akhir = addDuration(mulai, paket.durasi, paket.tipe_durasi);
            document.getElementById('tgl-akhir').value = akhir;
        }
    }

    function updateSummary() {
        const nom = parseInt(document.getElementById('nominal').value.replace(/[^0-9]/g, '')) || 0;
        const disc = parseInt(document.getElementById('diskon').value.replace(/[^0-9]/g, '')) || 0;
        const total = Math.max(0, nom - disc);
        document.getElementById('sum-sub').textContent = rupiah(nom);
        document.getElementById('sum-disc').textContent = '— ' + rupiah(disc);
        document.getElementById('sum-total').textContent = rupiah(total);
        document.getElementById('qris-nominal').textContent = rupiah(total);
    }

    function addDuration(dateStr, duration, tipeDurasi) {
        if (!dateStr) return '';

        const amount = parseInt(duration, 10) || 0;
        const [year, month, day] = dateStr.split('-').map(Number);
        const d = new Date(year, (month || 1) - 1, day || 1);

        if ((tipeDurasi || '').toLowerCase() === 'bulan') {
            d.setMonth(d.getMonth() + amount);
        } else {
            d.setDate(d.getDate() + amount);
        }

        const yyyy = d.getFullYear();
        const mm = String(d.getMonth() + 1).padStart(2, '0');
        const dd = String(d.getDate()).padStart(2, '0');
        return `${yyyy}-${mm}-${dd}`;
    }

    function rupiah(n) {
        return 'Rp ' + Math.max(0, n).toLocaleString('id-ID');
    }

    function initials(nama) {
        return nama.split(' ').map(w => w[0]).join('').slice(0, 2).toUpperCase();
    }

    function statusBadge(status) {
        const raw = (status || '').toString().toLowerCase();
        let label = 'Pending';
        let cls = 'text-warning bg-warning-subtle border-warning-subtle';

        if (raw === 'aktif') {
            label = 'Aktif';
            cls = 'text-success bg-success-subtle border-success-subtle';
        } else if (raw === 'kadaluwarsa') {
            label = 'Kadaluwarsa';
            cls = 'text-danger bg-danger-subtle border-danger-subtle';
        }

        return ` <span class="badge border rounded-pill ${cls} fw-semibold ms-1" style="font-size:10px;">${label}</span>`;
    }
</script>

@endsection

