<?php

namespace App\Exports;

use App\Models\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        return Laporan::filterBy($this->filters)->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Jenis Laporan',
            'Tanggal',
            'Deskripsi',
            // tambahkan kolom lain sesuai kebutuhan
        ];
    }
}