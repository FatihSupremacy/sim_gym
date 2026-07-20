<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Limus Fitness Centre</title>

    {{-- Bootstrap 5.3 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Google Fonts: Inter + Bebas Neue --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100dvh;
            background-color: #f4efe3;
            padding: clamp(12px, 2vw, 24px);
            display: flex;
            align-items: center;
            overflow-y: auto;
            margin: 0;
        }

        /* ── Auth Card ── */
        .auth-card {
            width: 100%;
            max-width: 1080px;
            margin: 0 auto;
            height: min(620px, calc(100dvh - 48px));
            min-height: 560px;
            background: #ffffff;
            border-radius: 34px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.10), 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        /* ── Form Panel (left) ── */
        .auth-form-panel {
            width: 44%;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 44px 48px;
            overflow-y: auto;
        }

        .auth-form-logo {
            width: 44px;
            height: 44px;
            object-fit: contain;
            margin-bottom: 22px;
        }

        .verification-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #dbeafe;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            flex-shrink: 0;
        }

        .verification-icon i {
            font-size: 1.75rem;
            color: #0d6efd;
        }

        .auth-form-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.4rem;
            letter-spacing: 0.04em;
            color: #0d6efd;
            line-height: 1.1;
            margin-bottom: 8px;
            text-align: center;
        }

        .auth-form-subtitle {
            font-size: 0.875rem;
            color: #6b7280;
            line-height: 1.55;
            margin-bottom: 28px;
        }

        /* ── Input ── */
        .input-field-wrap {
            position: relative;
            margin-bottom: 16px;
        }

        .field-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1.05rem;
            pointer-events: none;
            z-index: 2;
        }

        .auth-input {
            width: 100%;
            height: 52px;
            border-radius: 14px;
            border: 1.5px solid #e5e7eb;
            background: #f8f9fa;
            padding: 0 16px 0 44px;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            color: #111827;
            outline: none;
            transition: border-color 0.18s, box-shadow 0.18s, background 0.18s;
        }

        .auth-input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3.5px rgba(13, 110, 253, 0.13);
            background: #ffffff;
        }

        .auth-input::placeholder {
            color: #b0b7c3;
        }

        .auth-input.is-invalid {
            border-color: #fca5a5;
            background: #fff8f8;
        }

        /* ── Field Error ── */
        .field-error {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            background: #fff1f1;
            border: 1px solid #fca5a5;
            border-radius: 12px;
            padding: 9px 14px;
            font-size: 0.845rem;
            color: #dc2626;
            margin-top: 8px;
            margin-bottom: 4px;
        }

        .field-error i {
            flex-shrink: 0;
            margin-top: 1px;
            font-size: 0.9rem;
        }

        /* ── Session Alert ── */
        .session-alert {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            background: #fff1f1;
            border: 1px solid #fca5a5;
            border-radius: 12px;
            padding: 10px 14px;
            font-size: 0.875rem;
            color: #dc2626;
            margin-bottom: 18px;
        }

        .session-alert i {
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* ── Submit Button ── */
        .btn-verify {
            display: block;
            width: 100%;
            height: 52px;
            border-radius: 999px;
            background: #0d6efd;
            color: #ffffff;
            font-size: 0.97rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            border: none;
            cursor: pointer;
            transition: background 0.18s, transform 0.15s, box-shadow 0.18s;
            margin-top: 20px;
            letter-spacing: 0.02em;
        }

        .btn-verify:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.28);
        }

        .btn-verify:active {
            transform: translateY(0);
            background: #0a58ca;
        }

        /* ── Resend & Helper Links ── */
        .auth-resend {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 4px;
            margin-top: 18px;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .auth-resend-form {
            display: inline-flex;
            margin: 0;
        }

        .auth-helper-link {
            color: #0d6efd;
            font-weight: 700;
            text-decoration: none;
            border: 0;
            padding: 0;
            background: transparent;
            font: inherit;
            cursor: pointer;
            transition: color 0.15s;
        }

        .auth-helper-link:hover {
            color: #0a58ca;
            text-decoration: underline;
        }

        .auth-back-link {
            width: 100%;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 999px;
            color: #6b7280;
            background: #ffffff;
            box-shadow: 0 3px 12px rgba(15, 23, 42, 0.07);
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.15s, border-color 0.15s, transform 0.15s, box-shadow 0.15s;
        }

        .auth-back-link:hover {
            color: #0d6efd;
            border-color: #bfdbfe;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.1);
        }

        /* ── Brand Panel (right) ── */
        .auth-brand-panel {
            flex: 1;
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 60%, #084298 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Decorative circles */
        .auth-brand-panel::before,
        .auth-brand-panel::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.07);
            pointer-events: none;
        }

        .auth-brand-panel::before {
            width: 420px;
            height: 420px;
            top: -110px;
            right: -110px;
        }

        .auth-brand-panel::after {
            width: 280px;
            height: 280px;
            bottom: -80px;
            left: -60px;
        }

        .brand-inner {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }

        .brand-circle-deco {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            pointer-events: none;
        }

        .brand-circle-deco:nth-child(1) {
            width: 180px;
            height: 180px;
            top: 50%;
            left: 50%;
            transform: translate(-130%, -160%);
        }

        .brand-circle-deco:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 50%;
            left: 50%;
            transform: translate(40%, 60%);
        }

        .auth-brand-logo {
            width: min(52%, 210px);
            filter: brightness(0) invert(1);
            display: block;
        }

        /* ── Responsive ── */
        @media (max-width: 767px) {
            body {
                padding: 14px;
                align-items: flex-start;
            }

            .auth-card {
                height: auto;
                min-height: unset;
                border-radius: 24px;
                flex-direction: column;
            }

            .auth-form-panel {
                width: 100%;
                padding: 26px 20px;
            }

            .auth-brand-panel {
                display: none;
            }
        }

        @media (min-width: 768px) and (max-width: 1024px) {
            .auth-form-panel {
                padding: 36px 36px;
            }
        }
    </style>
