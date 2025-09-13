<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; font-family: Arial, sans-serif; margin: 0; background-color: #f0f0f0; }
        .sidebar { width: 200px; background-color: #fff; padding: 20px; box-shadow: 2px 0 5px rgba(0,0,0,0.1); }
        .main-content { flex-grow: 1; padding: 20px; }
        .about-container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 20px;
        }
        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .about-content { display: flex; align-items: center; }
        .about-text p { margin: 0; }
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
        <div class="about-container">
            <h2>About</h2>
            <div class="about-content">
                <div class="profile-picture">
                    <img src="{{ asset('img/image.png') }}" class="img-fluid" alt="Foto Profil">
                </div>
                <div class="about-text">
                    <p>Aplikasi ini dibuat oleh:</p>
                    <p><strong>Nama:</strong> Muhamad Aditya Ramadani</p>
                    <p><strong>Prodi:</strong> D3-MI PSDKU Kediri</p>
                    <p><strong>NIM:</strong> 2331730121</p>
                    <p><strong>Tanggal:</strong> 13 September 2025</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
