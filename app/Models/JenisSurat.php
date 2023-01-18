<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SuratMasuk;

class JenisSurat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jenis_surat()
    {
        return $this->hasMany(SuratMasuk::class);
    }
}
