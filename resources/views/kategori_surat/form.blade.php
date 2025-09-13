<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Surat >> {{ isset($kategori) ? 'Edit' : 'Tambah' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; font-family: Arial, sans-serif; margin: 0; background-color: #f0f0f0; }
        .sidebar { width: 200px; background-color: #fff; padding: 20px; box-shadow: 2px 0 5px rgba(0,0,0,0.1); }
        .main-content { flex-grow: 1; padding: 20px; }
        .form-container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .form-row { display: flex; align-items: center; margin-bottom: 10px; }
        .form-row label { flex: 0 0 150px; }
        .form-row input, .form-row textarea { flex-grow: 1; }
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
            <h2>Kategori Surat >> {{ isset($kategori) ? 'Edit' : 'Tambah' }}</h2>
            <p>Tambahkan atau edit data kategori. Jika sudah selesai, jangan lupa untuk mengklik tombol "Simpan".</p>

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

            <form action="{{ isset($kategori) ? route('kategori.update', $kategori) : route('kategori.store') }}" method="POST">
                @csrf
                @if(isset($kategori))
                    @method('PUT')
                @endif
                <div class="form-row">
                    <label for="id">ID (Auto Increment)</label>
                    <input type="text" class="form-control" value="{{ $kategori->id ?? 'Otomatis' }}" disabled>
                </div>
                <div class="form-row">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input type="text" class="form-control" name="nama_kategori" value="{{ $kategori->nama_kategori ?? old('nama_kategori') }}" required>
                </div>
                <div class="form-row">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" name="keterangan" rows="5" required>{{ $kategori->keterangan ?? old('keterangan') }}</textarea>
                </div>
                <div class="mt-4">
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">&lt;&lt; Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
