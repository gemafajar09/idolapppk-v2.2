<?php

namespace App\Imports;

use App\Models\Soal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class SoalTryout implements ToModel, WithStartRow, WithCustomCsvSettings
{
    protected $waktu, $id_paket;

    public function __construct($waktu = null, $id_paket = null)
    {
        $this->waktu = $waktu;
        $this->id_paket = $id_paket;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function model(array $row)
    {
        return new Soal([
            'id_tryout' => $this->id_paket,
            'waktu' => $this->waktu,
            'no_soal' => $row[0],
            'soal' => $row[1],
            'a' => $row[2],
            'b' => $row[3],
            'c' => $row[4],
            'd' => $row[5],
            'e' => $row[6],
            'jawaban_a' => $row[7],
            'jawaban_b' => $row[8],
            'jawaban_c' => $row[9],
            'jawaban_d' => $row[10],
            'jawaban_e' => $row[11],
            'pembahasan' => $row[12],
            'jawaban_terbaik' => $row[13],
            'level' => $row[14],
            'deskripsi' => $row[15],
            'indikator' => $row[16],
            'kategori' => $row[17],
        ]);
    }
}
