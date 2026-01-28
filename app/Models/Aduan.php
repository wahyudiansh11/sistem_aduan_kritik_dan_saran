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
  'isi_aduan',
  'kategori',
  'lokasi',
  'status',
  'lampiran_path',
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
