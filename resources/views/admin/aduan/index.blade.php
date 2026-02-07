<x-app-layout>
    <style>
        /* Modern Government Theme */
        :root {
            --dinkes-green: #059669;
            --dinkes-dark: #064e3b;
            --surface: #ffffff;
            --background: #f8fafc;
        }

        .admin-content {
            padding: 1.5rem;
            background-color: var(--background);
            min-height: 100vh;
        }

        /* Card Instansi Style */
        .main-card {
            background: var(--surface);
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .card-header-instansi {
            background: #ffffff;
            padding: 1.5rem;
            border-bottom: 2px solid var(--dinkes-green);
        }

        /* Search Section */
        .search-wrapper {
            background: #f1f5f9;
            padding: 1.25rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .form-input-gov {
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 0.5rem 0.75rem;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-input-gov:focus {
            border-color: var(--dinkes-green);
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
            outline: none;
        }

        /* Table Styling */
        .gov-table {
            width: 100%;
            border-collapse: collapse;
        }

        .gov-table th {
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        .gov-table td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: top;
            font-size: 14px;
        }

        /* Status Badge */
        .status-pill {
            display: inline-flex;
            align-items: center;
            padding: 2px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-baru { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .status-proses { background: #fef9c3; color: #854d0e; border: 1px solid #fef08a; }
        .status-selesai { background: #dbeafe; color: #1e40af; border: 1px solid #bfdbfe; }
        .status-ditolak { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

        /* Action Form */
        .update-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px;
        }

        .btn-update {
            background: var(--dinkes-green);
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
            width: 100%;
        }

        .btn-update:hover { background: var(--dinkes-dark); }

        @media (max-width: 768px) {
            .gov-table thead { display: none; }
            .gov-table tr { display: block; border: 1px solid #e2e8f0; margin-bottom: 1rem; border-radius: 8px; background: #fff; }
            .gov-table td { display: block; text-align: right; padding-left: 50%; position: relative; border: none; }
            .gov-table td::before {
                content: attr(data-label);
                position: absolute;
                left: 1rem;
                font-weight: bold;
                color: #64748b;
            }
        }
    </style>

    <div class="admin-content">
        <div class="main-card">
            <div class="card-header-instansi">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h1 class="m-0" style="font-size: 1.25rem; font-weight: 800; color: #1e293b;">
                            DATA LAYANAN PENGADUAN
                        </h1>
                        <p class="m-0 text-muted" style="font-size: 13px;">Dinas Kesehatan Kabupaten Sumenep</p>
                    </div>
                    <div class="text-end d-none d-md-block">
                        <span class="badge bg-dark px-3 py-2">TOTAL DATA: {{ $aduans->total() }}</span>
                    </div>
                </div>
            </div>

            <div class="search-wrapper">
                <form method="GET" action="{{ route('admin.aduan.index') }}">
                    <div class="row g-2">
                        <div class="col-md-5">
                            <input type="text" name="q" value="{{ request('q') }}" class="form-input-gov w-100" placeholder="Cari Kode Tiket, Nama, atau Isi Aduan...">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-input-gov w-100">
                                <option value="">-- Semua Status --</option>
                                @foreach($statusList as $key => $label)
                                    <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <button type="submit" class="btn-update" style="height: 38px;">🔍 Cari & Filter</button>
                            <a href="{{ route('admin.aduan.index') }}" class="btn btn-outline-secondary btn-sm d-flex align-items-center px-3" style="border-radius: 4px;">Reset</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="gov-table">
                    <thead>
                        <tr>
                            <th>Identitas & Tiket</th>
                            <th>Detail Laporan</th>
                            <th>Status</th>
                            <th>Tindakan Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aduans as $a)
                        <tr>
                            <td data-label="Identitas">
                                <div style="font-weight: 700; color: #1e293b;">{{ $a->nama_pelapor }}</div>
                                <div style="font-size: 12px; color: #64748b; margin-top: 4px;">
                                    ID: <span style="font-family: monospace; font-weight: bold; color: var(--dinkes-green);">{{ $a->kode_tiket }}</span><br>
                                    WA: {{ $a->wa }}<br>
                                    Tgl: {{ $a->created_at->format('d/m/Y H:i') }}
                                </div>
                            </td>
                            <td data-label="Laporan">
                                <div class="mb-2">
                                    <span style="font-size: 11px; font-weight: bold; color: #475569; background: #e2e8f0; padding: 2px 6px; border-radius: 3px;">
                                        {{ $kategoriList[$a->kategori] ?? $a->kategori }}
                                    </span>
                                    @if($a->darurat)
                                        <span class="ms-1" style="color: #dc2626; font-size: 11px; font-weight: 800;">⚠️ PRIORITAS</span>
                                    @endif
                                </div>
                                <div style="color: #334155; line-height: 1.5;">{{ Str::limit($a->isi_aduan, 150) }}</div>
                                @if($a->lampiran_path)
                                    <a href="{{ asset('storage/'.$a->lampiran_path) }}" target="_blank" style="font-size: 12px; color: var(--dinkes-green); text-decoration: none; font-weight: 600; display: inline-block; margin-top: 8px;">📁 Lihat Lampiran</a>
                                @endif
                            </td>
                            <td data-label="Status">
                                @php
                                    $sClass = match($a->status){
                                        'selesai' => 'status-selesai',
                                        'diproses' => 'status-proses',
                                        'ditolak' => 'status-ditolak',
                                        default => 'status-baru'
                                    };
                                @endphp
                                <span class="status-pill {{ $sClass }}">{{ $a->status }}</span>
                            </td>
                            <td data-label="Tindakan">
                                <form action="{{ route('admin.aduan.status', $a) }}" method="POST" class="update-box">
                                    @csrf @method('PATCH')
                                    <select name="status" class="form-input-gov w-100 mb-2" style="font-size: 12px;">
                                        <option value="baru" {{ $a->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                        <option value="diproses" {{ $a->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="selesai" {{ $a->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="ditolak" {{ $a->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    <textarea name="feedback_admin" class="form-input-gov w-100 mb-2" rows="2" placeholder="Tanggapan resmi..." style="font-size: 12px;">{{ $a->feedback_admin }}</textarea>
                                    <button type="submit" class="btn-update">Update Status</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 3rem; color: #94a3b8;">Tidak ada data pengaduan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="padding: 1.5rem; border-top: 1px solid #e2e8f0; background: #fff;">
                {{ $aduans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>