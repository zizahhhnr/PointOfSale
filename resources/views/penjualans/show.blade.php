<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    .struk {
        font-family: 'Poppins', sans-serif;
        width: 320px;
        background: #f4f8fb;
        padding: 20px;
        border-radius: 14px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        margin: auto;
        color: #1e3a8a;
        border: 1px solid #cdd8f2;
    }

    .header {
        text-align: center;
        color: #1d4ed8;
    }

    hr {
        border: none;
        border-top: 1px dashed #93c5fd;
        margin: 10px 0;
    }

    .footer {
        text-align: center;
        font-size: 12px;
        margin-top: 10px;
        color: #3b82f6;
    }

    .btn-print {
        display: block;
        width: 100%;
        margin-top: 12px;
        background: #2563eb;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 500;
        transition: background 0.3s ease;
    }

    .btn-print:hover {
        background: #1e40af;
    }

    .struk p {
        margin: 5px 0;
        font-size: 14px;
    }

    .struk strong {
        color: #1e40af;
    }

    .produk-item {
        margin-bottom: 8px;
        padding-bottom: 8px;
        border-bottom: 1px dotted #c7d2fe;
    }
</style>

<div class="struk">
    <div class="header">
        <h4>PAY POINT</h4>
        <p>Jl. Ir. H. Juanda No. 25, Kemiri Muka, Kota Depok</p>
        <hr>
    </div>

    <p><strong>No. Struk:</strong> {{ $penjualan->id_penjualan }}</p>
    <p><strong>Tanggal:</strong> {{ $penjualan->tgl_penjualan }}</p>
    <p><strong>Pelanggan:</strong> {{ $penjualan->pelanggan->nama_pelanggan ?? 'Non-member' }}</p>
    <p><strong>Kasir:</strong> {{ Auth::user()->name }}</p>

    <hr>

    @foreach ($penjualan->details as $detail)
    <div class="produk-item">
        <p>{{ $detail->produk->nama_produk }} (x{{ $detail->kuantitas }})</p>
        <p>Harga Satuan: Rp {{ number_format($detail->produk->harga, 0, ',', '.') }}</p>
        <p>Subtotal: Rp {{ number_format($detail->produk->harga * $detail->kuantitas, 0, ',', '.') }}</p>
    </div>
    @endforeach

    <hr>
    <p><strong>Total:</strong> Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</p>
    <p><strong>Dibayar:</strong> Rp {{ number_format($penjualan->uang_bayar, 0, ',', '.') }}</p>
    <p><strong>Kembali:</strong> Rp {{ number_format($penjualan->kembali, 0, ',', '.') }}</p>

    <hr>
    <div class="footer">
        <p><strong>Terima Kasih</strong></p>
        <p>Silakan datang kembali</p>
        <p><b><em>Barang yang sudah dibeli tidak dapat dikembalikan.</em></b></p>
    </div>

    <button class="btn-print" onclick="window.print()">Cetak Struk</button>
</div>
