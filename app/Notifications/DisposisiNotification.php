<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DisposisiNotification extends Notification
{
    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function __construct($data, $file_surat, $file_disposisi, $no_surat)
    {
        $this->data = $data;
        $this->file_surat = $file_surat; // Inisialisasi properti file_surat
        $this->no_surat = $no_surat; // Inisialisasi properti file_surat
        $this->file_disposisi = $file_disposisi; // Inisialisasi properti file_disposisi
    }

    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject('Notifikasi Disposisi Surat')
            ->line('Anda mendapatkan e-mail ini karena terdaftar sebagai pengolah disposisi surat masuk ini pada aplikasi Sintaks.')
            ->line('Silakan untuk menindaklanjuti disposisi surat masuk sesuai intruksi.')
            ->line('Hardfile disposisi dan surat masuk terkait akan segera diserahkan kepada Anda.')
            ->attach($this->file_surat, [
                'as' => $this->no_surat, // Nama file yang akan ditampilkan di lampiran email
                'mime' => 'application/pdf', // Tipe file surat
            ])
            ->attach($this->file_disposisi, [
                'as' => 'disposisi_' . $this->no_surat, // Nama file yang akan ditampilkan di lampiran email
                'mime' => 'application/pdf', // Tipe file surat
            ]);
    }
}
