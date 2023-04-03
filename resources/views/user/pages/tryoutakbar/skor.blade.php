@extends('user.layout.app')
@section('title', 'IdolaPPPK - Skor Try Out')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <div class="margin-5 container mx-auto w-full rounded-md p-5 shadow-md">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="#"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg aria-hidden="true" class="mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                            </path>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg aria-hidden="true" class="h-6 w-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white md:ml-2">
                            Peringkat Try Out
                        </a>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="mt-3 text-2xl font-bold">Peringkat peserta</div>
        <div class="mt-3 rounded-md bg-blue-100 p-6 outline-1 outline-blue-100">
            <div class="grid grid-cols-3 gap-3">
                <div class="font-bold text-gray-600">Try out Akbar</div>
                <div class="text-gray-600">:</div>
                <div class="text-gray-600">{{ $tryout->nama_tryout }}</div>
                <div class="font-bold text-gray-600">Jumlah Peserta</div>
                <div class="text-gray-600">:</div>
                <div class="text-gray-600">{{ $tryout->total }}</div>
            </div>
        </div>
        <div class="mt-3 p-2 rounded-md">
            <table id="" class="table table-striped">
                <thead>
                    <tr>
                        <th>Ranking</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($skor as $i => $a)
                    <tr>
                        @if($i+1 == 1)
                        <td>
                            <img src="{{ asset('medal/1.png') }}" alt="" class="h-5">
                        </td>
                        @elseif($i+1 == 2)
                        <td>
                            <img src="{{ asset('medal/2.png') }}" alt="" class="h-5">
                        </td>
                        @elseif($i+1 == 3)
                        <td>
                            <img src="{{ asset('medal/3.png') }}" alt="" class="h-5">
                        </td>
                        @else
                        <td>{{$i+1}}</td>
                        @endif

                        <td>{{$a->nama}}</td>
                        <td>{{$a->skor}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $skor->links() }}
    </div>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#table').DataTable();
        });
    </script>
@endsection
