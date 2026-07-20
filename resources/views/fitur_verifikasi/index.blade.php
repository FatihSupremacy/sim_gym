<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Akun - Limus Fitness Centre</title>

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

        /* ── Verification Icon ── */
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
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 28px;
        }

        /* ── Submit Button ── */
        .btn-verify {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
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

        /* ── Helper Links ── */
        .auth-resend {
            text-align: center;
            margin-top: 18px;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .auth-helper-link {
            color: #0d6efd;
            font-weight: 700;
            text-decoration: none;
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

            <h1 class="auth-form-title">VERIFIKASI AKUN</h1>
            <p class="auth-form-subtitle">Klik tombol di bawah untuk mengirim kode OTP ke email yang kamu gunakan saat pendaftaran</p>

            <form action="/verify" method="POST">
                @csrf
                <input type="hidden" value="register" name="type">

                <button type="submit" class="btn-verify">
                    <i class="bi bi-send"></i>
                    Kirim OTP ke Email
                </button>
            </form>
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
