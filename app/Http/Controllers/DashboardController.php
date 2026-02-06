<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index(Request $request)
{
    // Filter range (opsional) default: 7 hari terakhir
    $days = (int) $request->get('days', 7);
    if (!in_array($days, [7, 14, 30])) $days = 7;

    $start = Carbon::now()->subDays($days - 1)->startOfDay();
    $end   = Carbon::now()->endOfDay();

    // ====== KARTU RINGKASAN ======
    $totalAduan = Aduan::count();
    $baru       = Aduan::where('status', 'baru')->count();
    $diproses   = Aduan::where('status', 'diproses')->count();
    $selesai    = Aduan::where('status', 'selesai')->count();
    $ditolak    = Aduan::where('status', 'ditolak')->count();

    // Belum Selesai = Baru + Diproses
    $belumSelesai = $baru + $diproses;

    $darurat = Aduan::where('darurat', 1)->count();
    $normal  = Aduan::where('darurat', 0)->count();

    // ====== DATA TABEL (untuk tabel bawah) ======
    $aduans = Aduan::latest()->paginate(10);

    // ====== GRAFIK 1: Aduan per hari (N hari terakhir) ======
    $perHariRaw = Aduan::selectRaw('DATE(created_at) as tgl, COUNT(*) as total')
        ->whereBetween('created_at', [$start, $end])
        ->groupBy('tgl')
        ->orderBy('tgl')
        ->get();

    $labelsHari = [];
    $dataHari   = [];
    $map = $perHariRaw->pluck('total', 'tgl')->toArray();

    for ($i = 0; $i < $days; $i++) {
        $d = $start->copy()->addDays($i)->format('Y-m-d');
        $labelsHari[] = Carbon::parse($d)->format('d M');
        $dataHari[]   = (int) ($map[$d] ?? 0);
    }

    // ====== GRAFIK 2: Status breakdown ======
    $labelsStatus = ['Baru', 'Diproses', 'Belum Selesai', 'Selesai', 'Ditolak'];
    $dataStatus   = [$baru, $diproses, $belumSelesai, $selesai, $ditolak];

    // ====== GRAFIK 3: Kategori terbanyak (Top 5) ======
    $kategoriTop = Aduan::selectRaw('kategori, COUNT(*) as total')
        ->groupBy('kategori')
        ->orderByDesc('total')
        ->limit(5)
        ->get();

    $labelsKategori = $kategoriTop->pluck('kategori')->map(fn ($x) => ucwords($x))->toArray();
    $dataKategori   = $kategoriTop->pluck('total')->map(fn ($x) => (int) $x)->toArray();

    return view('dashboard', compact(
        'days',
        'totalAduan','baru','diproses','selesai','ditolak','belumSelesai',
        'darurat','normal',
        'aduans',
        'labelsHari','dataHari',
        'labelsStatus','dataStatus',
        'labelsKategori','dataKategori'
    ));
}
}