</head>

<body>
    <div class="auth-card">

        {{-- ── Form Panel (Left) ── --}}
        <div class="auth-form-panel">

            <img src="{{ asset('assets/limus-fitness-logo.png') }}" alt="Limus Fitness Centre" class="auth-form-logo">

            <div class="verification-icon">
                <i class="bi bi-envelope-check"></i>
            </div>

            <h1 class="auth-form-title">VERIFIKASI OTP</h1>
            <p class="auth-form-subtitle">Masukkan kode OTP yang dikirim untuk memverifikasi akun kamu</p>

            {{-- Session Failed Alert --}}
            @if (session('failed'))
            <div class="session-alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span>{{ session('failed') }}</span>
            </div>
            @endif

            <form action="/verify/{{ $unique_id }}" method="POST">
                @method('PUT')
                @csrf

                {{-- OTP Input --}}
                <div class="input-field-wrap">
                    <span class="field-icon"><i class="bi bi-shield-check"></i></span>
                    <input
                        type="number"
                        class="auth-input @error('otp') is-invalid @enderror"
                        name="otp"
                        value="{{ old('otp') }}"
                        placeholder="Masukkan kode OTP"
                        autocomplete="one-time-code"
                        autofocus>
                    @error('otp')
                    <div class="field-error">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn-verify">Verifikasi</button>
            </form>

            {{-- Resend OTP --}}
            <div class="auth-resend">
                <span>Belum menerima kode?</span>
                <form action="/verify" method="POST" class="auth-resend-form">
                    @csrf
                    <input type="hidden" name="type" value="register">
                    <button type="submit" class="auth-helper-link">Kirim ulang OTP</button>
                </form>
            </div>

            <a href="/login" class="auth-back-link">
                Kembali ke login
            </a>

        </div>

        {{-- ── Brand Panel (Right) ── --}}
        <div class="auth-brand-panel">
            <div class="brand-circle-deco"></div>
            <div class="brand-circle-deco"></div>
            <div class="brand-inner">
                <img
                    src="{{ asset('assets/limus-fitness-logo.png') }}"
                    alt="Limus Fitness Centre"
                    class="auth-brand-logo">
            </div>
        </div>

    </div>

    {{-- Bootstrap 5.3 JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
