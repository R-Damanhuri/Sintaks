<?php

namespace App\Exports;

use App\Models\SuratKeluar;
use App\Models\JenisSurat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SuratKeluarExport implements FromCollection, WithHeadings
{
    public function __construct($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    
    private $columns = ['no_surat', 'jenis_surat_id','perihal','penerima','tanggal_surat'];

    private $headers = ['No. Surat', 'Jenis Surat','Perihal','Penerima','Tanggal Surat'];

    public function collection()
    {
        $surat = SuratKeluar::whereBetween('tanggal_surat', [$this->min, $this->max])->get($this->columns);
        $jenis = JenisSurat::all();
        foreach ($surat as $item) {
            $item['jenis_surat_id'] = $item->jenis_surat->nama_jenis;
            $item['tanggal_surat'] = date('d-m-Y', strtotime($item['tanggal_surat']));
        }
        
        return $surat;
    }

    public function headings(): array
    {
        return $this->headers;;
    }
}