<x-template title="Laporan">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card" style="min-height: 10rem;">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <i class="bi bi-printer-fill text-primary" style="font-size: 55px;"></i>
                                </div>
                                <div class="col-md-9">
                                    <h5 style="color: #65c600;" class="mt-3 mb-4">Laporan Pendapatan</h5>
                                </div>
                            </div>
                            <a href="{{route('laporan.pendapatan')}}"
                                class="btn btn-outline-success mt-2">Lihat</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card" style="min-height: 10rem;">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <i class="bi bi-printer-fill text-primary" style="font-size: 55px;"></i>
                                </div>
                                <div class="col-md-9">
                                    <h5 style="color: #65c600;" class="mt-3 mb-4">Laporan Pencairan</h5>
                                </div>
                            </div>
                            <a href="{{route('laporan.pencairan')}}"
                                class="btn btn-outline-success mt-2">Lihat</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Left side columns -->

    </div>



</x-template>
