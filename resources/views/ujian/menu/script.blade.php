{{-- <script src="{{ asset('asset_ujian/js/store.everything.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('asset_ujian/js/pace.min.js') }}"></script> --}}

<script>
    // Set the date we're counting down to
    // var countDownDate = new Date("Jan 5, 2024 15:37:25").getTime();
    var countDownDate = new Date("{{ date('M d, Y H:i:s', strtotime($mulai->waktu_selesai)) }}").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        $(".demo").html(hours + ":" +
            minutes + ":" + seconds + "");

        $("#demo").html(hours + ":" +
            minutes + ":" + seconds + "");

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "Waktu Habis";
            document.getElementById('waktu-habis').submit();
        }
    }, 1000);
</script>
