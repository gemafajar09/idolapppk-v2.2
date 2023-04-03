<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">


    <title>@yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">


    @include('user.includes.link')
</head>

<body class="pb-10">



    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top align-items-center hidden lg:flex">

        <div class="d-flex align-items-center justify-content-between ">
            <i class="bi bi-list toggle-sidebar-btn"></i>
            <a href="index.html" class="logo d-flex align-items-left text-center pl-5">
                <img src="{{ asset('frontend/baru/images/logo.png') }}" alt="" class="">
            </a>
        </div><!-- End Logo -->



        {{-- <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

            </ul>
        </nav><!-- End Icons Navigation --> --}}

    </header><!-- End Header -->


    <!-- ======= Sidebar ======= -->
    @include('user.includes.sidebar')

    <main id="main" class="main mt-3 lg:!mt-20">
        @include('frontend.components.alert')
        @yield('content')
    </main><!-- End #main -->

    @include('components.fab')

    <!-- ======= Navbar ======= -->
    @include('user.includes.navbar')

    <!-- ======= Footer ======= -->
    {{-- <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer --> --}}

    {{-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a> --}}

    <!-- Vendor JS Files -->
    <script src="{{ asset('/') }}assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/chart.js/chart.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/echarts/echarts.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/quill/quill.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="{{ asset('/') }}assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('/') }}assets/js/main.js"></script>
    {{-- session flash --}}
    @if (session()->has('success'))
        <script>
            $('#success').show();
            setInterval(function() {
                $('#success').hide();
            }, 5000);
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            $('#error').show();
            setInterval(function() {
                $('#error').hide();
            }, 5000);
        </script>
    @endif

    <!--<script>-->
    <!--    document.onkeydown = function(e) {-->
    <!--        if (event.keyCode == 123) {-->
    <!--            return false;-->
    <!--        }-->
    <!--        if (e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)) {-->
    <!--            return false;-->
    <!--        }-->
    <!--        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {-->
    <!--            return false;-->
    <!--        }-->
    <!--        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {-->
    <!--            return false;-->
    <!--        }-->
    <!--        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {-->
    <!--            return false;-->
    <!--        }-->
    <!--        if (e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)) {-->
    <!--            return false;-->
    <!--        }-->
    <!--        if (e.ctrlKey && e.keyCode == 'H'.charCodeAt(0)) {-->
    <!--            return false;-->
    <!--        }-->
    <!--        if (e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)) {-->
    <!--            return false;-->
    <!--        }-->
    <!--        if (e.ctrlKey && e.keyCode == 'F'.charCodeAt(0)) {-->
    <!--            return false;-->
    <!--        }-->
    <!--        if (e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)) {-->
    <!--            return false;-->
    <!--        }-->
    <!--    }-->

    <!--    var isNS = (navigator.appName == "Netscape") ? 1 : 0;-->
    <!--    if (navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN || Event.MOUSEUP);-->

    <!--    function mischandler() {-->
    <!--        return false;-->
    <!--    }-->

    <!--    function mousehandler(e) {-->
    <!--        var myevent = (isNS) ? e : event;-->
    <!--        var eventbutton = (isNS) ? myevent.which : myevent.button;-->
    <!--        if ((eventbutton == 2) || (eventbutton == 3)) return false;-->
    <!--    }-->
    <!--    document.oncontextmenu = mischandler;-->
    <!--    document.onmousedown = mousehandler;-->
    <!--    document.onmouseup = mousehandler;-->
    <!--</script>-->
    {{--  --}}
    @stack('addon-script')

</body>

</html>
