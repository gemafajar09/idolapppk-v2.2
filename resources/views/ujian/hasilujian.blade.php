@extends('ujian.template')
@section('mainclient')
    <style>
        div {
            font-family: 'Roboto Flex',
                sans-serif;
        }

        body {
            background-color: #fff;
        }

    </style>
    {{-- @dd($jawabanbenar) --}}
    <div class="row mx-2" style="margin-bottom:10%">
        {{-- teksin --}}
        @if($id_paket != 14)
        <div class="col-md-6 py-1">
            <div class="card" style="border-radius:15px">
                <div class="card-body">
                    <center>
                        <b style="font-size:20px">{{ $kategori[0] }}</b>
                    </center>
                    <div class="row py-2">
                        <div class="col-md-4">
                            <b style="font-size:16px">Skor : {{ $jawabanbenar->bobot_a }}</b>
                            <hr>
                            <table style="width:100%; font-size:16px">
                                <tr>
                                    <td>Benar</td>
                                    <td>:</td>
                                    <td>{{ $benar }}</td>
                                </tr>
                                <tr>
                                    <td>Salah</td>
                                    <td>:</td>
                                    <td>{{ $salah }}</td>
                                </tr>
                                <tr>
                                    <td>Kosong</td>
                                    <td>:</td>
                                    <td>{{ $kosong }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-8">
                            <canvas id="teknis"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endif
        {{-- manajer --}}
        @php
            $bobot2 = explode(',', $grafik['manajer']);
        @endphp
        <div class="col-md-6 py-1">
            <div class="card" style="border-radius:15px">
                <div class="card-body">
                    <center>
                        <b style="font-size:20px">{{ $kategori[1] }}</b>
                    </center>
                    <div class="row py-2">
                        <div class="col-md-4">
                            <b style="font-size:16px">Skor : {{ $jawabanbenar->bobot_b }}</b>
                            <hr>
                            <table style="width:100%; font-size:16px">
                                <tr>
                                    <td>bobot 1</td>
                                    <td>:</td>
                                    <td>{{ $bobot2[0] }}</td>
                                </tr>
                                <tr>
                                    <td>bobot 2</td>
                                    <td>:</td>
                                    <td>{{ $bobot2[1] }}</td>
                                </tr>
                                <tr>
                                    <td>bobot 3</td>
                                    <td>:</td>
                                    <td>{{ $bobot2[2] }}</td>
                                </tr>
                                <tr>
                                    <td>bobot 4</td>
                                    <td>:</td>
                                    <td>{{ $bobot2[3] }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-8">
                            <canvas id="manajer"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- sosio --}}
        @php
            $bobot3 = explode(',', $grafik['sosio']);
        @endphp
        <div class="col-md-6 py-1">
            <div class="card" style="border-radius:15px">
                <div class="card-body">
                    <center>
                        <b style="font-size:20px">{{ $kategori[2] }}</b>
                    </center>
                    <div class="row py-2">
                        <div class="col-md-4">
                            <b style="font-size:16px">Skor : {{ $jawabanbenar->bobot_c }}</b>
                            <hr>
                            <table style="width:100%; font-size:16px">
                                <tr>
                                    <td>bobot 1</td>
                                    <td>:</td>
                                    <td>{{ $bobot3[0] }}</td>
                                </tr>
                                <tr>
                                    <td>bobot 2</td>
                                    <td>:</td>
                                    <td>{{ $bobot3[1] }}</td>
                                </tr>
                                <tr>
                                    <td>bobot 3</td>
                                    <td>:</td>
                                    <td>{{ $bobot3[2] }}</td>
                                </tr>
                                <tr>
                                    <td>bobot 4</td>
                                    <td>:</td>
                                    <td>{{ $bobot3[3] }}</td>
                                </tr>
                                <tr>
                                    <td>bobot 5</td>
                                    <td>:</td>
                                    <td>{{ $bobot3[4] }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-8">
                            <canvas id="sosio"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- wawancara --}}
        @php
            $bobot4 = explode(',', $grafik['wawancara']);
        @endphp
        <div class="col-md-6 py-1">
            <div class="card" style="border-radius:15px">
                <div class="card-body">
                    <center>
                        <b style="font-size:20px">{{ $kategori[3] }}</b>
                    </center>
                    <div class="row py-2">
                        <div class="col-md-4">
                            <b style="font-size:16px">Skor : {{ $jawabanbenar->bobot_d }}</b>
                            <hr>
                            <table style="width:100%; font-size:16px">
                                <tr>
                                    <td>bobot 1</td>
                                    <td>:</td>
                                    <td>{{ $bobot4[0] }}</td>
                                </tr>
                                <tr>
                                    <td>bobot 2</td>
                                    <td>:</td>
                                    <td>{{ $bobot4[1] }}</td>
                                </tr>
                                <tr>
                                    <td>bobot 3</td>
                                    <td>:</td>
                                    <td>{{ $bobot4[2] }}</td>
                                </tr>
                                <tr>
                                    <td>bobot 4</td>
                                    <td>:</td>
                                    <td>{{ $bobot4[3] }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-8">
                            <canvas id="wawancara"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    
    
@if($id_paket != 14)
    <script>
        // teknis
        const ctx = document.getElementById('teknis').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {

                labels: ['benar', 'salah', 'kosong'],
                datasets: [{
                    data: [{{ $benar }}, {{ $salah }}, {{ $kosong }}],
                    backgroundColor: [
                        '#3f37db',
                        '#e31e66',
                        '#bfbfbf',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
</script>
@endif
<script>
        // manajer
        const ctx0 = document.getElementById('manajer').getContext('2d');
        new Chart(ctx0, {
            type: 'doughnut',
            data: {

                labels: ['Bobot 1', 'Bobot 2', 'Bobot 3', 'Bobot 4'],
                datasets: [{
                    data: [<?= $grafik['manajer'] ?>],
                    backgroundColor: [
                        '#3f37db',
                        '#e31e66',
                        '#37dbb2',
                        '#bfbfbf',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // sosio
        const ctx1 = document.getElementById('sosio').getContext('2d');
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Bobot 1', 'Bobot 2', 'Bobot 3', 'Bobot 4', 'Bobot 5'],
                datasets: [{
                    data: [<?= $grafik['sosio'] ?>],
                    backgroundColor: [
                        '#3f37db',
                        '#e31e66',
                        '#37dbb2',
                        '#dbaf37',
                        '#bfbfbf',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // wawancara
        const ctx12 = document.getElementById('wawancara').getContext('2d');
        new Chart(ctx12, {
            type: 'doughnut',
            data: {
                labels: ['Bobot 1', 'Bobot 2', 'Bobot 3', 'Bobot 4'],
                datasets: [{
                    data: [<?= $grafik['wawancara'] ?>],
                    backgroundColor: [
                        '#3f37db',
                        '#e31e66',
                        '#37dbb2',
                        '#dbaf37',
                        '#bfbfbf',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
