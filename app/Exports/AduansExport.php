<?php

namespace App\Exports;

use App\Models\Aduan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AduansExport implements FromCollection, WithHeadings, WithMapping
{
    protected $status;

    public function __construct($status = null)
    {
        $this->status = $status;
    }

    public function collection(): Collection
    {
        $query = Aduan::query();

        if ($this->status) {
            $query->where('status', strtolower($this->status));
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Kode Tiket',
            'Tanggal',
            'Kategori',
            'Tingkat',
            'Status',
            'Lokasi Kejadian',
        ];
    }

    public function map($a): array
    {
        return [
            $a->kode_tiket ?? '-',
            optional($a->created_at)->format('d/m/Y H:i'),
            ucwords($a->kategori ?? '-'),
            $a->darurat ? 'DARURAT' : 'NORMAL',
            strtoupper($a->status ?? '-'),
            $a->lokasi ?? '-',
        ];
    }
}
