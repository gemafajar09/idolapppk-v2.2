<!-- Vendor JSFiles -->
<script src="{{ asset('frontend/assets/vendor/purecounter/purecounter.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->

<script src="{{ asset('frontend/assets/js/main.js') }}"></script>
<script src="{{ asset('frontend/assets/vendor/carousel/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/baru/js/main.js') }}"></script>

<script>
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
</script>


{{-- third part --}}
<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 15,
            center: true,
            autoplay: true,
            responsiveClass: true,
            navigation: false,
            dots: false,
            autoHeight: true,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });

        $('.js-example-basic-single').select2();
        $('.js-example-basic-single1').select2();
    });
</script>
{{-- end third part --}}



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
