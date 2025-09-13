<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsipkan Surat Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; font-family: Arial, sans-serif; margin: 0; background-color: #f0f0f0; }
        .sidebar { width: 200px; background-color: #fff; padding: 20px; box-shadow: 2px 0 5px rgba(0,0,0,0.1); }
        .main-content { flex-grow: 1; padding: 20px; }
        .form-container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
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
        <div class="form-container">
            <h2>Arsipkan Surat</h2>
            <p>Unggah surat yang akan diarsipkan.</p>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nomor_surat" class="form-label">Nomor Surat</label>
                    <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>
                </div>
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori_id" name="kategori_id" required>
                        @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" required>
                </div>
                <div class="mb-3">
                    <label for="file_surat" class="form-label">File Surat (PDF)</label>
                    <input type="file" class="form-control" id="file_surat" name="file_surat" accept=".pdf" required>
                </div>
                <a href="{{ route('arsip.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>
