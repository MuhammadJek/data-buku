<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    protected $excel;
    public function __construct($excel)
    {
        $this->excel = $excel;
    }

    public function collection()
    {
        return collect($this->excel);
    }

    public function headings(): array
    {
        // Asumsikan kunci dari elemen pertama array sebagai header
        return [
            'JUDUL BUKU',
            'PENULIS',
            'DESCRIPSI',
            'PENERBIT',
            'CATEGORY',
            'JUMLAH BUKU',
            'HARGA',
        ];
    }
}
