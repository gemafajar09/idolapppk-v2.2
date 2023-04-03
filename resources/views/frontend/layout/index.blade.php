<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.components.style')
</head>

<body class="d-flex flex-column min-vh-100">

    @if (session()->has('id_pengguna'))
        @include('frontend.components.header_login')
    @else
        @include('frontend.components.header')
    @endif

    @yield('hero')

    <main id="main">
        @yield('content')
    </main>

    @include('components.fab')

    @include('frontend.components.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('frontend.components.script')

    @stack('addon-script')

</body>

</html>
