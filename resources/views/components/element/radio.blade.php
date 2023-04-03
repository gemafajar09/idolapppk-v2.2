<div class="form-group">
    <label for="">{{ $judul }}</label>
    <div class="row mx-auto">
        @foreach ($array as $a)
            @php
                $pecah = explode('-', $a);
            @endphp
            <div class="form-check col-md-3">
                <input class="form-check-input" type="radio" name="type" id="type" value="{{ $pecah[0] }}">
                <label class="form-check-label">
                    {{ $pecah[1] }}
                </label>
            </div>
        @endforeach
    </div>
</div>
<br>
