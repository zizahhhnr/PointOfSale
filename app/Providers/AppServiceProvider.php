<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Penjualan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    // Hitung jumlah pelanggan, produk, dan penjualan
    $pelangganCount = Pelanggan::count();
    $produkCount = Produk::count();
    $penjualanCount = Penjualan::count();

    // Notifikasi Stok Menipis (produk dengan stok <= 5)
    $stokMenipis = Produk::where('stok', '<=', 5)->get();

    // Ambil 5 Penjualan Terbaru
    $penjualanTerbaru = Penjualan::latest()->take(5)->get();

    // Share data ke semua view
    View::share([
        'pelangganCount' => $pelangganCount,
        'produkCount' => $produkCount,
        'penjualanCount' => $penjualanCount,
        'stokMenipis' => $stokMenipis,
        'penjualanTerbaru' => $penjualanTerbaru,
    ]);
    }
}
