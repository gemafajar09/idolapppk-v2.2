<section id="faq" class="faq">

    <div class="container" data-aos="fade-up">

        <header class="section-header">
            <h2>F.A.Q</h2>
            <p>Frequently Asked Questions</p>
        </header>
        @php
            $dataFaq = DB::table('faqs')->get();
            $listFaq1 = [];
            $listFaq2 = [];
            foreach ($dataFaq as $key => $value) {
                if ($key % 2 == 0) {
                    $listFaq1[] = $value;
                } else {
                    $listFaq2[] = $value;
                }
            }
        @endphp

        <div class="row">
            <div class="col-lg-6">
                <!-- F.A.Q List 1-->
                <div class="accordion accordion-flush" id="faqlist1">
                    @foreach ($listFaq1 as $key => $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-content-{{ $key }}">
                                    {{ $item->pertanyaan }}
                                </button>
                            </h2>
                            <div id="faq-content-{{ $key }}" class="accordion-collapse collapse"
                                data-bs-parent="#faqlist1">
                                <div class="accordion-body">
                                    {{ $item->jawaban }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-6">

                <!-- F.A.Q List 2-->
                <div class="accordion accordion-flush" id="faqlist2">

                    @foreach ($listFaq2 as $key => $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2-content-{{$key}}">
                                    {{ $item->pertanyaan }}
                                </button>
                            </h2>
                            <div id="faq2-content-{{$key}}" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                <div class="accordion-body">
                                    {{ $item->jawaban }}
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>

        </div>

    </div>

</section><!-- End F.A.Q Section -->
