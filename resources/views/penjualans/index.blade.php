@extends('patrial.template')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4"> Penjualan</h2>

            <!-- Tombol Tambah Penjualan -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('penjualans.create') }}" class="btn btn-success">Tambah Penjualan</a>
                <form action="{{ route('penjualans.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari berdasarkan tanggal penjualan" value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </form>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var alertElement = document.querySelector('.alert');
                    if (alertElement) {
                        setTimeout(function() {
                            alertElement.style.display = 'none';
                        }, 2000);
                    }
                });
            </script>

            <!-- Tabel Data Penjualan -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Penjualan</th>
                        <th>Produk</th>
                        <th>Jumlah Produk</th>
                        <th>Total Harga</th>
                        <th>Uang Bayar</th>
                        <th>Kembali</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penjualans as $key => $penjualan)
                        <tr>
                            <td>{{ $penjualans->firstItem() + $key }}</td>
<td class="text-center">
    @if($penjualan->pelanggan)
        {{ $penjualan->pelanggan->nama_pelanggan }}
    @elseif($penjualan->nama_pembeli)
        {{ $penjualan->nama_pembeli }}
    @else
        <span class="badge bg-secondary p-2">Non-Member</span>
    @endif
</td>
                            <td>{{ $penjualan->tgl_penjualan }}</td>
                            <td>
                                @if(optional($penjualan->details)->isNotEmpty())
                                    <ul>
                                        @foreach($penjualan->details as $detail)
                                            <li>{{ optional($detail->produk)->nama_produk ?? 'Tidak ada produk' }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    Tidak ada produk
                                @endif
                            </td>
                            <td>{{ optional($penjualan->details)->sum('kuantitas') ?? 0 }}</td>
                            <td>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($penjualan->uang_bayar, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($penjualan->kembali, 0, ',', '.') }}</td>
                            <td>
                            <a href="#" class="btn btn-primary btn-sm lihat-struk" data-id="{{ $penjualan->id_penjualan }}" title="Lihat Struk">
    <i class="bi bi-receipt"></i>
</a>

                            
                           
                                <form action="{{ route('penjualans.destroy', $penjualan->id_penjualan) }}" method="POST" class="d-inline">
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
                            <td colspan="8" class="text-center">Data Penjualan Tidak Temukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $penjualans->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Struk -->
<div class="modal fade" id="strukModal" tabindex="-1" aria-labelledby="strukModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="strukModalLabel">Struk Penjualan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="strukContent">
                <!-- Struk akan dimuat di sini -->
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('.lihat-struk').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            url: '/penjualans/' + id,
            type: 'GET',
            success: function(response) {
                $('#strukContent').html(response);
                $('#strukModal').modal('show');
            },
            error: function() {
                alert('Gagal memuat struk.');
            }
        });
    });
});
</script>

@endsection
