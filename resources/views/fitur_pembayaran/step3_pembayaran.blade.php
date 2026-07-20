{{--
    Partial: fitur_pembayaran/step3_pembayaran.blade.php
    Step 3 - Pilih metode pembayaran & konfirmasi ringkasan
--}}

<style>
    /* ── Section Label ── */
    .step3-label {
        font-size: 10px;
        font-weight: 600;
        letter-spacing: .07em;
        text-transform: uppercase;
        color: #6B7280;
        margin-bottom: .75rem;
    }

    /* ── Metode Grid ── */
    .metode-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }

    @media (max-width: 480px) {
        .metode-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* ── Metode Button ── */
    .metode-btn {
        border: 1px solid #E5E7EB;
        border-radius: 10px;
        padding: 14px 8px 12px;
        text-align: center;
        cursor: pointer;
        background: #fff;
        font-size: 12px;
        font-weight: 600;
        color: #6B7280;
        transition: border-color .15s, background .15s, color .15s;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
    }

    .metode-btn:hover {
        border-color: #0D6EFD;
        background: rgba(13, 110, 253, .05);
        color: #0D6EFD;
    }

    .metode-btn.active {
        border: 2px solid #0D6EFD;
        background: rgba(13, 110, 253, .06);
        color: #0D6EFD;
    }

    .metode-icon {
        font-size: 13px;
        font-weight: 700;
        color: #6B7280;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .metode-btn.active .metode-icon {
        color: #0D6EFD;
    }

    /* ── Detail Panel ── */
    .metode-detail-panel {
        background: #F9FAFB;
        border: 1px solid #F3F4F6;
        border-radius: 12px;
        padding: 1rem 1.25rem;
    }

    /* ── QR Box ── */
    .qr-box {
        width: 90px;
        height: 90px;
        background: #EEF2FF;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6B7280;
        font-size: 11px;
        font-weight: 600;
        text-align: center;
        flex-shrink: 0;
    }

    /* ── Dropzone ── */
    .dropzone {
        border: 1.5px dashed #E5E7EB;
        border-radius: 10px;
        padding: 1.25rem;
        text-align: center;
        cursor: pointer;
        transition: border-color .15s, background .15s;
        background: #fff;
        display: block;
    }

    .dropzone:hover {
        border-color: #0D6EFD;
        background: rgba(13, 110, 253, .03);
    }

    /* ── Bank Table ── */
    .bank-table td {
        padding: 5px 0;
        font-size: 13px;
        border: none;
    }

    .bank-table td:first-child {
        color: #6B7280;
        width: 50%;
    }

    .bank-table td:last-child {
        font-weight: 600;
        color: #1F2937;
        text-align: right;
    }

    /* ── Field Label ── */
    .step3-field-label {
        display: block;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: #6B7280;
        margin-bottom: 6px;
    }

    /* ── Form Controls ── */
    .step3-control {
        font-size: 14px;
        border: 1px solid #E5E7EB;
        border-radius: 8px;
        padding: 8px 12px;
        color: #374151;
        background: #fff;
        width: 100%;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .step3-control:focus {
        border-color: #0D6EFD;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, .10);
        outline: none;
    }

    .step3-control:disabled {
        background: #F9FAFB;
        color: #9CA3AF;
        border-color: #F3F4F6;
    }

    .step3-control::placeholder {
        color: #9CA3AF;
    }

    /* ── Section Divider ── */
    .step3-divider {
        border: none;
        border-top: 1px solid #F3F4F6;
        margin: 1.25rem 0;
    }

    /* ── Summary Panel ── */
    .summary-panel {
        background: #F9FAFB;
        border: 1px solid #F3F4F6;
        border-radius: 12px;
        padding: 1rem 1.25rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        padding: 4px 0;
    }

    .summary-row span:first-child {
        color: #6B7280;
    }

    .summary-row span:last-child {
        font-weight: 500;
        color: #374151;
    }

    .summary-divider {
        border: none;
        border-top: 1px solid #E5E7EB;
        margin: 8px 0;
    }
</style>

<div id="panel-step3" class="card-body px-4 py-4" role="region" aria-labelledby="heading-step3" style="display:none;">

    {{-- Metode Pembayaran --}}
    <h2 id="heading-step3" class="step3-label">Pilih Metode Pembayaran</h2>

    <div class="metode-grid mb-3" role="radiogroup" aria-label="Pilihan metode pembayaran">
        <button type="button" class="metode-btn active" id="m-qris"
            onclick="pilihMetode('QRIS')" role="radio" aria-checked="true">
            <span class="metode-icon" aria-hidden="true">QR</span>
            QRIS
        </button>
        <button type="button" class="metode-btn" id="m-transfer"
            onclick="pilihMetode('Transfer Bank')" role="radio" aria-checked="false">
            <span class="metode-icon" aria-hidden="true">TR</span>
            Transfer Bank
        </button>
        <button type="button" class="metode-btn" id="m-ewallet"
            onclick="pilihMetode('E-Wallet')" role="radio" aria-checked="false">
            <span class="metode-icon" aria-hidden="true">EW</span>
            E-Wallet
        </button>
        <button type="button" class="metode-btn" id="m-tunai"
            onclick="pilihMetode('Tunai')" role="radio" aria-checked="false">
            <span class="metode-icon" aria-hidden="true">TN</span>
            Tunai
        </button>
    </div>

    {{-- Detail QRIS --}}
    <div id="detail-QRIS" class="metode-detail-panel" role="region" aria-label="Instruksi pembayaran QRIS">
        <div class="d-flex align-items-center gap-3">
            <div class="qr-box" aria-label="QR Code placeholder">QR Code</div>
            <div>
                <p class="fw-semibold mb-1" style="font-size:13px; color:#1F2937;">Scan untuk membayar</p>
                <p class="mb-2" style="font-size:12px; color:#9CA3AF;">Gunakan aplikasi apapun yang mendukung QRIS</p>
                <p class="fw-bold mb-0" style="font-size:15px; color:#0D6EFD;" id="qris-nominal">Rp 0</p>
            </div>
        </div>
    </div>

    {{-- Upload Bukti (non-tunai) --}}
    <div id="panel-bukti-nontunai" class="metode-detail-panel mt-3" role="region" aria-label="Upload bukti pembayaran">
        <label class="step3-field-label mb-2">
            <span id="bukti-label">Upload Bukti Pembayaran QRIS</span>
            <span style="color:#9CA3AF; font-weight:400; font-size:10px; text-transform:none; letter-spacing:0;"> (opsional)</span>
        </label>
        <label for="bukti-pembayaran" class="dropzone mb-0"
            role="button" tabindex="0"
            aria-label="Area upload bukti pembayaran, klik untuk memilih file">
            <i class="bi bi-cloud-upload d-block mb-1" style="font-size:1.5rem; color:#9CA3AF;"></i>
            <p class="mb-1" style="font-size:13px; color:#6B7280;">Klik atau drag file ke sini</p>
            <p class="mb-0" style="font-size:11px; color:#9CA3AF;">JPG, PNG, PDF &mdash; maks. 5 MB</p>
            <p class="mb-0 mt-2 fw-semibold" style="font-size:12px; color:#0D6EFD;" id="bukti-pembayaran-name">Belum ada file dipilih</p>
        </label>
        <input type="file" id="bukti-pembayaran" name="bukti" accept=".jpg,.jpeg,.png,.pdf,.webp"
            class="visually-hidden" aria-label="Pilih file bukti pembayaran">
    </div>

    {{-- Detail Transfer Bank --}}
    <div id="detail-Transfer Bank" class="metode-detail-panel mt-3" style="display:none;"
        role="region" aria-label="Instruksi transfer bank">
        <p class="fw-semibold mb-2" style="font-size:13px; color:#1F2937;">Rekening Tujuan</p>
        <table class="bank-table w-100 mb-0" aria-label="Informasi rekening bank">
            <tr><td>Bank</td><td>BCA</td></tr>
            <tr><td>No. Rekening</td><td>1234567890</td></tr>
            <tr><td>Atas Nama</td><td>Gym Elite Center</td></tr>
        </table>
    </div>

    {{-- Detail E-Wallet --}}
    <div id="detail-E-Wallet" class="metode-detail-panel mt-3" style="display:none;"
        role="region" aria-label="Detail pembayaran e-wallet">
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="ewallet-type" class="step3-field-label">Pilih E-Wallet</label>
                <select class="step3-control" id="ewallet-type" name="ewallet_type">
                    <option>GoPay</option>
                    <option>OVO</option>
                    <option>Dana</option>
                    <option>ShopeePay</option>
                </select>
            </div>
            <div class="col-sm-6">
                <label for="ewallet-phone" class="step3-field-label">No. HP / ID Akun</label>
                <input type="tel" class="step3-control" id="ewallet-phone"
                    placeholder="08xx-xxxx-xxxx" autocomplete="tel">
            </div>
        </div>
    </div>

    {{-- Detail Tunai --}}
    <div id="detail-Tunai" class="metode-detail-panel mt-3" style="display:none;"
        role="region" aria-label="Detail pembayaran tunai">
        <p class="mb-3" style="font-size:13px; color:#9CA3AF;">
            Uang diterima oleh admin / kasir. Kwitansi akan dicetak setelah konfirmasi.
        </p>
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="uang-terima" class="step3-field-label">Uang Diterima</label>
                <input type="text" class="step3-control" id="uang-terima"
                    placeholder="Rp 0" oninput="hitungKembalian()">
            </div>
            <div class="col-sm-6">
                <label for="kembalian" class="step3-field-label">Kembalian</label>
                <input type="text" class="step3-control" id="kembalian"
                    placeholder="Rp 0" disabled aria-live="polite"
                    aria-label="Kembalian dihitung otomatis">
            </div>
        </div>
    </div>

    <hr class="step3-divider" aria-hidden="true">

    {{-- Ringkasan Transaksi --}}
    <h2 class="step3-label">Ringkasan Transaksi</h2>

    <div class="summary-panel mb-1" aria-label="Ringkasan transaksi sebelum dikonfirmasi">
        <div class="summary-row"><span>Member</span> <span id="sum-member">-</span></div>
        <div class="summary-row"><span>Paket</span> <span id="sum-paket">-</span></div>
        <div class="summary-row"><span>Metode</span> <span id="sum-metode">QRIS</span></div>
        <div class="summary-row"><span>Berlaku</span> <span id="sum-berlaku">-</span></div>
        <hr class="summary-divider" aria-hidden="true">
        <div class="summary-row"><span>Subtotal</span> <span id="sum-sub">Rp 0</span></div>
        <div class="summary-row">
            <span>Diskon</span>
            <span id="sum-disc" style="color:#16A34A;">- Rp 0</span>
        </div>
        <hr class="summary-divider" aria-hidden="true">
        <div class="d-flex justify-content-between align-items-center pt-1">
            <span class="fw-semibold" style="font-size:13.5px; color:#1F2937;">Total</span>
            <span class="fw-bold" style="font-size:16px; color:#0D6EFD;" id="sum-total" aria-live="polite">Rp 0</span>
        </div>
    </div>

</div>

