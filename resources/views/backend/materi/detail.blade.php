<x-template title="Detail Materi">
    <div class="row">
        <div class="col-md-12">
            <x-element.card title="Data Detail Materi">
                <x-slot name="button"></x-slot>
                <x-element.table :header="['No','Materi','Aksi']">
                    @foreach ($materi as $i => $a)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                @if ($a->type == 1)
                                    <a href="{{ route('materi-show', $a->file) }}"
                                        target="_blank">{{ $a->file }}</a>
                                @else
                                    {!! $a->file !!}
                                @endif
                            </td>
                            <td width="20%" class="text-center">
                                <x-element.button class="warning text-white btn-sm"
                                    onclick="edits('{{ $a->id }}','{{ $a->file }}','{{ $a->materi }}','{{ $a->type }}')"
                                    name="Edit" type="button">
                                </x-element.button>
                                <x-element.button class="danger text-white btn-sm" onclick="hapus('{{ $a->id }}')"
                                    name="Delete" type="button"></x-element.button>
                            </td>
                        </tr>
                    @endforeach
                </x-element.table>
            </x-element.card>
        </div>
    </div>

    {{-- edit --}}
    <x-element.modal id="editMateri" action="{{ route('materi-update') }}">
        <x-slot name="title">
            Edit Data
        </x-slot>
        <x-element.input judul="" name="id_e" value="" type="hidden" place=""></x-element.input>
        <x-element.input judul="Materi" name="materi_e" value="" type="text" place="Input Materi"></x-element.input>

        <x-element.radio judul="Type Inputan Soal" :array="['1-Input PDF','2-Upload Vidio']">
        </x-element.radio>

        <div id="pdf" style="display:none">
            <x-element.input judul="File Materi" name="file" value="" type="file" place="Input File">
            </x-element.input>

            <div id="files" style="display:none">
                <span style="color:red"><i id="file_old"></i></span>
            </div>
        </div>
        <div id="vidio" style="display:none">
            <x-element.input judul="Link Vidio" name="file_e" id="file_e" value="" type="text" place="Input Link">
            </x-element.input>
        </div>
    </x-element.modal>

    <script>
        function tampil() {
            $('#tambahMateri').modal('show')
            $('#files').hide()
            $("#materi").prop("readonly", false);
            $('#materi').val('')
        }

        function tambah(materi) {
            $('#tambahMateri').modal('show')
            $('#files').hide()
            $("#materi").prop("readonly", true);
            $('#materi').val(materi)
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

        function edits(id, file, materi, type) {
            $("#materi_e").prop("readonly", true)
            $('#id_e').val(id)
            $('#file_old').html(file)
            $('#materi_e').val(materi)

            $('#editMateri').modal('show')
            $("input[name=type][value=" + type + "]").attr('checked', 'checked');

            if (type == 1) {
                $('#pdf').show();
                $('#vidio').hide();
                $('#files').show()
            } else if (radioValue == 2) {
                $('#pdf').hide();
                $('#vidio').show();
                $('#file_e').val(file)
            }
        }

        function hapus(id) {
            Swal.fire({
                title: 'Yakin Ingin Menghapus Data?',
                showDenyButton: true,
                confirmButtonText: '<a style="color:white" href="../../materi-hapus/' + id + '">Hapus</a>',
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
    </script>
</x-template>
