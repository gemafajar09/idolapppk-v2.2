<x-template title="Materi Soal">
    <div class="row">
        <div class="col-md-12">
            <x-element.card title="Data Materi Soal">
                <x-slot name="button">
                    <x-element.button name="" class="primary text-white" type="button" onclick="tampil()">
                        <x-slot name="span">
                            <i class="far fa-plus"></i>
                            Tambah Data
                        </x-slot>
                    </x-element.button>
                </x-slot>
                <x-element.table :header="['No','Nama Kategori','Nama Materi','Deskripsi Materi','Jumlah File','Aksi']">
                    @foreach ($materi as $i => $a)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $a->kategorimateri->nama_kategori ?? "" }}</td>
                            <td>{{ $a->materi }}</td>
                            <td>{{ $a->deskripsi_materi }}</td>
                            <td>{{ $a->total }}</td>
                            <td width="25%" class="text-center">
                                <x-element.button class="primary text-white btn-sm"
                                    onclick="tambah('{{ $a->materi }}','{{ $a->deskripsi_materi }}','{{ $a->id_kategori_materi }}')" name="Tambah" type="button">
                                </x-element.button>
                                <a href="{{ route('materi-detail', [$id_paket, $a->slug]) }}"
                                    class="btn btn-info text-white btn-sm">Detail</a>
                                <x-element.button class="warning text-white btn-sm"
                                    onclick="edits('{{ $a->materi }}','{{ $a->id_kategori_materi }}')" name="Edit" type="button"></x-element.button>
                                <x-element.button class="danger text-white btn-sm" onclick="hapus('{{ $a->slug }}')"
                                    name="Delete" type="button"></x-element.button>
                            </td>
                        </tr>
                    @endforeach
                </x-element.table>
            </x-element.card>
        </div>
    </div>

    {{-- tambah --}}
    <x-element.modal id="tambahMateri" action="{{ route('materi-add') }}">
        <x-slot name="title">
            Tambah Data
        </x-slot>
        <input type="hidden" name="id_paket" value="{{ $id_paket }}">
        <x-element.select judul="Nama Materi" name="id_kategori_materi">
            @foreach ($kategori as $item)
                <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
            @endforeach
        </x-element.select>
        <x-element.input judul="Materi" name="materi" value="" type="text" place="Input Materi"></x-element.input>
        <x-element.input judul="Deskripsi Materi" name="deskripsi_materi" value="" type="text" place="Input Deskripsi Materi"></x-element.input>
        {{-- radio --}}
        <x-element.radio judul="Type Inputan Soal" :array="['1-Input PDF','2-Upload Vidio']">
        </x-element.radio>

        <div id="pdf" style="display:none">
            <div class="form-group">
                <label for="">File Materi</label>
                <input type="file" name="file[]" class="form-control" multiple>
            </div>
        </div>
        <div id="vidio" style="display:none">
            <x-element.input judul="Link Vidio" name="file" value="" type="text" place="Input Link"></x-element.input>
        </div>
    </x-element.modal>

    {{-- edit --}}
    <x-element.modal id="editMateri" action="{{ route('materi-update') }}">
        <x-slot name="title">
            Edit Data
        </x-slot>
        <x-element.input judul="" name="id_e" value="" type="hidden" place=""></x-element.input>
        <x-element.input judul="Materi" name="materi_e" value="" type="text" place="Input Materi"></x-element.input>
        <x-element.input judul="File Materi" name="file" value="" type="file" place="Input File"></x-element.input>
        <div id="files" style="display:none">
            <span style="color:red"><i id="file_old"></i></span>
            <x-element.input judul="" name="file_e" value="" type="hidden" place=""></x-element.input>
        </div>
    </x-element.modal>

    {{-- edit materi --}}
    <div class="modal" id="materiName">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Materi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('materi-update-name') }}" method="post">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <x-element.select judul="Nama Materi" name="id_kategori_materi_edit">
                            @foreach ($kategori as $item)
                                <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                            @endforeach
                        </x-element.select>
                        <div class="form-group">
                            <label for="">Nama Materi</label>
                            <input type="hidden" name="materi_asli" id="materi_asli">
                            <input type="text" name="materi" id="materi_lama" class="form-control">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function tampil() {
            $('#tambahMateri').modal('show')
            $('#files').hide()
            $("#materi").prop("readonly", false);
            $('#materi').val('')
        }

        function tambah(materi,deskripsi_materi,id_kategori_materi) {
            $('#tambahMateri').modal('show')
            $('#files').hide()
            $("#materi").prop("readonly", true);
            $('#materi').val(materi)
            $("#deskripsi_materi").prop("readonly", true);
            $('#deskripsi_materi').val(deskripsi_materi)
            $("#id_kategori_materi").hide()
            $('#id_kategori_materi').val(id_kategori_materi)
        }

        $("input[type='radio']").click(function() {
            var radioValue = $("input[name='type']:checked").val();
            if (radioValue == 1) {
                $('#pdf').show();
                $('#vidio').hide();
            } else if (radioValue == 2) {
                $('#pdf').hide();
                $('#vidio').show();
            }
        });

        function edits(materi,id_kategori_materi) {
            $('#materi_lama').val(materi)
            $('#materi_asli').val(materi)
            $('#id_kategori_materi_edit').val(id_kategori_materi)
            $('#materiName').modal('show')
        }

        function hapus(materi) {
            Swal.fire({
                title: 'Yakin Ingin Menghapus Data?',
                showDenyButton: true,
                confirmButtonText: '<a style="color:white" href="../materi-hapus-all/' + materi + '">Hapus</a>',
                denyButtonText: `Batal Hapus`,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Berhasil Menghapus Data!', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Batal Menghapus Data', '', 'info')
                }
            })
        }
    </script>
</x-template>
