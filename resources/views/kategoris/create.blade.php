@extends('patrial.template')
@section('content')
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Kategori</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body> -->
<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Data Kategori</h1>
    <form method="POST" action="{{ route('kategoris.store') }}">
        @csrf

        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori:</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukkan Nama Kategori" value="{{ old('nama_kategori') }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi Kategori" rows="4" value="{{ old('deskripsi') }}" required></textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Tambah Data Kategori</button>
            <a href="{{ route('kategoris.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
<!-- Link Bootstrap JS (Optional) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->
@endsection