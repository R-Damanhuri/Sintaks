<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SuratMasuk;
use App\Notifications\DisposisiNotification;

class Disposisi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function surat_masuk()
    {
        return $this->belongsTo(SuratMasuk::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification()
    {
        $this->notify(new DisposisiNotification());
    }
}