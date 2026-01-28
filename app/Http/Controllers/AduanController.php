<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AduanController extends Controller
{
    // =========================
    // PUBLIK
    // =========================
    public function create()
    {
        return view('aduan.create');
    }

    public function store(Request $request)
    {
        // daftar kategori sesuai form (samakan PERSIS stringnya)
        $kategoriNormal = ['fasilitas', 'tenaga kerja', 'kelengkapan obat', 'pelayanan kesehatan'];
        $kategoriDarurat = ['kecelakaan', 'butuh ambulans', 'gawat darurat', 'bencana', 'lainnya darurat'];

        $data = $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'wa' => 'nullable|string|max:30',
            'darurat' => 'required|in:0,1',
            'isi_aduan' => 'required|string',
            'kategori' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data['darurat'] = $request->boolean('darurat');

        // validasi kategori sesuai darurat
        if ($data['darurat']) {
            if (!in_array($data['kategori'], $kategoriDarurat, true)) {
                return back()
                    ->withErrors(['kategori' => 'Kategori darurat tidak valid.'])
                    ->withInput();
            }
        } else {
            if (!in_array($data['kategori'], $kategoriNormal, true)) {
                return back()
                    ->withErrors(['kategori' => 'Kategori tidak valid.'])
                    ->withInput();
            }
        }

        // kode tiket unik
        do {
            $kode = 'ADU' . now()->format('ymd') . strtoupper(Str::random(6));
        } while (Aduan::where('kode_tiket', $kode)->exists());

        $data['kode_tiket'] = $kode;

        if ($request->hasFile('lampiran')) {
            $data['lampiran_path'] = $request->file('lampiran')->store('aduan_lampiran', 'public');
        }

        $aduan = Aduan::create($data);

        return redirect()->route('aduan.sukses', ['kode' => $aduan->kode_tiket]);
    }

    // =========================
    // ADMIN (WAJIB LOGIN)
    // =========================
    public function index(Request $request)
    {
        $kategoriList = [
            // normal
            'fasilitas' => 'Fasilitas',
            'tenaga kerja' => 'Tenaga Kerja',
            'kelengkapan obat' => 'Kelengkapan Obat',
            'pelayanan kesehatan' => 'Pelayanan Kesehatan',

            // darurat
            'kecelakaan' => 'Kecelakaan',
            'butuh ambulans' => 'Butuh Ambulans',
            'gawat darurat' => 'Gawat Darurat',
            'bencana' => 'Bencana / Evakuasi',
            'lainnya darurat' => 'Lainnya (Darurat)',
        ];

        $statusList = [
            'baru' => 'Baru',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
        ];

        $q = Aduan::query()->latest();

        if ($request->filled('kategori')) {
            $q->where('kategori', $request->kategori);
        }

        if ($request->filled('status')) {
            $q->where('status', $request->status);
        }

        if ($request->filled('darurat')) {
            $q->where('darurat', (bool) $request->darurat);
        }

        $aduans = $q->paginate(10)->withQueryString();

        return view('admin.aduan.index', compact('aduans', 'kategoriList', 'statusList'));
    }

    // simpan status + feedback_admin dalam 1 form
    public function updateStatus(Request $request, Aduan $aduan)
    {
        $request->validate([
            'status' => ['required', 'in:baru,diproses,selesai,ditolak'],
            'feedback_admin' => ['nullable', 'string', 'max:2000'],
        ]);

        $aduan->update([
            'status' => $request->status,
            'feedback_admin' => $request->feedback_admin,
        ]);

        return back()->with('success', 'Status & tanggapan berhasil disimpan.');
    }
}
