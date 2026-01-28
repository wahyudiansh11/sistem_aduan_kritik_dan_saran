<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">

            {{-- Header --}}
            <div class="rounded-2xl bg-white shadow-sm border border-gray-100 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <div class="text-sm text-gray-500">Dinas Kesehatan Kabupaten Sumenep</div>
                        <h1 class="text-2xl font-bold text-gray-900">Dashboard Sistem Aduan, Kritik & Saran</h1>
                        <p class="text-sm text-gray-600 mt-1">Ringkasan laporan masyarakat dan progres tindak lanjut</p>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('admin.aduan.index') }}"
                           class="px-4 py-2 rounded-lg bg-teal-600 text-white text-sm font-semibold hover:bg-teal-700">
                            Kelola Aduan
                        </a>
                        <a href="{{ route('aduan.create') }}"
                           class="px-4 py-2 rounded-lg border border-gray-200 text-sm font-semibold text-gray-700 hover:bg-gray-100">
                            Form Publik
                        </a>
                    </div>
                </div>
            </div>

            {{-- Cards status --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="rounded-2xl bg-white shadow-sm border border-gray-100 p-5">
                    <div class="text-sm text-gray-500">Total Aduan</div>
                    <div class="text-3xl font-bold text-gray-900 mt-1">{{ $total }}</div>
                    <div class="text-xs text-gray-500 mt-2">Semua data laporan masuk</div>
                </div>

                <div class="rounded-2xl bg-white shadow-sm border border-gray-100 p-5">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-500">Diajukan</div>
                        <span class="text-xs font-semibold px-2 py-1 rounded-full bg-yellow-100 text-yellow-800">Baru</span>
                    </div>
                    <div class="text-3xl font-bold text-gray-900 mt-1">{{ $diajukan }}</div>
                </div>

                <div class="rounded-2xl bg-white shadow-sm border border-gray-100 p-5">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-500">Diproses</div>
                        <span class="text-xs font-semibold px-2 py-1 rounded-full bg-blue-100 text-blue-800">Proses</span>
                    </div>
                    <div class="text-3xl font-bold text-gray-900 mt-1">{{ $diproses }}</div>
                </div>

                <div class="rounded-2xl bg-white shadow-sm border border-gray-100 p-5">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-500">Selesai</div>
                        <span class="text-xs font-semibold px-2 py-1 rounded-full bg-green-100 text-green-800">Selesai</span>
                    </div>
                    <div class="text-3xl font-bold text-gray-900 mt-1">{{ $selesai }}</div>
                </div>

                <div class="rounded-2xl bg-white shadow-sm border border-gray-100 p-5">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-500">Ditolak</div>
                        <span class="text-xs font-semibold px-2 py-1 rounded-full bg-red-100 text-red-800">Ditolak</span>
                    </div>
                    <div class="text-3xl font-bold text-gray-900 mt-1">{{ $ditolak }}</div>
                </div>
            </div>

            @php
                $labels = [
                    'pelayanan' => 'Pelayanan',
                    'fasilitas' => 'Fasilitas',
                    'tenaga_kerja' => 'Tenaga Kerja',
                    'kelengkapan_obat' => 'Kelengkapan Obat',
                    'emergency' => 'Emergency',
                    'non_emergency' => 'Non Emergency',
                ];

                $countOf = fn($key) => (int) ($perKategori[$key] ?? 0);
                $safeTotal = max((int)$total, 1);
            @endphp

            {{-- Grid bawah --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

                {{-- Rekap kategori --}}
                <div class="lg:col-span-2 rounded-2xl bg-white shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Rekap Aduan per Kategori</h2>
                        <div class="text-sm text-gray-500">Total: <span class="font-semibold text-gray-700">{{ $total }}</span></div>
                    </div>

                    <div class="space-y-3">
                        @foreach($labels as $key => $label)
                            @php
                                $c = $countOf($key);
                                $pct = (int) round(($c / $safeTotal) * 100);
                            @endphp
                            <div class="rounded-xl border border-gray-100 p-4">
                                <div class="flex items-center justify-between">
                                    <div class="font-medium text-gray-900">{{ $label }}</div>
                                    <div class="text-sm text-gray-600">
                                        <span class="font-semibold text-gray-900">{{ $c }}</span>
                                        <span class="text-gray-400">({{ $pct }}%)</span>
                                    </div>
                                </div>
                                <div class="mt-3 h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-2 bg-teal-500" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Panel catatan --}}
                <div class="rounded-2xl bg-white shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-semibold text-gray-900">Panduan Singkat</h2>
                    <p class="text-sm text-gray-600 mt-2">
                        Gunakan menu <span class="font-semibold">Aduan</span> untuk melihat detail laporan,
                        mengubah status, dan memberikan tanggapan admin.
                    </p>

                    <div class="mt-4 rounded-xl bg-gray-50 border border-gray-100 p-4">
                        <div class="text-sm font-semibold text-gray-900 mb-2">Alur kerja admin</div>
                        <ol class="list-decimal ml-5 text-sm text-gray-700 space-y-1">
                            <li>Cek laporan baru (diajukan)</li>
                            <li>Ubah status ke diproses saat ditangani</li>
                            <li>Tulis tanggapan admin</li>
                            <li>Set selesai atau ditolak</li>
                        </ol>
                    </div>

                    <div class="mt-4 text-xs text-gray-500">
                        *Dashboard ini bersifat ringkasan.
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
