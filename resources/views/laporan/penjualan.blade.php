@extends('patrial.template') 

@section('content')
<div class="container">
    <h2 class="mb-4">Laporan Penjualan</h2>

    <form method="GET" action="{{ route('laporan.penjualan') }}">
        <div class="row">
            <div class="col-md-4">
                <label for="bulan">Pilih Bulan</label>
                <select name="bulan" id="bulan" class="form-control">
                    <option value="">Semua</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4">
                <label for="tahun">Pilih Tahun</label>
                <select name="tahun" id="tahun" class="form-control">
                    <option value="">Semua</option>
                    @for ($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4 mt-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('laporan.penjualan.pdf', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}" class="btn btn-success">Cetak PDF</a>
            </div>
        </div>
    </form>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total Harga</th>
                <th>Detail Produk</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($penjualans as $penjualan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $penjualan->tgl_penjualan }}</td>
                    <td>{{ $penjualan->nama_pembeli ?? $penjualan->pelanggan->nama_pelanggan ?? 'Non-member' }}</td>
                    <td>Rp {{ number_format($penjualan->total_harga, 2, ',', '.') }}</td>
                    <td>
                        <ul>
                            @foreach ($penjualan->details as $detail)
                                <li>{{ $detail->produk->nama_produk }} ({{ $detail->kuantitas }})</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
