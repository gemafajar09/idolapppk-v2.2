<x-template title="Paket">
    <div class="row">
        <div class="col-md-12">
            <x-element.card title="Data Paket">
                <x-slot name="button">
                    <x-element.button name="" class="primary text-white" type="button" onclick="tampil()">
                        <x-slot name="span">
                            <i class="far fa-plus"></i>
                            Tambah Data
                        </x-slot>
                    </x-element.button>
                </x-slot>
                <x-element.table :header="['No','Kategori','Tipe Paket','Nama Paket','Harga Diskon','Harga Normal','Masa Aktif','Deskripsi','Aksi']">
                    @foreach ($data as $i => $a)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $a->kategori->nama ?? "" }}</td>
                            <td>{{ $a->tipe_paket }}</td>
                            <td>{{ $a->nama_paket }}</td>
                            <td>{{ number_format($a->harga_paket) }}</td>
                            <td>{{ number_format($a->harga_coret) }}</td>
                            <td>{{ $a->masa_aktif }} Bulan</td>
                            <td>{!! $a->deskripsi_paket !!}</td>
                            <td width="20%" class="text-center">
                                <a href="{{ route('materi', $a->id) }}" class="btn btn-info text-white btn-sm">Materi
                                </a>
                                <x-element.button class="warning text-white btn-sm"
                                    onclick="edits('{{ $a->id }}')" name="Edit" type="button">
                                </x-element.button>
                                <x-element.button class="danger text-white btn-sm" onclick="hapus('{{ $a->id }}')"
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
    <x-element.modal id="tambahPaket" action="{{ route('paket-add') }}">
        <x-slot name="title">
            Tambah Data
        </x-slot>
        <x-element.select judul="Kategori Paket" name="id_kategori_paket">
            <option value="">Pilih Paket</option>
            @foreach ($kategori as $item)
                <option value="{{$item->id}}">{{$item->nama}}</option>
            @endforeach
        </x-element.select>
        <x-element.select judul="Tipe Paket" name="tipe_paket">
            <option value="Umum">Umum</option>
            <option value="Bidang">Bidang</option>
        </x-element.select>
        <x-element.input judul="Nama Paket" name="nama_paket" value="" type="text" place="Nama Paket"></x-element.input>
        <x-element.input judul="Harga Diskon" name="harga_paket" value="" type="number" place="Rp.xxxx"></x-element.input>
        <x-element.input judul="Harga Coret" name="harga_coret" value="" type="number" place="Rp.xxxx"></x-element.input>
        <x-element.input judul="Masa Aktif" name="masa_aktif" value="" type="number" place="Contoh: 1 Bulan"></x-element.input>
        <x-element.textarea name="deskripsi_paket" judul="Deskripsi" id="deskripsi_paket"></x-element.textarea>
    </x-element.modal>

    {{-- edit --}}
    <x-element.modal id="editPaket" action="{{ route('paket-update') }}">
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
    </x-element.modal>

    <script>
        function tampil() {
            $('#tambahPaket').modal('show')
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
                confirmButtonText: '<a style="color:white" href="paket-hapus/' + id + '">Hapus</a>',
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
