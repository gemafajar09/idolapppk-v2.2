<x-template title="Soal">
    <div class="row">
        <div class="col-md-12">
            <x-element.card title="Data Soal">
                <x-slot name="button">
                    <x-element.button name="" class="primary text-white" type="button" onclick="tampils()">
                        <x-slot name="span">
                            <i class="far fa-plus"></i>
                            Tambah Data
                        </x-slot>
                    </x-element.button>
                </x-slot>
                <div class="table-responsive">
                    <table class="table datatable" style="font-size:14px">
                        <thead>
                            <tr>
                                <th style="width:5%">No</th>
                                <th style="width:20%">Paket Soal</th>
                                <th style="width:20%">Paket Try Out</th>
                                <th style="width:15%">Alokasi Waktu</th>
                                <th style="width:15%">Jumlah Soal</th>
                                <th style="width:25%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soal as $i => $a)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $a->nama_paket }}</td>
                                    <td>{{ $a->nama_fasilitas }}</td>
                                    <td>{{ $a->waktu }} Menit</td>
                                    <td>{{ $a->total }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm text-white"
                                            onclick="setting('{{ $a->id_paket }}','{{ $a->id_fasilitas }}')">
                                            <i class="icon ri-tools-fill"></i>Skor</button>

                                        {{-- <button type="button" class="btn btn-info btn-sm text-white"
                                            onclick="infoSkors('{{ $a->id_paket }}','{{ $a->id_fasilitas }}')">
                                            <i class="icon ri-file-info-fill"></i>Skor</button> --}}

                                        <a href="{{ url('backend/soal-list/' . $a->id . '/' . $a->id_fasilitas) }}"
                                            class="btn btn-warning btn-sm text-white">
                                            <i class="icon ri-file-list-3-fill"></i>Soal</a>

                                        <button type="button" class="btn btn-danger btn-sm text-white"
                                            onclick="hapus('{{ $a->id_paket }}','{{ $a->id_fasilitas }}')">
                                            <i class="icon ri-delete-bin-5-fill"></i>Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-element.card>
        </div>
    </div>

    {{-- tambah --}}
    <x-element.modal id="tambahSoal" action="{{ route('soal-add') }}">
        <x-slot name="title">
            Tambah Data
        </x-slot>
        {{-- inputan --}}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Materi Soal</label>
                    <select class="form-control" name="id_paket" id="id_paket">
                        <option value="" disable>-Pilih-</option>
                        @foreach ($paket as $pkt)
                            <option value="{{ $pkt->id }}">{{ $pkt->nama_paket }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <div id="datax"></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Alokasi Waktu</label>
                    <input type="text" placeholder="contoh: 120 (*menit)" name="waktu" class="form-control">
                </div>
            </div>
        </div>
        <input type="hidden" name="type" value="2">

        <div id="excel" style="display:block">
            <div class="form-group">
                <label for="">Upload File Excel</label>
                <input type="file" class="form-control" name="file">
            </div>
            <br>
            <span>Download Format Excel Disini <a href="{{ asset('template_soal/paket-soal.xlsx') }}"
                    class="btn btn-success btn-sm"><i class="fas fa-sownload">Download</i></a> </span>
        </div>

    </x-element.modal>

    {{-- modal setting soal --}}
    <div id="settingSoal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Setting Soal</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" id="paket">
                        <input type="hidden" id="fasilitas">
                        <div class="row" style="font-size:12px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Kompetensi Teknis</label>
                                    <input type="number" id="teknis" placeholder="Contoh: 50" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Kompetensi Manajerial</label>
                                    <input type="number" id="manajer" placeholder="Contoh: 12" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Kompetensi Sosio Kultural</label>
                                    <input type="number" id="sosio" placeholder="Contoh: 8" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Kompetensi Wawancara</label>
                                    <input type="number" id="wawancara" placeholder="Contoh: 8" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 py-2" align="right">
                                <button type="button" onclick="changeBobot()" class="btn btn-primary">Ubah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    {{-- modal info soal --}}
    <div id="infoskorsoalujian" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Info Skor Soal</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" id="idx">
                        <input type="hidden" id="paketx">
                        <input type="hidden" id="fasilitasx">
                        <textarea name="" id="infoskorsoal" cols="30" rows="10" class="form-control"></textarea>
                        <div class="col-md-12 py-2" align="right">
                            <button type="button" onclick="simpanInfo()" class="btn btn-primary">Simpan
                                Informasi</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        function tampils() {
            $('#tambahSoal').modal('show')
        }

        function infoSkors(id_paket, fasilitas) {
            $.ajax({
                url: '{{ url('backend/informasi-ambil') }}/' + id_paket + "/" + fasilitas,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#informasi').val(data.informasi);
                }
            })
            $('#infoskorsoalujian').modal('show')
            $('#paketx').val(id_paket)
            $('#fasilitasx').val(fasilitas)
        }

        function simpanInfo() {
            var id = $('#idx').val();
            var id_paket = $('#paketx').val();
            var id_fasilitas = $('#fasilitasx').val();
            var informasi = $('#infoskorsoal').val();
            $.ajax({
                url: '{{ url('backend/informasi-simpan') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    'id_paket': id_paket,
                    'id_fasilitas': id_fasilitas,
                    'informasi': informasi,
                    'id': id,
                    '_token': '{{ csrf_token() }}'

                },
                success: function(data) {
                    $('#informasi').val(data.informasi);
                }
            })
            $('#infoskorsoalujian').modal('hide')
        }

        function setting(paket, fasilitas) {
            $.ajax({
                url: '{{ url('ujian/cekSkor') }}/' + paket + "/" + fasilitas,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#teknis').val(data.teknis);
                    $('#manajer').val(data.manajer);
                    $('#sosio').val(data.sosio);
                    $('#wawancara').val(data.wawancara);
                    console.log(data);
                }
            })
            $('#settingSoal').modal('show')
            $('#paket').val(paket)
            $('#fasilitas').val(fasilitas)
        }

        $("input[type='radio']").click(function() {
            var radioValue = $("input[name='type']:checked").val();
            if (radioValue == 1) {
                $('#text').show();
                $('#excel').hide();
                $('#file').hide();
            } else if (radioValue == 2) {
                $('#text').hide();
                $('#excel').show();
                $('#file').hide();
            }
        });

        // add row
        function addRow() {
            // Create a text node:
            $('#formInput').clone().appendTo("#clone");
        }

        function hapus(id, fasilitas) {
            Swal.fire({
                title: 'Yakin Ingin Menghapus Data?',
                showDenyButton: true,
                confirmButtonText: '<a style="color:white" href="soal-delete/' + id + '/' + fasilitas +
                    '">Hapus</a>',
                denyButtonText: `Batal Hapus`,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Berhasil Menghapus Data!', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Batal Menghapus Data', '', 'info')
                }
                window.location.reload()
            })
        }

        $('#id_paket').change(function() {
            var id = $('#id_paket').val();
            $.ajax({
                url: 'select-fasilitas/' + id,
                type: 'GET',
                dataType: 'HTML',
                success: function(data) {
                    $('#datax').html(data)
                }

            })
        })

        function changeBobot() {
            var paket = $('#paket').val()
            var fasilitas = $('#fasilitas').val()

            var teknis = $('#teknis').val()
            var manajer = $('#manajer').val()
            var sosio = $('#sosio').val()
            var wawancara = $('#wawancara').val()
            $.ajax({
                url: '{{ url('ujian/skorKopetensi') }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'paket': paket,
                    'fasilitas': fasilitas,
                    'teknis': teknis,
                    'manajer': manajer,
                    'sosio': sosio,
                    'wawancara': wawancara
                },
                success: function(data) {
                    $('#infoskorsoalujian').modal('hide')
                }
            })
        }
    </script>
</x-template>
