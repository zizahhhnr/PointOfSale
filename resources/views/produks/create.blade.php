@extends('patrial.template')
@section('content')
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Produk</title>
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body> -->
<div class="container mt-5">
    <h1 class="text-center mb-4">Tambah Data Produk</h1>
    <form method="POST" action="{{ route('produks.store') }}">
        @csrf
        
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk:</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Masukkan Nama Produk" required>

            <div class="form-group mb-3">
                <label for="id_kategori">Nama Kategori:</label>
                <select name="id_kategori" class="form-control" id="id_kategori" required>
                    <option value="">--Pilih Nama Kategori--</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="id_supplier">Nama Supplier:</label>
                <select name="id_supplier" class="form-control" id="id_supplier" required>
                    <option value="">--Pilih Nama Supplier--</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id_supplier }}">{{ $supplier->nama_supplier }}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga:</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga Produk" required>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok:</label>
            <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan Stok Produk" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Tambah Data Produk</button>
            <a href="{{ route('produks.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
<!-- Link Bootstrap JS (Optional) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->
@endsection