<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SuratMasuk;

class JenisSurat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function surat_masuk()
    {
        return $this->hasMany(SuratMasuk::class);
    }

    public $incrementing = false;
}
