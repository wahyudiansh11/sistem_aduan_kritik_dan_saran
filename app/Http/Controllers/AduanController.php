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
        $data = $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'wa' => 'required|string|max:30',
            'darurat' => 'required|boolean',
            'kategori' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'maps_link' => 'nullable|url',
            'isi_aduan' => 'required|string',
            'lampiran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // khusus darurat
            'ambulans_id' => 'nullable|string',
            'no_ambulans' => 'nullable|string|max:30',
        ]);

        $data['darurat'] = $request->boolean('darurat');

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
            'fasilitas' => 'Fasilitas',
            'tenaga kerja' => 'Tenaga Kerja',
            'kelengkapan obat' => 'Kelengkapan Obat',
            'pelayanan kesehatan' => 'Pelayanan Kesehatan',

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

        // FILTER kategori
        if ($request->filled('kategori')) {
            $q->where('kategori', $request->kategori);
        }

        // FILTER status
        if ($request->filled('status')) {
            $q->where('status', $request->status);
        }

        // FILTER darurat
        // penting: request('darurat') bisa "0" atau "1"
        if ($request->has('darurat') && $request->darurat !== '') {
            $q->where('darurat', (int) $request->darurat);
        }

        // SEARCH
        if ($request->filled('q')) {
            $keyword = trim($request->q);

            $q->where(function ($w) use ($keyword) {
                $w->where('kode_tiket', 'like', "%{$keyword}%")
                  ->orWhere('nama_pelapor', 'like', "%{$keyword}%")
                  ->orWhere('wa', 'like', "%{$keyword}%")
                  ->orWhere('lokasi', 'like', "%{$keyword}%")
                  ->orWhere('isi_aduan', 'like', "%{$keyword}%")
                  ->orWhere('feedback_admin', 'like', "%{$keyword}%");
            });
        }

        $aduans = $q->paginate(10)->withQueryString();

        return view('admin.aduan.index', compact('aduans', 'kategoriList', 'statusList'));
    }

    // simpan status + feedback_admin
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
