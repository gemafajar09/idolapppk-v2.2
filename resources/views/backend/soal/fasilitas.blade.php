<label for="">Soal Fasilitas</label>
<select class="form-control" name="id_fasilitas" id="id_fasilitas`">
    <option value="">-PILIH-</option>
    @foreach ($fasilitas as $a)
        <option value="{{ $a->id }}">{{ $a->nama_fasilitas }}</option>
    @endforeach
</select>
