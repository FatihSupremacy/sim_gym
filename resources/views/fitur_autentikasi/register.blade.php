<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Limus Fitness Centre</title>

    <link rel="shortcut icon" href="{{ asset('assets/limus-fitness-logo.png') }}" type="image/png">

    {{-- Bootstrap 5.3 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Google Font: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">


    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            background-color: #f4efe3;
            padding: clamp(12px, 2vw, 24px);
            margin: 0;
            overflow-y: auto;
        }

        /* ─── Wrapper ─── */
        .auth-page {
            width: 100%;
        }

        /* ─── Card utama ─── */
        .auth-card {
            max-width: 1080px;
            margin: 0 auto;
            height: min(620px, calc(100dvh - 48px));
            min-height: 560px;
            background: #ffffff;
            border-radius: 34px;
            overflow: hidden;
            box-shadow: 0 8px 48px rgba(0, 0, 0, 0.10), 0 2px 12px rgba(0, 0, 0, 0.06);
            display: flex;
        }

        /* ─── Panel kiri: form ─── */
        .auth-form-panel {
            flex: 0 0 44%;
            width: 44%;
            padding: 48px 42px 38px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            overflow-y: auto;
        }

        .auth-form-logo {
            width: 74px;
            height: auto;
            object-fit: contain;
            margin-bottom: 16px;
        }

        .auth-form-title {
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            letter-spacing: 0.01em;
            font-size: 2.4rem;
            color: #0d6efd;
            margin-bottom: 32px;
            line-height: 1.15;
            text-align: center;
        }

        .lexend-auth-form-title {
            font-family: "Lexend", sans-serif;
            font-optical-sizing: auto;
            font-weight: 700;
            font-style: normal;
        }

        .auth-form-subtitle {
            font-size: 0.875rem;
            color: #6c757d;
            margin-bottom: 34px;
            line-height: 1.5;
        }

        /* ─── Input group ─── */
        .input-field-wrap {
            position: relative;
            margin-bottom: 12px;
        }

        .input-field-wrap .field-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 0.95rem;
            pointer-events: none;
            z-index: 2;
        }

        .input-field-wrap .form-control {
            height: 50px;
            border-radius: 14px;
            border: 1.5px solid #e5e7eb;
            background: #f8f9fa;
            padding-left: 42px;
            padding-right: 46px;
            font-size: 0.9rem;
            color: #111111;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .input-field-wrap .form-control::placeholder {
            color: #b0b7c3;
        }

        .input-field-wrap .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.12);
            background: #ffffff;
            outline: none;
        }

        .input-field-wrap .form-control.is-invalid {
            border-color: #ef4444;
            background: #fff5f5;
        }

        /* ─── Toggle password ─── */
        .toggle-password-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #9ca3af;
            font-size: 0.95rem;
            cursor: pointer;
            padding: 4px;
            z-index: 2;
            line-height: 1;
            transition: color 0.15s;
        }

        .toggle-password-btn:hover {
            color: #0d6efd;
        }

        /* ─── Alert validasi ─── */
        .field-error {
            display: flex;
            align-items: center;
            gap: 7px;
            background: #fff1f1;
            border: 1px solid #fca5a5;
            border-radius: 12px;
            padding: 8px 13px;
            margin-bottom: 8px;
            font-size: 0.82rem;
            color: #dc2626;
        }

        .field-error i {
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        /* ─── Tombol submit ─── */
        .btn-register {
            width: 100%;
            height: 52px;
            border-radius: 999px;
            background: #0d6efd;
            border: none;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.975rem;
            letter-spacing: 0.01em;
            margin-top: 6px;
            transition: background 0.18s, transform 0.15s, box-shadow 0.18s;
            box-shadow: 0 4px 16px rgba(13, 110, 253, 0.22);
        }

        .btn-register:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(13, 110, 253, 0.30);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        /* ─── Link login ─── */
        .auth-login-link {
            text-align: center;
            margin-top: 14px;
            font-size: 0.875rem;
            color: #6c757d;
        }

        .auth-login-link a {
            color: #0d6efd;
            font-weight: 700;
            text-decoration: none;
        }

        .auth-login-link a:hover {
            text-decoration: underline;
        }

        /* ─── Panel kanan: branding ─── */
        .auth-brand-panel {
            flex: 1;
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 60%, #084298 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .auth-brand-panel::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
            pointer-events: none;
        }

        .auth-brand-panel::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -50px;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            pointer-events: none;
        }

        .brand-logo {
            width: min(52%, 210px);
            height: auto;
            object-fit: contain;
            filter: brightness(0) invert(1);
            position: relative;
            z-index: 1;
        }

        /* ─── Responsive ─── */
        @media (max-width: 991.98px) {
            body {
                padding: 12px 16px;
                align-items: flex-start;
            }

            .auth-card {
                flex-direction: column;
                border-radius: 24px;
                height: auto;
                min-height: unset;
            }

            .auth-form-panel {
                flex: unset;
                width: 100%;
                padding: 26px 20px;
                overflow-y: visible;
            }

            .auth-brand-panel {
                display: none;
            }
        }

        @media (max-width: 575.98px) {
            .auth-form-title {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="auth-page">
        <div class="auth-card">

            {{-- ─── Panel Kiri: Form ─── --}}
            <div class="auth-form-panel">

                <img src="{{ asset('assets/limus-fitness-logo.png') }}" alt="Limus Fitness Centre" class="auth-form-logo">

                <h1 class="auth-form-title lexend-auth-form-title">REGISTER</h1>

                <form action="/register" method="POST" autocomplete="off">
                    @csrf

                    {{-- Name --}}
                    @error('name')
                    <div class="field-error">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                    <div class="input-field-wrap">
                        <i class="bi bi-person field-icon"></i>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Nama Lengkap"
                            name="name"
                            value="{{ old('name') }}"
                            autocomplete="name">
                    </div>

                    {{-- Email --}}
                    @error('email')
                    <div class="field-error">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                    <div class="input-field-wrap">
                        <i class="bi bi-envelope field-icon"></i>
                        <input
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email"
                            placeholder="Alamat Email"
                            value="{{ old('email') }}"
                            autocomplete="email">
                    </div>

                    {{-- Password --}}
                    @error('password')
                    <div class="field-error">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                    <div class="input-field-wrap">
                        <i class="bi bi-shield-lock field-icon"></i>
                        <input
                            id="password"
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            placeholder="Password"
                            autocomplete="new-password">
                        <button id="togglePassword" type="button" class="toggle-password-btn" aria-label="Lihat password">
                            <i id="togglePasswordIcon" class="bi bi-eye"></i>
                        </button>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="input-field-wrap">
                        <i class="bi bi-shield-check field-icon"></i>
                        <input
                            id="passwordConfirmation"
                            type="password"
                            class="form-control"
                            placeholder="Konfirmasi Password"
                            name="password_confirmation"
                            autocomplete="new-password">
                        <button id="togglePasswordConfirmation" type="button" class="toggle-password-btn" aria-label="Lihat konfirmasi password">
                            <i id="togglePasswordConfirmationIcon" class="bi bi-eye"></i>
                        </button>
                    </div>

                    <button type="submit" class="btn-register">Daftar Sekarang</button>
                </form>

                <div class="auth-login-link">
                    Sudah punya akun? <a href="/login">Masuk</a>
                </div>

            </div>

            {{-- ─── Panel Kanan: Branding ─── --}}
            <div class="auth-brand-panel">
                <img src="{{ asset('assets/limus-fitness-logo.png') }}" alt="Limus Fitness Centre" class="brand-logo">
            </div>

        </div>
    </div>

    {{-- Bootstrap 5.3 JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function attachPasswordToggle(inputId, buttonId, iconId) {
            const input = document.getElementById(inputId);
            const button = document.getElementById(buttonId);
            const icon = document.getElementById(iconId);
            if (!input || !button || !icon) return;

            button.addEventListener('click', function() {
                const isHidden = input.type === 'password';
                input.type = isHidden ? 'text' : 'password';
                icon.classList.toggle('bi-eye', !isHidden);
                icon.classList.toggle('bi-eye-slash', isHidden);
            });
        }

        attachPasswordToggle('password', 'togglePassword', 'togglePasswordIcon');
        attachPasswordToggle('passwordConfirmation', 'togglePasswordConfirmation', 'togglePasswordConfirmationIcon');
    </script>
</body>

</html>
