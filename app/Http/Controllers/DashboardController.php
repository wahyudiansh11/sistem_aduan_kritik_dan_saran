<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // =========================
        // FILTER RANGE GRAFIK (default 7 hari)
        // =========================
        $days = (int) $request->get('days', 7);
        if (!in_array($days, [7, 14, 30])) $days = 7;

        $start = Carbon::now()->subDays($days - 1)->startOfDay();
        $end   = Carbon::now()->endOfDay();

        // =========================
        // KARTU RINGKASAN
        // =========================
        $totalAduan = Aduan::count();
        $baru       = Aduan::where('status', 'baru')->count();
        $diproses   = Aduan::where('status', 'diproses')->count();
        $selesai    = Aduan::where('status', 'selesai')->count();
        $ditolak    = Aduan::where('status', 'ditolak')->count();

        $belumSelesai = $baru + $diproses;

        $darurat = Aduan::where('darurat', 1)->count();
        $normal  = Aduan::where('darurat', 0)->count();

        // =========================
        // DATA TABEL (FILTER STATUS SAJA)
        // =========================
        $q = Aduan::query();

        if ($request->filled('status')) {
            $q->where('status', strtolower($request->status));
        }

        $aduans = $q->latest()->paginate(10)->withQueryString();

        // =========================
        // GRAFIK 1: Aduan per hari (N hari terakhir)
        // =========================
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

        // =========================
        // GRAFIK 2: Status breakdown
        // =========================
        $labelsStatus = ['Baru', 'Diproses', 'Belum Selesai', 'Selesai', 'Ditolak'];
        $dataStatus   = [$baru, $diproses, $belumSelesai, $selesai, $ditolak];

        // =========================
        // GRAFIK 3: Kategori terbanyak (Top 5)
        // =========================
        $kategoriTop = Aduan::selectRaw('kategori, COUNT(*) as total')
            ->whereNotNull('kategori')
            ->where('kategori', '!=', '')
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

    // =========================
    // EXPORT "EXCEL" (CSV)
    // =========================
public function exportExcel(Request $request)
{
    $status = $request->get('status');

    $q = Aduan::query();

    if ($status) {
        $q->where('status', strtolower($status));
    }

    $aduans = $q->latest()->get();

    $darurat = $aduans->where('darurat', 1);
    $normal  = $aduans->where('darurat', 0);

    $fileName = 'Laporan-Resmi-Data-Aduan-' . now()->format('Ymd_His') . '.xls';

    $headers = [
        "Content-Type" => "application/vnd.ms-excel; charset=UTF-8",
        "Content-Disposition" => "attachment; filename=\"$fileName\"",
    ];

    $callback = function () use ($aduans, $darurat, $normal, $status) {

        echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';

        // ===================== KOP SURAT =====================
        echo '<table width="100%">';
        echo '<tr>
                <td colspan="7" style="text-align:center; font-size:20px; font-weight:bold;">
                    DINAS KESEHATAN KABUPATEN SUMENEP
                </td>
              </tr>';
        echo '<tr>
                <td colspan="7" style="text-align:center;">
                    Jl. Jokotole No. 05 Sumenep, Jawa Timur
                </td>
              </tr>';
        echo '<tr>
                <td colspan="7" style="text-align:center;">
                    Telp: (0328) 662122 | Email: dinkessumenep@gmail.com
                </td>
              </tr>';
        echo '<tr>
                <td colspan="7"><hr></td>
              </tr>';
        echo '</table>';

        // ===================== JUDUL =====================
        echo '<table width="100%">';
        echo '<tr>
                <td colspan="7" style="text-align:center; font-size:16px; font-weight:bold; padding:10px;">
                    LAPORAN DATA ADUAN MASYARAKAT (SIADRU)
                </td>
              </tr>';
        echo '<tr>
                <td colspan="7" style="text-align:center;">
                    Tanggal Cetak: '.now()->format('d F Y H:i').'
                </td>
              </tr>';
        echo '<tr>
                <td colspan="7" style="text-align:center; padding-bottom:10px;">
                    Filter Status: '.($status ? strtoupper($status) : 'SEMUA').'
                </td>
              </tr>';
        echo '</table>';

        // ===================== RINGKASAN =====================
        echo '<h3>Ringkasan Statistik</h3>';
        echo '<table border="1" cellpadding="6" cellspacing="0">';
        echo '<tr><td>Total Aduan</td><td>'.$aduans->count().'</td></tr>';
        echo '<tr><td>Total Darurat</td><td>'.$darurat->count().'</td></tr>';
        echo '<tr><td>Total Non Darurat</td><td>'.$normal->count().'</td></tr>';
        echo '</table><br>';

        // ===================== TABEL DARURAT =====================
        echo '<h3 style="color:red;">DATA ADUAN DARURAT</h3>';
        echo '<table border="1" cellpadding="6" cellspacing="0" width="100%">';
        echo '<thead style="background-color:#dc3545; color:white; font-weight:bold;">';
        echo '<tr>
                <th>No</th>
                <th>Kode Tiket</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Lokasi</th>
              </tr>';
        echo '</thead><tbody>';

        $no = 1;
        foreach ($darurat as $a) {
            echo '<tr>';
            echo '<td>'.$no++.'</td>';
            echo '<td>'.$a->kode_tiket.'</td>';
            echo '<td>'.optional($a->created_at)->format('d/m/Y H:i').'</td>';
            echo '<td>'.ucwords($a->kategori ?? '-').'</td>';
            echo '<td>'.strtoupper($a->status ?? '-').'</td>';
            echo '<td>'.$a->lokasi.'</td>';
            echo '</tr>';
        }

        if ($darurat->count() == 0) {
            echo '<tr><td colspan="6" style="text-align:center;">Tidak ada data darurat</td></tr>';
        }

        echo '</tbody></table><br>';

        // ===================== TABEL NON DARURAT =====================
        echo '<h3 style="color:green;">DATA ADUAN NON DARURAT</h3>';
        echo '<table border="1" cellpadding="6" cellspacing="0" width="100%">';
        echo '<thead style="background-color:#198754; color:white; font-weight:bold;">';
        echo '<tr>
                <th>No</th>
                <th>Kode Tiket</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Lokasi</th>
              </tr>';
        echo '</thead><tbody>';

        $no = 1;
        foreach ($normal as $a) {
            echo '<tr>';
            echo '<td>'.$no++.'</td>';
            echo '<td>'.$a->kode_tiket.'</td>';
            echo '<td>'.optional($a->created_at)->format('d/m/Y H:i').'</td>';
            echo '<td>'.ucwords($a->kategori ?? '-').'</td>';
            echo '<td>'.strtoupper($a->status ?? '-').'</td>';
            echo '<td>'.$a->lokasi.'</td>';
            echo '</tr>';
        }

        if ($normal->count() == 0) {
            echo '<tr><td colspan="6" style="text-align:center;">Tidak ada data non darurat</td></tr>';
        }

        echo '</tbody></table><br>';

        // ===================== TANDA TANGAN =====================
        echo '<br><br>';
        echo '<table width="100%">';
        echo '<tr>
                <td style="width:60%"></td>
                <td style="text-align:center;">
                    Sumenep, '.now()->format('d F Y').'<br><br>
                    Mengetahui,<br>
                    Kepala Dinas Kesehatan<br><br><br><br>
                    (........................................)<br>
                    NIP. ............................
                </td>
              </tr>';
        echo '</table>';
    };

    return response()->stream($callback, 200, $headers);
}
}