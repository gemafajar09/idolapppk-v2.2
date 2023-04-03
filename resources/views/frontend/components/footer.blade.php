<footer id="footer" class="footer mt-auto">

    <div class="footer-top">
        <div class="container">
            <div class="row pb-3">
                <div class="col-lg-4 d-flex align-items-center justify-content-center pt-4">
                    <div href="index.html" class="logo ">
                        <img src="{{ asset('frontend/baru/images/logo.png') }}" alt="logo.png">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="copyright">
                        &copy; Copyright <?= date('Y') ?><strong><span> IDOLAPPPK</span></strong>.All Right Reserved.
                    </div>
                    <div class="credits">

                    </div>
                </div>
                <div class="col-lg-4 d-flex align-items-center justify-content-center">
                    <div class="social-links mt-3">
                        @php
                            $kontak = DB::table('kontaks')->get();
                        @endphp
                        @foreach ($kontak as $item)
                            <a href="{{$item->link}}" class="twitter"><i class="{{$item->icon}}"></i></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


</footer>
