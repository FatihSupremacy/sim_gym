<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Anggota - Limus Fitness Centre</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* ─── Section utama ─── */
        .register-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 80px 16px;
            position: relative;
            background:
                linear-gradient(rgba(5, 10, 18, .72), rgba(5, 10, 18, .80)),
                url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat fixed;
        }

        /* ─── Card glassmorphism ─── */
        .register-member-card {
            max-width: 980px;
            margin: 0 auto;
            width: 100%;
            border-radius: 38px;
            background: rgba(255, 255, 255, .13);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, .22);
            box-shadow:
                0 24px 64px rgba(0, 0, 0, .35),
                0 2px 12px rgba(0, 0, 0, .18),
                inset 0 1px 0 rgba(255, 255, 255, .15);
            padding: 48px 52px;
        }

        /* ─── Header card ─── */
        .card-header-custom {
            margin-bottom: 36px;
        }

        .card-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: rgba(13, 110, 253, .35);
            border: 1px solid rgba(13, 110, 253, .45);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            font-size: 1.45rem;
            color: #6ea8fe;
        }

        .card-title-main {
            font-family: "Bebas Neue", sans-serif;
            font-size: 2.6rem;
            font-weight: 400;
            color: #ffffff;
            letter-spacing: 0.04em;
            line-height: 1.1;
            margin-bottom: 8px;
        }

        .card-subtitle-main {
            font-size: 0.925rem;
            color: rgba(255, 255, 255, .62);
            line-height: 1.6;
            margin: 0;
            max-width: 560px;
        }

        /* ─── Divider ─── */
        .form-divider {
            height: 1px;
            background: rgba(255, 255, 255, .12);
            margin-bottom: 32px;
        }

        /* ─── Label ─── */
        .form-label {
            color: rgba(255, 255, 255, .88);
            font-size: 0.855rem;
            font-weight: 600;
            margin-bottom: 8px;
            letter-spacing: 0.01em;
        }

        /* ─── Input / Select / Textarea ─── */
        .glass-input {
            background: rgba(255, 255, 255, .09) !important;
            border: 1.5px solid rgba(255, 255, 255, .18) !important;
            border-radius: 16px !important;
            color: #ffffff !important;
            font-size: 0.9rem;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .glass-input::placeholder {
            color: rgba(255, 255, 255, .45);
        }

        .glass-input:focus {
            background: rgba(255, 255, 255, .15) !important;
            border-color: #0d6efd !important;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, .22) !important;
            outline: none;
            color: #ffffff !important;
        }

        .glass-input.is-invalid {
            border-color: #ff8a8a !important;
        }

        .invalid-feedback {
            color: #ffb4b4;
            font-size: .78rem;
        }

        input.glass-input,
        .glass-input:not(textarea):not(select) {
            height: 52px;
        }

        select.glass-input {
            height: 52px;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='rgba(255,255,255,.55)' stroke-width='1.8' fill='none' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 16px center !important;
            padding-right: 40px !important;
            cursor: pointer;
        }

        select.glass-input option {
            background: #1a2233;
            color: #ffffff;
        }

        textarea.glass-input {
            resize: vertical;
            min-height: 110px;
            padding-top: 14px;
        }

        /* ─── Tombol daftar ─── */
        .btn-daftar {
            height: 54px;
            border-radius: 999px;
            background: #0d6efd;
            border: none;
            color: #ffffff;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 0.01em;
            padding: 0 36px;
            transition: background 0.18s, transform 0.15s, box-shadow 0.18s;
            box-shadow: 0 4px 20px rgba(13, 110, 253, .38);
            white-space: nowrap;
        }

        .btn-daftar:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(13, 110, 253, .45);
        }

        .btn-daftar:active {
            transform: translateY(0);
        }

        .btn-daftar:disabled {
            opacity: 0.45;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
            background: #0d6efd;
        }

        .form-disclaimer {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, .42);
            margin-top: 14px;
            text-align: center;
        }

        /* ─── Section pemisah antar grup field ─── */
        .field-group-gap {
            margin-bottom: 20px;
        }

        /* ─── Checkbox syarat & ketentuan ─── */
        .form-check-terms {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 14px 16px;
            border-radius: 14px;
            background: rgba(255, 255, 255, .07);
            border: 1px solid rgba(255, 255, 255, .14);
        }

        .form-check-terms .form-check-input {
            width: 19px;
            height: 19px;
            margin-top: 2px;
            flex-shrink: 0;
            background-color: rgba(255, 255, 255, .12);
            border: 1.5px solid rgba(255, 255, 255, .35);
            border-radius: 6px !important;
            cursor: pointer;
        }

        .form-check-terms .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .form-check-terms .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(13, 110, 253, .25);
            border-color: #0d6efd;
        }

        .form-check-terms .form-check-label {
            color: rgba(255, 255, 255, .8);
            font-size: 0.85rem;
            line-height: 1.55;
            cursor: pointer;
        }

        .form-check-terms .form-check-label a {
            color: #6ea8fe;
            text-decoration: underline;
            text-decoration-color: rgba(110, 168, 254, .4);
        }

        .form-check-terms .form-check-label a:hover {
            color: #8fbcff;
        }

        /* ─── Responsive ─── */
        @media (max-width: 767.98px) {
            .register-section {
                padding: 48px 12px;
            }

            .register-member-card {
                border-radius: 26px;
                padding: 28px 20px;
            }

            .card-title-main {
                font-size: 2rem;
            }

            .btn-daftar {
                width: 100%;
            }
        }

        @media (max-width: 575.98px) {
            .register-member-card {
                border-radius: 22px;
                padding: 24px 16px;
            }
        }
    </style>
