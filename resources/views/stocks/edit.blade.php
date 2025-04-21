@extends('patrial.template')
@section('content')
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Kategori</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body> -->
<div class="container mt-5">
    <h1 class="text-center mb-4">Ubah Data Satuan</h1>
    <form method="POST" action="{{ route('stocks.update', $stocks->id_stock) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan:</label>
            <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Masukkan Nama Satuan" value="{{ old('satuan', $stocks->satuan) }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi Kategori" rows="4" value="{{ old('deskripsi', $stocks->deskripsi) }}" required></textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Perbaharui</button>
            <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
<!-- Link Bootstrap JS (Optional) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->
@endsection