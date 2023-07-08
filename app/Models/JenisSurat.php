<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;

class JenisSurat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function surat_masuk()
    {
        return $this->hasMany(SuratMasuk::class);
    }

    public function surat_keluar()
    {
        return $this->hasMany(SuratKeluar::class);
    }

    public $incrementing = false;
}