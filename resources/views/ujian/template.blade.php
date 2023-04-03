<!DOCTYPE html>
<html>

<head>
    <title>Selamat Ujian</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('frontend/baru/images/favicon.png') }}" rel="icon">
    <link href="{{ asset('frontend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,100&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset_ujian/css/w3.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset_ujian/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset_ujian/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('asset_ujian/admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset_ujian/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset_ujian/css/design.css') }}">

</head>

<body>
    <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('asset_ujian/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset_ujian/js/sweetalert.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <div class="wrapper">
        <div class="w3-bar" style="background-color: #dbb258;">
            <div class="row">
                <div class="col-md-4">
                    <div style="float: left; padding-top:1.5%">
                        <img src="{{ asset('frontend/baru/images/logo.png') }}" style="width:100%;">
                    </div>
                </div>

                <div class="col-md-8" id="reviews">
                    @if ($no != 0)
                        <div class="score row"
                            style="padding-left:5px;padding-right:5px; border-radius:10px; background-image: url('{{ asset('asset_ujian/img/bgg1.jpg') }}'); background-repeat:no-repeat;background-size: cover;">
                            <div class="skors">
                                <b>Batas Waktu <br> {{ $soal->waktu }}</b>
                            </div>
                            <div class="skors">
                                <b>Jumlah Soal <br> {{ $jumlahSoal }}</b>
                            </div>
                            <div class="skors">
                                <b>Soal Dijawab <br> <?= abs($sudahDijawab) ?></b>
                            </div>
                            <div class="skors" style="color:Red">
                                <b>Belum Dijawab <br> {{ abs($belumDijawab) }}</b>
                            </div>
                            <div class="btnskor">
                                <button type="button" class="btn btn-success" onclick="finish()">Selesai Ujian</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>



        </div>
        <br><br>
        <div>
            <div class="container">
                @include('ujian.pesanswal')
            </div>
            @yield('mainclient')
        </div>
    </div>
    <script>
        function openNav() {
            document.getElementById("myNav").style.width = "23%";
        }

        function closeNav() {
            document.getElementById("myNav").style.width = "0%";
        }

        function myFunctionA() {
            document.getElementById("myP").style.fontSize = "12pt";
            document.getElementById("imgsoal").style.width = "30%";
            document.getElementById("imgsoala").style.width = "65%";
            document.getElementById("imgsoalb").style.width = "65%";
            document.getElementById("imgsoalc").style.width = "65%";
            document.getElementById("imgsoald").style.width = "65%";
            document.getElementById("imgsoale").style.width = "65%";
        }

        function myFunctionAA() {
            document.getElementById("myP").style.fontSize = "large";
            document.getElementById("imgsoal").style.width = "70%";
            document.getElementById("imgsoala").style.width = "65%";
            document.getElementById("imgsoalb").style.width = "65%";
            document.getElementById("imgsoalc").style.width = "65%";
            document.getElementById("imgsoald").style.width = "65%";
            document.getElementById("imgsoale").style.width = "65%";
        }

        function myFunctionAAA() {
            document.getElementById("myP").style.fontSize = "x-large";
            document.getElementById("imgsoal").style.width = "85%";
            document.getElementById("imgsoala").style.width = "80%";
            document.getElementById("imgsoalb").style.width = "80%";
            document.getElementById("imgsoalc").style.width = "80%";
            document.getElementById("imgsoald").style.width = "80%";
            document.getElementById("imgsoale").style.width = "80%";
        }

        function myFunctionAAAA() {
            document.getElementById("myP").style.fontSize = "xx-large";
            document.getElementById("imgsoal").style.width = "100%";
            document.getElementById("imgsoala").style.width = "100%";
            document.getElementById("imgsoalb").style.width = "100%";
            document.getElementById("imgsoalc").style.width = "100%";
            document.getElementById("imgsoald").style.width = "100%";
            document.getElementById("imgsoale").style.width = "100%";
        }

        var isNS = (navigator.appName == "Netscape") ? 1 : 0;
        if (navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN || Event.MOUSEUP);

        function mischandler() {
            return false;
        }

        function mousehandler(e) {
            var myevent = (isNS) ? e : event;
            var eventbutton = (isNS) ? myevent.which : myevent.button;
            if ((eventbutton == 2) || (eventbutton == 3)) return false;
        }
        document.oncontextmenu = mischandler;
        document.onmousedown = mousehandler;
        document.onmouseup = mousehandler;

        document.onkeydown = function(e) {
            if (event.keyCode == 123) {
                return false;
            }
            if (e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.keyCode == 'H'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.keyCode == 'F'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)) {
                return false;
            }
        }
    </script>
</body>

</html>
