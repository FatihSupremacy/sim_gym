<style>
    /* ── Search Input ── */
    #search-member {
        font-size: 14px;
        border-radius: 8px;
        border: 1px solid #E5E7EB;
        padding: 8px 12px;
        color: #374151;
        background: #fff;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    #search-member:focus {
        border-color: #0D6EFD;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, .10);
        outline: none;
    }

    #search-member::placeholder {
        color: #9CA3AF;
    }

    /* ── Member List ── */
    .member-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    /* ── Member Item ── */
    .member-item {
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 10px;
        border: 1px solid transparent;
        transition: background .15s ease, border-color .15s ease;
    }

    .member-item:hover {
        background: #FAFBFF;
        border-color: #E5E7EB;
    }

    .member-item.active {
        background: rgba(13, 110, 253, .08) !important;
        border-color: #0D6EFD !important;
    }

    .member-item.active .mi-name {
        color: #0D6EFD !important;
    }

    .member-item.active .mi-sub {
        color: #6B7280 !important;
    }

    /* ── Avatar Placeholder ── */
    .mi-avatar {
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
    .mi-name {
        font-weight: 600;
        color: #1F2937;
        font-size: 13.5px;
        line-height: 1.25;
    }

    .mi-sub {
        font-size: 11.5px;
        color: #9CA3AF;
        line-height: 1.35;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .mi-sub .sep {
        margin: 0 5px;
        opacity: .5;
    }

    /* ── Status Badge ── */
    .mi-badge {
        font-size: 10.5px;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        white-space: nowrap;
        flex-shrink: 0;
        margin-left: auto;
    }

    .mi-badge .dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    /* ── Empty State ── */
    .mi-empty {
        padding: 32px 0;
        text-align: center;
        color: #9CA3AF;
        font-size: 13px;
    }
</style>

<div id="panel-step1" class="card-body px-4 py-4" role="region" aria-labelledby="heading-step1">

    <h2 id="heading-step1" class="section-label">Pilih Member</h2>

    <input type="hidden" name="member_id" id="member_id">

    {{-- Search --}}
    <div class="mb-3">
        <label class="d-block fw-semibold text-uppercase mb-1"
            style="font-size:10px; letter-spacing:.07em; color:#6B7280;">
            Cari Nama atau ID Member
            <span class="text-danger ms-1">*</span>
        </label>
        <input
            type="search"
            id="search-member"
            class="form-control w-100"
            placeholder="Ketik nama atau ID member...">
    </div>

    {{-- Member List --}}
    <ul class="member-list" id="member-list">
        @forelse ($member as $m)
        <li class="member-item"
            onclick="selectMember(this, '{{ $m->id }}', '{{ $m->nama }}', '{{ $m->kode_member }}', '{{ $m->no_hp }}', '{{ $m->status }}')"
            data-id="{{ $m->id }}"
            data-nama="{{ $m->nama }}"
            data-kode="{{ $m->kode_member }}"
            data-hp="{{ $m->no_hp }}"
            data-status="{{ $m->status }}"
            data-paket="{{ $m->paket_id }}">

            {{-- Avatar Placeholder --}}
            <div class="mi-avatar" aria-hidden="true">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="#a5b4fc">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M20 21a8 8 0 1 0-16 0" />
                </svg>
            </div>

            {{-- Info --}}
            <div class="d-flex flex-column" style="gap:1px; min-width:0; flex:1;">
                <span class="mi-name">{{ $m->nama }}</span>
                <span class="mi-sub">
                    {{ $m->kode_member }}<span class="sep">&bull;</span>{{ $m->no_hp }}
                </span>
            </div>

            {{-- Status Badge --}}
            @if($m->status === 'aktif')
            <span class="mi-badge" style="background:rgba(34,197,94,.10);color:#16A34A;">
                <span class="dot" style="background:#16A34A;"></span>Aktif
            </span>
            @elseif($m->status === 'pending')
            <span class="mi-badge" style="background:rgba(245,158,11,.12);color:#D97706;">
                <span class="dot" style="background:#F59E0B;"></span>Pending
            </span>
            @else
            <span class="mi-badge" style="background:rgba(239,68,68,.10);color:#DC2626;">
                <span class="dot" style="background:#DC2626;"></span>Kadaluwarsa
            </span>
            @endif
        </li>
        @empty
        <li class="mi-empty">
            <i class="bi bi-inbox d-block mb-2" style="font-size:1.8rem;opacity:.4;"></i>
            Data member belum tersedia.
        </li>
        @endforelse

        <li class="mi-empty d-none" id="member-empty-state">
            <i class="bi bi-search d-block mb-2" style="font-size:1.8rem;opacity:.4;"></i>
            Member tidak ditemukan.
        </li>
    </ul>

</div>
