<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; font-family: Arial, sans-serif; margin: 0; background-color: #f0f0f0; }
        .sidebar { width: 200px; background-color: #fff; padding: 20px; box-shadow: 2px 0 5px rgba(0,0,0,0.1); }
        .main-content { flex-grow: 1; padding: 20px; }
        .table-container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .search-bar { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Menu</h3>
        <ul class="list-unstyled">
            <li><a href="{{ route('arsip.index') }}">⭐ Arsip</a></li>
            <li><a href="{{ route('kategori.index') }}"># Kategori Surat</a></li>
            <li><a href="{{ route('about') }}">ⓘ About</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="table-container">
            <h2>Arsip Surat</h2>
            <p>Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.</p>
            <p>Klik "Lihat" pada kolom aksi untuk menampilkan surat.</p>

            @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger mt-3">{{ session('error') }}</div>
            @endif

            <form action="{{ route('arsip.index') }}" method="GET" class="search-bar">
                <label for="search-input">Cari surat:</label>
                <input type="text" name="keyword" id="search-input" class="form-control" placeholder="🔍 search" value="{{ request('keyword') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nomor Surat</th>
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>Waktu Pengarsipan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($surats as $surat)
                    <tr>
                        <td>{{ $surat->nomor_surat }}</td>
                        <td>{{ $surat->kategori->nama_kategori }}</td>
                        <td>{{ $surat->judul }}</td>
                        <td>{{ $surat->waktu_pengarsipan }}</td>
                        <td>
                            <form action="{{ route('arsip.destroy', $surat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat ini?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                            <a href="{{ route('arsip.download', $surat->id) }}" class="btn btn-warning btn-sm">Unduh</a>
                            <a href="{{ route('arsip.view', $surat->id) }}" class="btn btn-info btn-sm">Lihat >></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('arsip.create') }}" class="btn btn-success mt-3">Arsipkan Surat..</a>
        </div>
    </div>
</body>
</html>
