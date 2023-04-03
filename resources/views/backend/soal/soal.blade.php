<x-template title="Soal">
    <div class="row">
        <div class="col-md-12">
            <x-element.card title="Data Soal">
                <x-slot name="button">

                </x-slot>
                <x-element.table :header="[
                    'No',
                    'Soal',
                    'Jawaban A',
                    'Jawaban B',
                    'Jawaban C',
                    'Jawaban D',
                    'Jawaban E',
                    'Skor a',
                    'Skor b',
                    'Skor c',
                    'Skor d',
                    'Skor e',
                    'Aksi',
                ]">
                    @foreach ($soal as $i => $a)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td><?= Str::substr($a->soal, 0, 100) ?></td>
                            <td>{{ $a->a }}</td>
                            <td>{{ $a->b }}</td>
                            <td>{{ $a->c }}</td>
                            <td>{{ $a->d }}</td>
                            <td>{{ $a->e }}</td>
                            <td>{{ $a->jawaban_a }}</td>
                            <td>{{ $a->jawaban_b }}</td>
                            <td>{{ $a->jawaban_c }}</td>
                            <td>{{ $a->jawaban_d }}</td>
                            <td>{{ $a->jawaban_e }}</td>
                            <td width="12%">
                                <x-element.button class="warning text-white btn-sm"
                                    onclick="edits('{{ $a->id_soal }}')" name="Edit" type="button">
                                </x-element.button>
                                <x-element.button class="danger text-white btn-sm"
                                    onclick="hapus('{{ $a->id_soal }}')" name="Hapus" type="button">
                                </x-element.button>
                            </td>
                        </tr>
                    @endforeach
                </x-element.table>
            </x-element.card>
        </div>
    </div>

    {{-- Edit --}}
    <x-element.modal id="editSoal" action="{{ route('soal-list-update') }}">
        <x-slot name="title">
            Edit Data
        </x-slot>
        {{-- inputan --}}
        <input type="hidden" name="id_soal" id="id_soal" value="">

        <div class="row">
            <div id="formInput" class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <input type="text" readonly name="kategori" id="kategori" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Upload Foto</label>
                            <input type="file" name="gambar" onchange="return tampilfoto()" id="gambar"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-10">
                                <div id="showGambar"></div>
                            </div>
                            <div class="col-md-2" id="hpsGmbr" style="display: none">
                                <button type="button" onclick="hapusGambar()" class="btn btn-danger btn-sm"><i
                                        class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Soal</label>
                            <textarea class="form-control summer" name="soal" id="soal" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="">Jawaban A</label>
                            <input type="text" name="a" id="a" placeholder="Jawaban A" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Skor A</label>
                            <input type="text" name="skora" id="skora" placeholder="Bobot Soal" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="">Jawaban B</label>
                            <input type="text" name="b" id="b" placeholder="Jawaban B" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Skor B</label>
                            <input type="text" name="skorb" id="skorb" placeholder="Bobot Soal" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="">Jawaban C</label>
                            <input type="text" name="c" id="c" placeholder="Jawaban C" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Skor C</label>
                            <input type="text" name="skorc" id="skorc" placeholder="Bobot Soal" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="">Jawaban D</label>
                            <input type="text" name="d" id="d" placeholder="Jawaban D" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Skor D</label>
                            <input type="text" name="skord" id="skord" placeholder="Bobot Soal" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-10 jwbe">
                        <div class="form-group">
                            <label for="">Jawaban E</label>
                            <input type="text" name="e" id="e" placeholder="Jawaban E" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2 jwbe">
                        <div class="form-group">
                            <label for="">Skor E</label>
                            <input type="text" name="skore" id="skore" placeholder="Bobot Soal" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Pembahasan</label>
                            <input type="radio" name="cekPembahasan" id="text" onclick="bukatext()" value="text"> Text
                            &nbsp;
                            <input type="radio" name="cekPembahasan" id="gambarT" onclick="bukagambar()" value="gambar">
                            Gambar
                            <textarea name="pembahasan" id="pembahasan" style="display: none" class="form-control summer"></textarea>
                            <div class="row" id="pembahasan_gambar" style="display: none">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Upload Foto</label>
                                        <input type="file" name="gambar_pembahasan" onchange="return tampilfoto()"
                                            id="gambar_pembahasan" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div id="showGambarPembahasan"></div>
                                        </div>
                                        <div class="col-md-2" id="hpsGmbr1" style="display: none">
                                            <button type="button" onclick="hapusGambar2()"
                                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Jawaban Terbaik</label>
                            <textarea name="jawaban_terbaik" id="jawaban_terbaik" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">level</label>
                            <textarea name="level" id="level" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Indikator</label>
                            <textarea name="indikator" id="indikator" class="form-control"></textarea>
                        </div>
                    </div>

                </div>
                <hr class="divider">
                </hr>
            </div>
            <div id="clone"></div>
        </div>

    </x-element.modal>

    <script>
        var idSoal, gambarSoal, pembahasanGambar;

        function hapusGambar() {
            $.ajax({
                url: '{{ url('backend/hapus-gambar') }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': idSoal,
                    'gambar': gambarSoal
                },
                success: function(data) {
                    $('#showGambar').html(
                        '<img src="{{ asset('/') }}upload/noimage/noimage.jpg" width="120px">')

                }
            })
        }

        function hapusGambar2() {
            $.ajax({
                url: '{{ url('backend/hapus-gambar') }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': idSoal,
                    'gambar': pembahasanGambar
                },
                success: function(data) {
                    $('#showGambarPembahasan').html(
                        '<img src="{{ asset('/') }}upload/noimage/noimage.jpg" width="120px">')

                }
            })
        }

        function bukatext() {
            $('#pembahasan').show()
            $('#pembahasan_gambar').hide()
        }

        function bukagambar() {
            $('#pembahasan').hide()
            $('#pembahasan_gambar').show()
            $('#showGambarPembahasan').html(
                '<img src="{{ asset('/') }}upload/noimage/noimage.jpg" width="120px">')
        }

        function tampils() {
            $('#tambahSoal').modal('show')
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

        function hapus(id) {
            Swal.fire({
                title: 'Yakin Ingin Menghapus Data?',
                showDenyButton: true,
                confirmButtonText: '<a style="color:white" href="../soal-list-delete/' + id + '">Hapus</a>',
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

        function edits(id) {
            $.ajax({
                url: "{{ url('backend/soal-list-edit') }}/" + id,
                type: "get",
                dataType: "json",
                success: function(data) {
                    $('#editSoal').modal('show');

                    // if (data.data.e == null) {
                    //     $('.jwbe').hide()
                    // }

                    idSoal = id;
                    gambarSoal = data.data.gambar;
                    pembahasanGambar = data.data.pembahasan_gambar;

                    $('#id_soal').val(id)
                    $('#soal').summernote("code", data.data.soal)
                    $('#a').val(data.data.a)
                    $('#b').val(data.data.b)
                    $('#c').val(data.data.c)
                    $('#d').val(data.data.d)
                    $('#e').val(data.data.e)
                    $('#skora').val(data.data.jawaban_a)
                    $('#skorb').val(data.data.jawaban_b)
                    $('#skorc').val(data.data.jawaban_c)
                    $('#skord').val(data.data.jawaban_d)
                    $('#skore').val(data.data.jawaban_e)

                    $('#pembahasan').summernote("code", data.data.pembahasan)
                    $('#jawaban_terbaik').val(data.data.jawaban_terbaik)
                    $('#level').val(data.data.level)
                    $('#deskripsi').val(data.data.deskripsi)
                    $('#indikator').val(data.data.indikator)
                    $('#kategori').val(data.data.kategori)

                    if (data.data.pembahasan != null) {
                        document.getElementById('text').checked = true
                        document.getElementById('gambarT').checked = false
                        bukatext()
                    } else if (data.data.pembahasan_gambar != null) {
                        document.getElementById('text').checked = false
                        document.getElementById('gambarT').checked = true
                        bukagambar()
                        $('#showGambarPembahasan').html('<img src="{{ asset('/') }}upload/soal/img/' + data
                            .data
                            .pembahasan_gambar +
                            '" width="120px">')
                        $('#hpsGmbr1').show();
                    }


                    if (data.data.gambar == null) {
                        $('#showGambar').html(
                            '<img src="{{ asset('/') }}upload/noimage/noimage.jpg" width="120px">')
                    } else {
                        $('#showGambar').html('<img src="{{ asset('/') }}upload/soal/img/' + data.data
                            .gambar +
                            '" width="120px">')

                        $('#hpsGmbr').show();
                    }
                }
            })
        }

        function tampilfoto() {
            var fileInput = document.getElementById('gambar');
            var filePath = fileInput.value;
            var extensions = /(\.jpg|\.png)$/i;
            var ukuran = fileInput.files[0].size;
            if (ukuran > 1000000) {
                alert('ukuran terlalu besar. Maksimal 1000KB')
                fileInput.value = '';
                return false;
            } else {
                if (!extensions.exec(filePath)) {
                    alert('Silakan unggah file yang memiliki ekstensi .jpg/.png.');
                    fileInput.value = '';
                    return false;
                } else {
                    //Image preview
                    if (fileInput.files && fileInput.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('showGambar').innerHTML = '<img src="' + e.target.result +
                                '" width="120px"/>';
                        };
                        reader.readAsDataURL(fileInput.files[0]);
                    }
                }
            }
        }
    </script>
</x-template>
