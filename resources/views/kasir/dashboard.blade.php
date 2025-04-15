@extends('patrial.template')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="container">
    <h2>Dashboard Kasir</h2>
    <p>Selamat datang, {{ auth()->user()->name }}!</p>

<div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total Pelanggan</h5>
                        <h3>{{ $pelangganCount }}</h3>
                    </div>
                    <div class="icon-container">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total Produk</h5>
                        <h3>{{ $produkCount }}</h3>
                    </div>
                    <div class="icon-container">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total Penjualan</h5>
                        <h3>{{ $penjualanCount }}</h3>
                    </div>
                    <div class="icon-container">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Tombol Navigasi -->
     <div class="mt-4">
        <a href="{{ route('kasir.penjualan') }}" class="btn btn-primary">Mulai Transaksi</a>
    </div>
</div>
</body>
</html>
@endsection