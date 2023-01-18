<?php

namespace App\Exports;

use App\Models\SuratMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SuratMasukExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $columns = ['no_surat','jenis_surat','perihal','pengirim','tanggal_surat'];

    public function collection()
    {
        return SuratMasuk::all($this->columns);
    }

    public function headings(): array
    {
        return $this->columns;;
    }
}
