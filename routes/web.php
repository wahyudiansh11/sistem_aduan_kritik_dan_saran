<?php

use App\Http\Controllers\AduanController;
use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// PUBLIK
Route::get('/aduan', [AduanController::class, 'create'])->name('aduan.create');
Route::post('/aduan', [AduanController::class, 'store'])->name('aduan.store');

Route::get('/aduan/sukses/{kode}', function (string $kode) {
    return view('aduan.sukses', ['kode' => $kode]);
})->name('aduan.sukses');

Route::get('/cek-aduan', function () {
    return view('aduan.cek');
})->name('aduan.cek.form');

Route::post('/cek-aduan', function (Request $request) {
    $request->validate([
        'kode_tiket' => ['required', 'string'],
    ]);

    $aduan = Aduan::where('kode_tiket', $request->kode_tiket)->first();

    if (! $aduan) {
        return back()->withErrors(['kode_tiket' => 'Kode tiket tidak ditemukan.']);
    }

    return redirect()->route('aduan.show.kode', ['kode' => $aduan->kode_tiket]);
})->name('aduan.cek.submit');

Route::get('/cek-aduan/{kode}', function (string $kode) {
    $aduan = Aduan::where('kode_tiket', $kode)->firstOrFail();
    return view('aduan.show', compact('aduan'));
})->name('aduan.show.kode');

// ADMIN (WAJIB LOGIN)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/aduan', [AduanController::class, 'index'])->name('admin.aduan.index');
    Route::patch('/admin/aduan/{aduan}/status', [AduanController::class, 'updateStatus'])->name('admin.aduan.status');

    Route::get('/dashboard', function () {
        return redirect()->route('admin.aduan.index');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
