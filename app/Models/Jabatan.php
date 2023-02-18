<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengolah;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function pengolah()
    {
        return $this->hasMany('App\Models\Pengolah');
    }
}