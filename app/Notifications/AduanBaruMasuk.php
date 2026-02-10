<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AduanBaruMasuk extends Notification
{
    use Queueable;

    public $aduan;

    public function __construct($aduan)
    {
        $this->aduan = $aduan;
    }

    public function via(object $notifiable): array
    {
        // WAJIB database supaya masuk lonceng
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Aduan baru masuk',
            'message' => 'Tiket: ' . $this->aduan->kode_tiket,
            'aduan_id' => $this->aduan->id,
            'url' => route('admin.aduan.show', $this->aduan->id),
            'priority' => $this->aduan->prioritas ?? null,
        ];
    }
}
