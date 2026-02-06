<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aduan extends Model
{
protected $fillable = [
  'kode_tiket',
  'nama_pelapor',
  'wa',
  'darurat',
  'kategori',
  'lokasi',
  'maps_link',
  'isi_aduan',
  'lampiran_path',
  'status',
  'feedback_admin',
];



    protected $casts = [
        'darurat' => 'boolean',
    ];

    public function tanggapans()
    {
        return $this->hasMany(\App\Models\Tanggapan::class);
    }
}
