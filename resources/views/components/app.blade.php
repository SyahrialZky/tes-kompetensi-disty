<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        @include('components.sidebar')
        <div class="main-panel">
            @include('components.navbar')
            <div class="content">
                @yield('content')
            </div>
            @include('components.footer')
        </div>
    </div>
    
    <!-- Scripts -->

    <!-- Fonts and icons -->
    <script src=" {{ asset('assets/js/plugin/webfont/webfont.min.js') }} "></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ['assets/css/fonts.min.css' ],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src=" {{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}  "></script>

    <!-- Chart JS -->
    <script src=" {{ asset('assets/js/plugin/chart.js/chart.min.js') }} "></script>

    <!-- jQuery Sparkline -->
    <script src=" {{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }} "></script>

    <!-- Chart Circle -->
    <script src=" {{ asset('assets/js/plugin/chart-circle/circles.min.js') }} "></script>

    <!-- Datatables -->
    <script src=" {{ asset('assets/js/plugin/datatables/datatables.min.js') }} "></script>

    <!-- Bootstrap Notify -->
    <script src=" {{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }} "></script>

    <!-- Sweet Alert -->
    <script src=" {{ asset('assets/js/plugin/sweetalert/sweetalert.min.js')}} "></script>

    <!-- Kaiadmin JS -->
    <script src=" {{ asset('assets/js/kaiadmin.min.js') }} "></script>

    @stack('scripts')
</body>
</html>
