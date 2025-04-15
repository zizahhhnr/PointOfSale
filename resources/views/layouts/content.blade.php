<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .card {
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 4px 8px 15px rgba(0, 0, 0, 0.2);
        }
        .icon-container {
            font-size: 2rem;
            opacity: 0.8;
        }
        .table-responsive {
            max-height: 250px;
            overflow-y: auto;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="row g-3">
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

    <div class="row mt-4 g-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <strong>⚠️ Notifikasi Stok Menipis</strong>
                </div>
                <div class="card-body table-responsive">
                    @if(isset($stokMenipis) && $stokMenipis->isNotEmpty())
                        <ul class="list-group">
                            @foreach($stokMenipis as $produk)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $produk->nama_produk }}
                                    <span class="badge bg-danger">{{ $produk->stok }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-success">Semua stok aman ✅</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <strong>🛒 Penjualan Terbaru</strong>
                </div>
                <div class="card-body table-responsive">
                    @if(isset($penjualanTerbaru) && $penjualanTerbaru->isNotEmpty())
                        <table class="table table-sm table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Pelanggan</th>
                                    <th>Total</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penjualanTerbaru as $key => $penjualan)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $penjualan->pelanggan->nama_pelanggan ?? 'Non-member' }}</td>
                                        <td>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                                        <td>{{ $penjualan->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Belum ada transaksi terbaru</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
