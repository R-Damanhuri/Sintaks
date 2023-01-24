<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SuratMasuk;

class Disposisi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function surat_masuk()
    {
        return $this->belongsTo(SuratMasuk::class);
    }
}
