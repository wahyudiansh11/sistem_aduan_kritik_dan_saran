<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicAduanController extends Controller
{
    public function create()
    {
        return view('aduan.create');
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'jenis'    => 'required|in:aduan,kritik,saran',
            'kategori' => 'required|in:pelayanan,fasilitas,tenaga_kerja,kelengkapan_obat,emergency,non_emergency',
            'nama'     => 'required|string|max:100',
            'kontak'   => 'nullable|string|max:100',
            'isi'      => 'required|string',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($r->hasFile('lampiran')) {
            $data['lampiran'] = $r->file('lampiran')->store('lampiran', 'public');
        }

        do {
            $ticket = 'DKS-' . strtoupper(Str::random(8));
        } while (Aduan::where('ticket_code', $ticket)->exists());

        $data['ticket_code'] = $ticket;

        $aduan = Aduan::create($data);

        return redirect()
            ->route('public.cekStatus', $aduan->ticket_code)
            ->with('success', 'Aduan terkirim. Simpan kode tiket Anda: ' . $aduan->ticket_code);
    }

    public function cekForm()
    {
        return view('aduan.cek');
    }

    public function cekStatus(string $ticket_code)
    {
        $aduan = Aduan::where('ticket_code', $ticket_code)->firstOrFail();
        $aduan->load('tanggapans.admin');

        return view('aduan.show', compact('aduan'));
    }
}
