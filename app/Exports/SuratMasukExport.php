<?php

namespace App\Exports;

use App\Models\SuratMasuk;
use App\Models\JenisSurat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SuratMasukExport implements FromCollection, WithHeadings
{
    public function __construct($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    private $columns = ['no_surat', 'jenis_surat_id', 'perihal', 'pengirim', 'tanggal_surat', 'tanggal_terima'];

    private $headers = ['No. Surat', 'Jenis Surat', 'Perihal', 'Pengirim', 'Tanggal Surat', 'Tanggal Terima'];

    public function collection()
    {
        $surat = SuratMasuk::whereBetween('tanggal_surat', [$this->min, $this->max])->get($this->columns);
        $jenis = JenisSurat::all();
        foreach ($surat as $item) {
            $item['jenis_surat_id'] = $item->jenis_surat->nama_jenis;
            $item['tanggal_surat'] = date('d-m-Y', strtotime($item['tanggal_surat']));
            $item['tanggal_terima'] = date('d-m-Y', strtotime($item['tanggal_terima']));
        }

        return $surat;
    }

    public function headings(): array
    {
        return $this->headers;
    }
}
