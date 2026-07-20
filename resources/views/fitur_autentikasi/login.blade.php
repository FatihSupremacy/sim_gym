<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Limus Fitness Centre</title>

    <link rel="shortcut icon" href="{{ asset('assets/limus-fitness-logo.png') }}" type="image/png">

    {{-- Bootstrap 5.3 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Google Font: Inter & Bebas Neue --}}
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
            padding: 38px 42px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }

        .auth-form-logo {
            width: 74px;
            height: auto;
            object-fit: contain;
            margin-bottom: 16px;
        }

        .auth-form-title {
            font-family: "Bebas Neue", sans-serif;
            font-weight: 400;
            font-style: normal;
            letter-spacing: 0.04em;
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
            margin-bottom: 22px;
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

        /* ─── Alert validasi & session ─── */
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

        /* ─── Remember me ─── */
        .remember-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
        }

        .remember-wrap .form-check-input {
            width: 16px;
            height: 16px;
            border: 1.5px solid #d1d5db;
            border-radius: 5px;
            cursor: pointer;
            flex-shrink: 0;
            margin: 0;
        }

        .remember-wrap .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .remember-wrap .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
            outline: none;
        }

        .remember-wrap label {
            font-size: 0.845rem;
            color: #6c757d;
            cursor: pointer;
            user-select: none;
        }

        /* ─── Tombol login ─── */
        .btn-login {
            width: 100%;
            height: 52px;
            border-radius: 999px;
            background: #0d6efd;
            border: none;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.975rem;
            letter-spacing: 0.01em;
            margin-top: 14px;
            transition: background 0.18s, transform 0.15s, box-shadow 0.18s;
            box-shadow: 0 4px 16px rgba(13, 110, 253, 0.22);
        }

        .btn-login:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(13, 110, 253, 0.30);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* ─── Divider ─── */
        .auth-divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 14px 0;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .auth-divider span {
            font-size: 0.8rem;
            color: #9ca3af;
            font-weight: 500;
            white-space: nowrap;
        }

        /* ─── Tombol Google ─── */
        .btn-google {
            width: 100%;
            height: 50px;
            border-radius: 999px;
            border: 1.5px solid #e5e7eb;
            background: #ffffff;
            color: #111111;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            transition: background 0.15s, border-color 0.15s, transform 0.15s;
        }

        .btn-google:hover {
            background: #f8f9fa;
            border-color: #d1d5db;
            transform: translateY(-1px);
            color: #111111;
        }

        /* ─── Link bawah ─── */
        .auth-footer-links {
            text-align: center;
            margin-top: 14px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .auth-footer-links p {
            margin: 0;
            font-size: 0.875rem;
            color: #6c757d;
        }

        .auth-footer-links a {
            color: #0d6efd;
            font-weight: 700;
            text-decoration: none;
        }

        .auth-footer-links a:hover {
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

                <h1 class="auth-form-title lexend-auth-form-title">LOGIN</h1>

                {{-- Session failed --}}
                @if (session('failed'))
                <div class="field-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ session('failed') }}</span>
                </div>
                @endif

                <form action="/login" method="POST" autocomplete="off">
                    @csrf

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
                            autocomplete="current-password">
                        <button id="togglePassword" type="button" class="toggle-password-btn" aria-label="Lihat password">
                            <i id="togglePasswordIcon" class="bi bi-eye"></i>
                        </button>
                    </div>

                    {{-- Remember me --}}
                    <div class="remember-wrap">
                        <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                        <label for="rememberMe">Ingat saya</label>
                    </div>

                    <button type="submit" class="btn-login">Masuk</button>
                </form>

                {{-- Divider --}}
                <div class="auth-divider">
                    <span>atau</span>
                </div>

                {{-- Google login --}}
                <a href="/auth-google-redirect" class="btn-google">
                    <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C4 20.53 7.7 23 12 23z" />
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 4 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>
                    <span>Masuk dengan Google</span>
                </a>

                {{-- Footer links --}}
                <div class="auth-footer-links">
                    <p>Belum punya akun? <a href="/register">Daftar</a></p>
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
    </script>
</body>

</html>