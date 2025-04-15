@extends('patrial.template')
@section('content')
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Supplier</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body> -->
<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Data Supplier</h1>
    <form method="POST" action="{{ route('suppliers.store') }}">
        @csrf

        <div class="mb-3">
            <label for="nama_supplier" class="form-label">Nama Supplier:</label>
            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" placeholder="Masukkan Nama Supplier" value="{{ old('nama_supplier') }}" required>
        </div>

        <div class="mb-3">
            <label for="no_telp" class="form-label">No Telp:</label>
            <input type="tel" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan No Telepon" value="{{ old('no_telp') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="kontak_person" class="form-label">Nama Supplier:</label>
            <input type="text" class="form-control" id="kontak_person" name="kontak_person" placeholder="Masukkan Nama Kontak Person" value="{{ old('kontak_person') }}" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Tambah Data Supplier</button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
<!-- Link Bootstrap JS (Optional) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->
@endsection