</head>

<body>

    <section class="register-section">
        <div class="register-member-card">

            {{-- Header --}}
            <div class="card-header-custom">
                <h2 class="card-title-main">Form Pendaftaran Anggota</h2>
                <p class="card-subtitle-main">Lengkapi data di bawah untuk mendaftar menjadi anggota Limus Fitness Centre.</p>
            </div>

            <div class="form-divider"></div>

            @if (session('success'))
                <div class="alert alert-success border-0 rounded-4 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-4 mb-4" role="alert">
                    Mohon periksa kembali data pendaftaran yang Anda isi.
                </div>
            @endif

            {{-- Form --}}
            <form id="formPendaftaran" action="{{ route('pendaftaran.store') }}" method="POST">
                @csrf
                <div class="row g-4">

                    {{-- Nama Lengkap --}}
                    <div class="col-12 col-md-6 field-group-gap">
                        <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                        <input
                            type="text"
                            id="namaLengkap"
                            name="nama"
                            value="{{ old('nama', auth()->user()?->name) }}"
                            class="form-control glass-input @error('nama') is-invalid @enderror"
                            placeholder="Masukkan nama lengkap"
                            required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="col-12 col-md-6 field-group-gap">
                        <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                        <select id="jenisKelamin" name="jenis_kelamin" class="form-select glass-input @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') === 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- No. HP --}}
                    <div class="col-12 col-md-6 field-group-gap">
                        <label for="noHp" class="form-label">No. HP</label>
                        <input
                            type="tel"
                            id="noHp"
                            name="no_hp"
                            value="{{ old('no_hp') }}"
                            class="form-control glass-input @error('no_hp') is-invalid @enderror"
                            placeholder="Contoh: 081234567890"
                            inputmode="numeric"
                            required>
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-12 col-md-6 field-group-gap">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', auth()->user()?->email) }}"
                            class="form-control glass-input @error('email') is-invalid @enderror"
                            placeholder="Masukkan alamat email"
                            {{ auth()->check() ? 'readonly' : '' }}
                            required>
                        @auth
                            <div class="form-text text-white-50">Email disamakan dengan akun agar data member muncul di profil Anda.</div>
                        @endauth
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="col-12 field-group-gap">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea
                            id="alamat"
                            name="alamat"
                            class="form-control glass-input @error('alamat') is-invalid @enderror"
                            rows="4"
                            placeholder="Masukkan alamat lengkap"
                            required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Paket Membership --}}
                    <div class="col-12 col-md-6 field-group-gap">
                        <label for="paketMembership" class="form-label">Paket Membership</label>
                        <select id="paketMembership" name="paket_id" class="form-select glass-input @error('paket_id') is-invalid @enderror" required>
                            <option value="" disabled {{ old('paket_id') ? '' : 'selected' }}>Pilih Paket Membership</option>
                            @foreach ($paket as $item)
                                <option value="{{ $item->id }}" {{ (string) old('paket_id') === (string) $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_paket }} — Rp{{ number_format($item->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        @error('paket_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Checkbox Syarat & Ketentuan --}}
                    <div class="col-12 field-group-gap">
                        <div class="form-check-terms">
                            <input
                                type="checkbox"
                                id="syaratKetentuan"
                                name="syarat_ketentuan"
                                value="1"
                                class="form-check-input"
                                {{ old('syarat_ketentuan') ? 'checked' : '' }}
                                required>
                            <label for="syaratKetentuan" class="form-check-label">
                                Saya menyetujui
                                <a href="#" target="_blank">syarat dan ketentuan</a>
                                yang berlaku di Limus Fitness Centre.
                            </label>
                        </div>
                        @error('syarat_ketentuan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="col-12">
                        <div class="d-flex justify-content-center mt-2">
                            <button type="submit" id="btnDaftar" class="btn-daftar" {{ old('syarat_ketentuan') ? '' : 'disabled' }}>
                                <i class="bi bi-check2-circle me-2"></i>Daftar Sekarang
                            </button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const checkboxTerms = document.getElementById('syaratKetentuan');
        const btnDaftar = document.getElementById('btnDaftar');

        checkboxTerms.addEventListener('change', function() {
            btnDaftar.disabled = !this.checked;
        });
    </script>
</body>

</html>
