@extends('patrial.template')
@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">Ubah Data Produk</h1>
    <form method="POST" action="{{ route('produks.update', $produk->id_produk) }}">
        @csrf
        @method('PUT')

        @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <!-- <div class="mb-3">
            <label for="no_invoice" class="form-label">No Invoice:</label>
            <input type="text" class="form-control" id="no_invoice" name="no_invoice" value="{{ old('no_invoice', $produk->no_invoice) }}" placeholder="Masukkan No Invoice" readonly>
        </div> -->
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk:</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" placeholder="Masukkan Nama Produk" required>
        </div>

        <div class="mb-3">
                <label for="id_kategori" class="form-label">Nama Kategori:</label>
                <select name="id_kategori" class="form-select" id="id_kategori" required>
                    <option value="">--Pilih Nama Kategori--</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ old('id_kategori', $kategori->id_kategori) }}" {{ $kategori->id_kategori == $produk->id_kategori ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
    <label for="id_supplier" class="form-label">Nama Supplier:</label>
    <select name="id_supplier" class="form-select" id="id_supplier" required>
        <option value="">--Pilih Nama Supplier--</option>
        @foreach ($suppliers as $supplier)
            <option value="{{ $supplier->id_supplier }}" {{ old('id_supplier', $produk->id_supplier) == $supplier->id_supplier ? 'selected' : '' }}>
                {{ $supplier->nama_supplier }}
            </option>
        @endforeach
    </select>
</div>


        <div class="mb-3">
            <label for="harga" class="form-label">Harga:</label>
            <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga', $produk->harga) }}" placeholder="Masukkan Harga Produk" required>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok:</label>
            <input type="number" class="form-control" id="stok" name="stok" value="{{ old('stok', $produk->stok) }}" placeholder="Masukkan Stok Produk" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Perbaharui</button>
            <a href="{{ route('produks.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

@endsection