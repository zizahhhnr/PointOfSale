<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Penjualan</h2>
    
    @if($bulan)
        <p><strong>Bulan: </strong> {{ date('F', mktime(0, 0, 0, $bulan, 1)) }}</p>
    @endif
    @if($tahun)
        <p><strong>Tahun: </strong> {{ $tahun }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualans as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->tgl_penjualan }}</td>
                <td>{{ $p->nama_pembeli ?? 'Non-member' }}</td>
                <td>
                    @foreach($p->detail as $detail)
                        {{ $detail->produk->nama_produk }} ({{ $detail->jumlah }})<br>
                    @endforeach
                </td>
                <td>{{ number_format($p->total_harga, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
