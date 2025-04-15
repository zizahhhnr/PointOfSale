@extends('patrial.template') 

@section('content')
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Supplier</title>
</head>
<body> -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Supplier</h1>
        
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('suppliers.create') }}" class="btn btn-primary">Tambah Data Supplier</a>
            <form action="{{ route('suppliers.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari Supplier" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Nama Supplier</th>
                        <th>No Telp</th>
                        <th>Email</th>
                        <th>Kontak Person</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                        <tr>
                            <td>{{ $loop->iteration }}</td> 
                            <td>{{ $supplier->nama_supplier }}</td>
                            <td>{{ $supplier->no_telp }}</td>
                            <td>{{ $supplier->email }}</td>
                            <td>{{ $supplier->kontak_person }}</td>
                            <td>
                                <a href="{{ route('suppliers.edit', $supplier->id_supplier) }}" class="btn btn-sm btn-primary me-1">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('suppliers.destroy', $supplier->id_supplier) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data Supplier</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
             {{ $suppliers->links('pagination::bootstrap-4') }}
            </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->
@endsection