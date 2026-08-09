<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Limus Fitness Centre</title>



    <link rel="icon" href="{{ asset('assets/Logo-navbar-2.png') }}" type="image/png">



    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/compiled/css/iconly.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>
    <div id="app">
        @include('layout.sidebar')

        <div id="main">
            <div class="page-content">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('/mazer/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>


    <script src="{{ asset('/mazer/assets/compiled/js/app.js') }}"></script>



    <!-- Need: Apexcharts -->
    <script src="{{ asset('/mazer/assets/extensions/apexcharts/apexcharts.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @stack('scripts')



    @if(session('pesan'))
    <div class="toast-container position-fixed bottom-0 end-0 p-4" style="z-index: 9999;">
        <div id="toastSuccess" class="toast align-items-center border" role="alert" aria-live="assertive" aria-atomic="true"
            style="
                background: #FFFFFF;
                border-color: #E5E7EB !important;
                border-radius: 16px;
                box-shadow: 0 1px 3px rgba(0,0,0,.06), 0 8px 24px rgba(0,0,0,.08);
                min-width: 320px;
                padding: 4px 0;
            ">
            <div class="d-flex align-items-center justify-content-between px-4 py-3 gap-3">
                <div style="
                    width: 32px; height: 32px;
                    border-radius: 999px;
                    background: #22C55E;
                    display: flex; align-items: center; justify-content: center;
                    flex-shrink: 0;">
                    <i class="bi bi-check-lg text-white" style="font-size: 15px; line-height: 0; display:block;"></i>
                </div>
                <span style="font-size: 14px; font-weight: 600; color: #1F2937; flex: 1;">
                    {{ session('pesan') }}
                </span>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"
                    style="font-size: 11px; opacity: 0.4;"></button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastEl = document.getElementById('toastSuccess');
            if (toastEl) {
                var toast = new bootstrap.Toast(toastEl, { delay: 3000 });
                toast.show();
            }
        });
    </script>
    @endif

    @if(session('warning'))
    <div class="toast-container position-fixed bottom-0 end-0 p-4" style="z-index: 9999;">
        <div id="toastWarning" class="toast align-items-center border" role="alert" aria-live="assertive" aria-atomic="true"
            style="
                background: #FFFFFF;
                border-color: #F59E0B !important;
                border-radius: 16px;
                box-shadow: 0 1px 3px rgba(0,0,0,.06), 0 8px 24px rgba(0,0,0,.08);
                min-width: 320px;
                padding: 4px 0;
            ">
            <div class="d-flex align-items-center justify-content-between px-4 py-3 gap-3">
                <div style="
                    width: 32px; height: 32px;
                    border-radius: 999px;
                    background: #F59E0B;
                    display: flex; align-items: center; justify-content: center;
                    flex-shrink: 0;">
                    <i class="bi bi-exclamation-lg text-white" style="font-size: 15px; line-height: 0; display:block;"></i>
                </div>
                <span style="font-size: 14px; font-weight: 600; color: #1F2937; flex: 1;">
                    {{ session('warning') }}
                </span>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"
                    style="font-size: 11px; opacity: 0.4;"></button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastEl = document.getElementById('toastWarning');
            if (toastEl) {
                var toast = new bootstrap.Toast(toastEl, { delay: 3000 });
                toast.show();
            }
        });
    </script>
    @endif

</body>

</html>