{{--
    Partial: fitur_pembayaran/step2_tagihan.blade.php
    Step 2 — Detail tagihan & periode membership
--}}

<style>
    /* ── Selected Member Card ── */
    .selected-member-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 12px 14px;
        background: rgba(13, 110, 253, .05);
        border: 1px solid rgba(13, 110, 253, .20);
        border-radius: 12px;
    }

    /* ── Avatar Placeholder ── */
    .sm-avatar {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #EEF2FF;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* ── Name & Sub ── */
    .sm-name {
        font-weight: 600;
        color: #1F2937;
        font-size: 13.5px;
        line-height: 1.25;
    }

    .sm-sub {
        font-size: 11.5px;
        color: #9CA3AF;
        line-height: 1.35;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .sm-sub .sep {
        margin: 0 5px;
        opacity: .5;
    }

    /* ── Status Badge ── */
    .sm-badge {
        font-size: 10.5px;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .sm-badge .dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    /* ── Ganti Button ── */
    .btn-ganti {
        font-size: 12px;
        font-weight: 600;
        padding: 5px 14px;
        border-radius: 8px;
        border: 1px solid #E5E7EB;
        background: #fff;
        color: #374151;
        cursor: pointer;
        transition: border-color .15s, background .15s;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .btn-ganti:hover {
        border-color: #0D6EFD;
        color: #0D6EFD;
        background: rgba(13, 110, 253, .05);
    }

    /* ── Section Divider ── */
    .step2-divider {
        border: none;
        border-top: 1px solid #F3F4F6;
        margin: 1.25rem 0;
    }

    /* ── Section Label ── */
    .step2-label {
        font-size: 10px;
        font-weight: 600;
        letter-spacing: .07em;
        text-transform: uppercase;
        color: #6B7280;
        margin-bottom: .75rem;
    }

    /* ── Form Labels ── */
    .field-label {
        display: block;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: #6B7280;
        margin-bottom: 6px;
    }

    /* ── Form Controls ── */
    .step2-control {
        font-size: 14px;
        border: 1px solid #E5E7EB;
        border-radius: 8px;
        padding: 8px 12px;
        color: #374151;
        background: #fff;
        width: 100%;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .step2-control:focus {
        border-color: #0D6EFD;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, .10);
        outline: none;
    }

    .step2-control:disabled,
    .step2-control[disabled] {
        background: #F9FAFB;
        color: #9CA3AF;
        border-color: #F3F4F6;
    }

    .step2-control::placeholder {
        color: #9CA3AF;
    }

    .field-hint {
        font-size: 11px;
        color: #9CA3AF;
        margin-top: 4px;
    }
</style>

<div id="panel-step2" class="card-body px-4 py-4" role="region" aria-labelledby="heading-step2" style="display:none;">

    {{-- Member terpilih (read-only, dari step 1) --}}
    <h2 id="heading-step2" class="step2-label">Member Terpilih</h2>

    <div class="selected-member-card mb-4" aria-live="polite" aria-label="Member yang dipilih">
        <div class="d-flex align-items-center gap-2" style="min-width:0; flex:1;">
            {{-- Avatar --}}
            <div class="sm-avatar" aria-hidden="true">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="#a5b4fc">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M20 21a8 8 0 1 0-16 0" />
                </svg>
            </div>
            {{-- Info --}}
            <div style="min-width:0;">
                <div class="sm-name" id="sel-nama">-</div>
                <div class="sm-sub" id="sel-detail">
                    ID: -<span class="sep">&bull;</span>-
                </div>
            </div>
        </div>

        {{-- Status & Ganti --}}
        <div class="d-flex align-items-center gap-2 flex-shrink-0">
            <span class="sm-badge d-none" id="sel-badge"></span>
            <button type="button" class="btn-ganti" onclick="showStep(1)">
                <i class="bi bi-arrow-left-short" aria-hidden="true"></i> Ganti
            </button>
        </div>
    </div>

    <hr class="step2-divider" aria-hidden="true">

    {{-- Detail tagihan --}}
    <h2 class="step2-label">Detail Tagihan</h2>

    <fieldset style="border:none; padding:0; margin:0;">
        <legend class="visually-hidden">Detail tagihan membership</legend>

        <div class="row g-3 mb-3">
            <div class="col-sm-7">
                <label for="paket" class="field-label">
                    Paket Membership
                    <span class="text-danger" aria-hidden="true">*</span>
                </label>
                <select id="paket" name="paket_id" class="step2-control" onchange="updateHarga()">
                    <option value="">Pilih paket...</option>

                    @foreach($paket as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->nama_paket }} — Rp {{ number_format($p->harga,0,',','.') }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-5">
                <label for="nominal" class="field-label">Nominal</label>
                <input
                    type="text"
                    class="step2-control"
                    id="nominal"
                    name="nominal"
                    placeholder="Rp 0"
                    oninput="updateSummary()"
                    aria-label="Nominal pembayaran">
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-sm-6">
                <label for="tgl-bayar" class="field-label">
                    Tgl. Pembayaran
                    <span class="text-danger" aria-hidden="true">*</span>
                </label>
                <input
                    type="date"
                    class="step2-control"
                    id="tgl-bayar"
                    name="tgl_bayar"
                    required
                    aria-required="true">
            </div>
            <div class="col-sm-6">
                <label for="tgl-mulai" class="field-label">
                    Berlaku Mulai
                    <span class="text-danger" aria-hidden="true">*</span>
                </label>
                <input
                    type="date"
                    class="step2-control"
                    id="tgl-mulai"
                    name="tgl_mulai"
                    required
                    oninput="updateAkhir()"
                    aria-required="true">
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-sm-6">
                <label for="tgl-akhir" class="field-label">Berlaku Sampai</label>
                <input
                    type="date"
                    class="step2-control"
                    id="tgl-akhir"
                    disabled
                    aria-label="Tanggal berakhir, dihitung otomatis dari paket">
                <div class="field-hint">Dihitung otomatis dari paket</div>
            </div>
            <div class="col-sm-6">
                <label for="diskon" class="field-label">Diskon / Voucher</label>
                <input
                    type="text"
                    class="step2-control"
                    id="diskon"
                    name="diskon"
                    placeholder="Rp 0"
                    oninput="updateSummary()">
            </div>
        </div>

        <div class="mb-1">
            <label for="catatan" class="field-label">Catatan</label>
            <input
                type="text"
                class="step2-control"
                id="catatan"
                name="catatan"
                placeholder="Opsional...">
        </div>

    </fieldset>

</div>
