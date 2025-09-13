<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; font-family: Arial, sans-serif; margin: 0; background-color: #f0f0f0; }
        .sidebar { width: 200px; background-color: #fff; padding: 20px; box-shadow: 2px 0 5px rgba(0,0,0,0.1); }
        .main-content { flex-grow: 1; padding: 20px; }
        .view-container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .pdf-viewer { width: 100%; height: 600px; border: 1px solid #ccc; }
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
        <div class="view-container">
            <h2>Lihat Surat</h2>
            <p><strong>Nomor Surat:</strong> {{ $surat->nomor_surat }}</p>
            <p><strong>Kategori:</strong> {{ $surat->kategori->nama_kategori }}</p>
            <p><strong>Judul:</strong> {{ $surat->judul }}</p>
            <p><strong>Waktu Pengarsipan:</strong> {{ $surat->waktu_pengarsipan }}</p>
            <iframe src="{{ Storage::url($surat->file_path) }}" class="pdf-viewer"></iframe>
            <a href="{{ route('arsip.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            <a href="{{ route('arsip.download', $surat->id) }}" class="btn btn-warning mt-3">Unduh</a>
        </div>
    </div>
</body>
</html>
