<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- link -->
    <x-link></x-link>

</head>

<body>
    {{-- jsuery --}}
    <script src="{{ asset('/') }}assets/js/jquery.min.js"></script>
    {{-- sweetalert --}}
    <script src="{{ asset('/') }}assets/sweetalert/sweetalert.min.js"></script>
    {{-- summernote --}}
    <script src="{{ asset('/') }}assets/summernote/summernote.js"></script>

    {{-- toastr --}}
    <script src="{{ asset('/') }}assets/toastr/toastr.js"></script>

    <!-- header -->
    <x-header></x-header>

    <!-- sidebar -->
    <x-sidebar></x-sidebar>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $title }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $title }}</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            {{ $slot }}
            {{-- alaert --}}
            @if (session('success') != null)
                <script>
                    toastr.success("{{ session('success') }}")
                </script>
                @Session::forget('success')
            @endif

            @if (session('error') != null)
                <script>
                    toastr.error("{{ session('error') }}")
                </script>
                @Session::forget('error')
            @endif
        </section>

    </main>

    <!-- logout -->
    <div class="modal fade" id="logout" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Peringatan!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('logouts') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        Yakin Ingin Keluar?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- script -->
    <x-script></x-script>
</body>

</html>
