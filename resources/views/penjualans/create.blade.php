@extends('layouts.template')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://bootswatch.com/5/lux/bootstrap.min.css">
   
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
        }
        h1 {
            color: #0d6efd;
            margin-bottom: 1.5rem;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-success {
            background-color: #198754;
            border-color: #198754;
        }
        .btn-success:hover {
            background-color: #157347;
            border-color: #146c43;
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #bb2d3b;
            border-color: #b02a37;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        .table {
            margin-top: 1rem;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Buat Penjualan Baru</h1>

    <!-- Tampilkan error jika ada -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penjualans.store') }}" method="POST">
        @csrf

        <style>
    .form-group {
        margin-bottom: 10px;
    }

    .radio-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    select, input[type="text"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    .hidden {
        display: none;
    }
</style>

<script>
    function toggleInput() {
        document.getElementById('pelanggan_div').classList.toggle('hidden', !document.getElementById('pelanggan').checked);
        document.getElementById('nama_pelanggan_div').classList.toggle('hidden', document.getElementById('pelanggan').checked);
    }
</script>

<!-- Pilihan pelanggan atau non-member -->
<div class="form-group">
    <label>Jenis Pembeli:</label>
    <div class="radio-group">
        <input type="radio" name="jenis_pembeli" value="pelanggan" id="pelanggan" onclick="toggleInput()" checked>
        <label for="pelanggan">Pelanggan</label>

        <input type="radio" name="jenis_pembeli" value="non_member" id="non_member" onclick="toggleInput()">
        <label for="non_member">Non-Member</label>
    </div>
</div>

<!-- Pilihan pelanggan (Default) -->
<div class="form-group" id="pelanggan_div">
    <label for="id_pelanggan">Pilih Pelanggan</label>
    <select name="id_pelanggan" id="id_pelanggan" class="form-control select2">
        <option value="">-- Pilih Pelanggan --</option>
        @foreach($pelanggans as $pelanggan)
            <option value="{{ $pelanggan->id_pelanggan }}">{{ $pelanggan->nama_pelanggan }}</option>
        @endforeach
    </select>
</div>


<!-- Input untuk Non-Member (Sembunyi Default) -->
<div class="form-group hidden" id="nama_pelanggan_div">
    <label for="nama_pembeli">Nama Pembeli</label>
    <input type="text" name="nama_pembeli" id="nama_pembeli" placeholder="Masukkan Nama Pembeli">
</div>


        <!-- Tanggal Penjualan -->
        <div class="mb-3">
            <label for="tgl_penjualan" class="form-label">Tanggal Penjualan</label>
            <input type="date" id="tgl_penjualan" name="tgl_penjualan" class="form-control">
            </div>

        <!-- Produk dan Detail -->
        <div class="mb-3">
            <label for="produk" class="form-label">Produk</label>
            <table class="table table-bordered" id="productTable">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Kuantitas</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="productRows">
                    <tr>
                    <td>
    <select class="form-control product-select" name="id_detail[][id_produk]" required>
        <option value="">Pilih Produk</option>
        @foreach ($produks as $produk)
            <option value="{{ $produk->id_produk }}" data-harga="{{ $produk->harga }}">
                {{ $produk->nama_produk }}
            </option>
        @endforeach
    </select>
</td>

                        <td>
                        <input type="number" class="form-control harga" readonly>
                        </td>

                        <td>
                            <input type="number" class="form-control kuantitas" name="id_detail[0][kuantitas]" min="1" value="1" required>
                        </td>
                        <td>
                            <input type="number" class="form-control subtotal" name="id_detail[0][subtotal]" readonly>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-row">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" id="addRow" class="btn btn-primary">Tambah Produk</button>
        </div>

        <!-- Total Harga -->
        <div class="mb-3">
            <label for="total_harga" class="form-label">Total Harga</label>
            <input type="number" class="form-control" id="total_harga" name="total_harga" readonly>
        </div>

        <!-- Uang Bayar -->
        <div class="mb-3">
            <label for="uang_bayar" class="form-label">Uang Bayar</label>
            <input type="number" class="form-control" id="uang_bayar" name="uang_bayar" required>
        </div>

        <!-- Kembalian -->
        <div class="mb-3">
            <label for="kembali" class="form-label">Kembali</label>
            <input type="number" class="form-control" id="kembali" name="kembali" readonly>
        </div>

        <!-- Submit -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Simpan Penjualan</button>
            <a href="{{ route('penjualans.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        const productTable = document.getElementById('productRows');
        const totalHargaInput = document.getElementById('total_harga');
        const uangBayarInput = document.getElementById('uang_bayar');
        const kembaliInput = document.getElementById('kembali');

        // Tambah baris produk
        document.getElementById('addRow').addEventListener('click', () => {
            const rowCount = productTable.children.length;
            const newRow = `
                <tr>
                    <td>
                        <select class="form-control  product-select" name="id_detail[${rowCount}][id_produk]" required>
                            <option value="">Pilih Produk</option>
                            @foreach ($produks as $produk)
                        <option value="{{ $produk->id_produk }}" data-harga="{{ $produk->harga }}">
                            {{ $produk->nama_produk }}
                         </option>
                        @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control harga" name="id_detail[${rowCount}][harga]" readonly>
                    </td>
                    <td>
                        <input type="number" class="form-control kuantitas" name="id_detail[${rowCount}][kuantitas]" min="1" value="1" required>
                    </td>
                    <td>
                        <input type="number" class="form-control subtotal" name="id_detail[${rowCount}][subtotal]" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-row">Hapus</button>
                    </td>
                </tr>
            `;
            productTable.insertAdjacentHTML('beforeend', newRow);
        });

        // Hapus baris produk
        productTable.addEventListener('click', (event) => {
            if (event.target.classList.contains('remove-row')) {
                event.target.closest('tr').remove();
                calculateTotal();
            }
        });

        // Perbarui harga dan subtotal saat memilih produk
        productTable.addEventListener('change', (event) => {
            if (event.target.classList.contains('product-select')) {
                const harga = event.target.selectedOptions[0].getAttribute('data-harga');
                const row = event.target.closest('tr');
                row.querySelector('.harga').value = harga;
                updateSubtotal(row);
            }
        });

        // Perbarui subtotal saat kuantitas berubah
        productTable.addEventListener('input', (event) => {
            if (event.target.classList.contains('kuantitas')) {
                const row = event.target.closest('tr');
                updateSubtotal(row);
            }
        });

        // Perbarui total harga
        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.subtotal').forEach((input) => {
                total += parseFloat(input.value || 0);
            });
            totalHargaInput.value = total;
        }

        // Hitung subtotal
        function updateSubtotal(row) {
            const harga = parseFloat(row.querySelector('.harga').value || 0);
            const kuantitas = parseInt(row.querySelector('.kuantitas').value || 0);
            const subtotal = harga * kuantitas;
            row.querySelector('.subtotal').value = subtotal;
            calculateTotal();
        }

        // Hitung kembalian
        uangBayarInput.addEventListener('input', () => {
            const totalHarga = parseFloat(totalHargaInput.value || 0);
            const uangBayar = parseFloat(uangBayarInput.value || 0);
            kembaliInput.value = uangBayar - totalHarga;
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        let today = new Date();
        let formattedDate = today.toISOString().split('T')[0]; // Format: YYYY-MM-DD
        document.getElementById("tgl_penjualan").value = formattedDate;
    });

    
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Cari produk...",
            allowClear: true
        });
    });


</script>


</body>
</html>
@endsection