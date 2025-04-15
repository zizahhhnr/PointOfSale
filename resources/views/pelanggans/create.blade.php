@extends('patrial.template')
@section('content')
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pelanggan</title>
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body> -->
<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Data Pelanggan</h1>
    <form method="POST" action="{{ route('pelanggans.store') }}">
        @csrf

        <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Nama Pelanggan:</label>
            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukkan Nama Pelanggan" value="{{ old('nama_pelanggan') }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat:</label>
            <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat Pelanggan" rows="4" value="{{ old('alamat') }}" required></textarea>
        </div>

        <div class="mb-3">
            <label for="no_telp" class="form-label">No Telp:</label>
            <input type="tel" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan No Telepon" value="{{ old('no_telp') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Tambah Data Pelanggan</button>
            <a href="{{ route('pelanggans.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->
@endsection