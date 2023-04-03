<x-template title="Tryout Akbar">
    <div class="row">
        <div class="col-md-12">
            <x-element.card title="Data Tryout Akbar">
                <x-slot name="button">
                    <x-element.button name="" class="primary text-white" type="button" onclick="tampil()">
                        <x-slot name="span">
                            <i class="far fa-plus"></i>
                            Tambah Data
                        </x-slot>
                    </x-element.button>
                </x-slot>
                <x-element.table :header="['No','Nama Tryout','Tanggal Aktif','Tanggal Selesai','Jumlah Soal','Durasi'  ,'Aksi']">
                    @foreach ($tryout as $i => $a)
                    @php
                        $jumlah = DB::table('soals')->where('id_tryout',$a->id_tryout)->count();
                    @endphp
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $a->nama_tryout }}</td>
                            <td>{{ $a->tgl_mulai }}</td>
                            <td>{{ $a->tgl_selesai }}</td>
                            <td>{{$jumlah}}</td>
                            <td>{{ $a->durasi }} Menit</td>
                            <td width="20%" class="text-center">
                                <x-element.button class="info text-white btn-sm" onclick="uploadSoal('{{$a->id_tryout}}','{{$a->durasi}}')" name="Soal" type="button"></x-element.button>
                                <!-- <x-element.button class="warning text-white btn-sm" onclick="edits('{{ $a->id_tryout }}')" name="Edit" type="button">
                                </x-element.button> -->
                                <x-element.button class="danger text-white btn-sm" onclick="hapus('{{ $a->id_tryout }}')"
                                    name="Delete" type="button">
                                </x-element.button>
                            </td>
                        </tr>
                    @endforeach
                </x-element.table>
            </x-element.card>
        </div>
    </div>
    {{-- tambah --}}
    <x-element.modal id="tambahPaket" action="{{ route('tryoutAkbar-simpan') }}">
        <x-slot name="title">
            Tambah Data
        </x-slot>

        <div class="row">
            <div class="col-md-10">
                <x-element.input judul="Nama Tryout" name="nama_tryout" value="" type="text" place="Nama Tryout"></x-element.input>
            </div>
            <div class="col-md-2">
                <x-element.input judul="Durasi" name="durasi" value="" type="number" place=""></x-element.input>
            </div>
            <div class="col-md-3">
                <x-element.input judul="Tanggal Mulai" name="tgl_mulai" value="" type="date" place=""></x-element.input>
            </div>
            <div class="col-md-3">
                <x-element.input judul="Waktu Mulai" name="wkt_mulai" value="" type="time" place=""></x-element.input>
            </div>
            <div class="col-md-3">
                <x-element.input judul="Tanggal Selesai" name="tgl_selesai" value="" type="date" place=""></x-element.input>
            </div>
            <div class="col-md-3">
                <x-element.input judul="Waktu Selesai" name="wkt_selesai" value="" type="time" place=""></x-element.input>
            </div>
        </div>
    </x-element.modal>

    <x-element.modal id="tambahSoal" action="{{ route('tryoutAkbar-upload') }}">
        <x-slot name="title">
            Upload Soal
        </x-slot>
        <input type="hidden" name="id_tryout" id="id_tryout">
        <input type="hidden" name="durasi" id="durasis">
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

    {{-- edit --}}
    {{-- <x-element.modal id="editPaket" action="{{ route('paket-update') }}">
        <x-slot name="title">
            Edit Data
        </x-slot>
        <x-element.input judul="" name="id_e" value="" type="hidden" place=""></x-element.input>
        <x-element.select judul="Kategori Paket" name="id_kategori_paket_e">
            <option value="">Pilih Paket</option>
            @foreach ($kategori as $item)
                <option value="{{$item->id}}">{{$item->nama}}</option>
            @endforeach
        </x-element.select>
        <x-element.select judul="Tipe Paket" name="tipe_paket_e">
            <option value="Umum">Umum</option>
            <option value="Bidang">Bidang</option>
        </x-element.select>
        <x-element.input judul="Nama Paket" name="nama_paket_e" value="" type="text" place="Nama Paket">
        </x-element.input>
        <x-element.input judul="Harga Diskon" name="harga_paket_e" value="" type="number" place="Rp.xxxx"></x-element.input>
        <x-element.input judul="Harga Coret" name="harga_coret_e" value="" type="number" place="Rp.xxxx">
        </x-element.input>
        <x-element.input judul="Masa Aktif" name="masa_aktif_e" value="" type="number" place="Contoh: 1 Bulan">
        </x-element.input>
        <x-element.textarea name="deskripsi_paket_e" judul="Deskripsi"></x-element.textarea>
    </x-element.modal> --}}

    <script>
        function tampil() {
            $('#tambahPaket').modal('show')
        }

        function uploadSoal(id, durasi) {
            $('#id_tryout').val(id)
            $('#durasis').val(durasi)
            $('#tambahSoal').modal('show')
        }

        function edits(id) {
            $.ajax({
                url: "{{ route('paket-get') }}",
                type: "POST",
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(data) {
                    $('#id_e').val(id)
                    $('#nama_paket_e').val(data.nama_paket)
                    $('#harga_paket_e').val(data.harga_paket)
                    $('#harga_coret_e').val(data.harga_coret)
                    $('#masa_aktif_e').val(data.masa_aktif)
                    $('#deskripsi_paket_e').val(data.deskripsi_paket)
                    $('#id_kategori_paket_e').val(data.id_kategori_paket)
                    $('#tipe_paket_e').val(data.tipe_paket)

                    $('#editPaket').modal('show')
                }
            })
        }

        function hapus(id) {
            Swal.fire({
                title: 'Yakin Ingin Menghapus Data?',
                showDenyButton: true,
                confirmButtonText: '<a style="color:white" href="tryoutAkbar-hapus/' + id + '">Hapus</a>',
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
