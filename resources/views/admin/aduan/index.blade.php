<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Admin - Aduan</title>
</head>
<body style="font-family: sans-serif; max-width: 1100px; margin: 40px auto;">

<h2>Admin - Data Aduan</h2>

<p>
    <a href="/aduan">+ Buat Aduan (Publik)</a> |
    <a href="/dashboard">Dashboard</a> |
    <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
</p>

<form id="logout-form" action="/logout" method="POST" style="display:none;">
    @csrf
</form>

@if(session('success'))
    <div style="background:#d1fae5; padding:10px; margin-bottom:10px;">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div style="background:#fee2e2; padding:10px; margin-bottom:10px;">
        {{ $errors->first() }}
    </div>
@endif

<!-- FILTER -->
<form method="GET" action="{{ route('admin.aduan.index') }}" style="padding:10px; background:#f3f4f6; margin-bottom:15px;">
    <label>Kategori:</label>
    <select name="kategori">
        <option value="">Semua</option>
        @foreach($kategoriList as $key => $label)
            <option value="{{ $key }}" {{ request('kategori') == $key ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>

    <label style="margin-left:10px;">Status:</label>
    <select name="status">
        <option value="">Semua</option>
        @foreach($statusList as $key => $label)
            <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>

    <label style="margin-left:10px;">Darurat:</label>
    <select name="darurat">
        <option value="">Semua</option>
        <option value="1" {{ request('darurat') === "1" ? 'selected' : '' }}>Ya</option>
        <option value="0" {{ request('darurat') === "0" ? 'selected' : '' }}>Tidak</option>
    </select>

    <button type="submit" style="margin-left:10px;">Filter</button>
    <a href="{{ route('admin.aduan.index') }}" style="margin-left:10px;">Reset</a>
</form>

<table width="100%" border="1" cellpadding="8" cellspacing="0">
    <thead style="background:#e5e7eb;">
        <tr>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>WA</th>
            <th>Darurat</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Isi Aduan</th>
            <th>Status</th>
            <th>Feedback Admin</th>
            <th>Lampiran</th>
            <th>Ubah Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($aduans as $a)
            <tr>
                <td>{{ $a->created_at->format('d-m-Y H:i') }}</td>
                <td>{{ $a->nama_pelapor }}</td>
                <td>{{ $a->wa ?? '-' }}</td>
                <td>{{ $a->darurat ? 'YA' : 'TIDAK' }}</td>
                <td>{{ $kategoriList[$a->kategori] ?? ucwords($a->kategori) }}</td>
                <td>{{ $a->lokasi ?? '-' }}</td>
                <td style="max-width:260px;">{{ $a->isi_aduan }}</td>
                <td><b>{{ strtoupper($a->status) }}</b></td>

                <td style="max-width:220px;">
                    {{ $a->feedback_admin ? $a->feedback_admin : '-' }}
                </td>

                <td>
                    @if($a->lampiran_path)
                        <a href="{{ asset('storage/'.$a->lampiran_path) }}" target="_blank">Lihat</a>
                    @else
                        -
                    @endif
                </td>

                <td style="min-width:240px;">
               <form method="POST" action="{{ route('admin.aduan.status', $a) }}">
    @csrf
    @method('PATCH')

    <select name="status">
        <option value="baru" {{ $a->status == 'baru' ? 'selected' : '' }}>Baru</option>
        <option value="diproses" {{ $a->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
        <option value="selesai" {{ $a->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
        <option value="ditolak" {{ $a->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
    </select>

    <textarea name="feedback_admin">{{ $a->feedback_admin }}</textarea>

    <button type="submit">Simpan</button>
</form>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="11" style="text-align:center;">Belum ada data.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div style="margin-top:15px;">
    {{ $aduans->links() }}
</div>

</body>
</html>
