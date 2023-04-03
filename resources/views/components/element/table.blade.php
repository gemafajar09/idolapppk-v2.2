<!-- Table with stripped rows -->
<div class="table-responsive">
    <table class="table datatable">
        <thead>
            <tr>
                @foreach ($header as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
<!-- End Table with stripped rows -->
