<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jabatan;

class Pengolah extends Model
{
    use HasFactory;

    protected $fillable = ['fullname', 'email', 'jabatan_id'];

    public function jabatan()
    {
        return $this->belongsTo('App\Models\Jabatan');
    }

    public function routeNotificationFor()
    {
        return $this->email;
    }
}
