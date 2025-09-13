<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; font-family: Arial, sans-serif; margin: 0; background-color: #f0f0f0; }
        .sidebar { width: 200px; background-color: #fff; padding: 20px; box-shadow: 2px 0 5px rgba(0,0,0,0.1); }
        .main-content { flex-grow: 1; padding: 20px; }
        .table-container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .search-bar { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
        .action-buttons { display: flex; gap: 5px; }
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
            <h2>Kategori Surat</h2>
            <p>Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat. Klik "Tambah" pada kolom aksi untuk menambahkan kategori baru.</p>

            <form action="{{ route('kategori.index') }}" method="GET" class="search-bar">
                <label for="search-input">Cari kategori:</label>
                <input type="text" name="keyword" id="search-input" class="form-control" placeholder="🔍 search" value="{{ request('keyword') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>

            @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 10%;">ID Kategori</th>
                        <th style="width: 25%;">Nama Kategori</th>
                        <th style="width: 45%;">Keterangan</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategoris as $kategori)
                    <tr>
                        <td class="text-center">{{ $kategori->id }}</td>
                        <td>{{ $kategori->nama_kategori }}</td>
                        <td>{{ $kategori->keterangan }}</td>
                        <td class="action-buttons">
                            <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                            <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-info btn-sm">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data kategori.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <a href="{{ route('kategori.create') }}" class="btn btn-primary mt-3">[+] Tambah Kategori Baru...</a>
        </div>
    </div>
</body>
</html>
