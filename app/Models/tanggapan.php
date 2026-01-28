<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $fillable = ['aduan_id', 'admin_id', 'pesan'];

    public function aduan()
    {
        return $this->belongsTo(Aduan::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
