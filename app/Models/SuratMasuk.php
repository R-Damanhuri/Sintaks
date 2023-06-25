<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisSurat;
use App\Models\Disposisi;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function jenis_surat()
    {
        return $this->belongsTo(JenisSurat::class);
    }

    public function disposisi()
    {
        return $this->hasOne(Disposisi::class);
    }
}