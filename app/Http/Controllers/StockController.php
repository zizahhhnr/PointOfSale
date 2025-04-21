<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $query = Stock::query();
    
          // Jika ada input pencarian, tambahkan kondisi ke query
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('satuan', 'LIKE', '%' . $search . '%')
              ->orWhere('deskripsi', 'LIKE', '%' . $search . '%');
        });
    }
    
    // Mendapatkan hasil pencarian
    $results = $query->get();
    
    // Mendapatkan hasil query dengan paginasi
    $stocks = $query->orderBy('id_stock', 'desc')->paginate(10);

        // Return ke view dengan data produk
        return view('stocks.index', compact('stocks', 'search'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stocks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'satuan' => 'required|max:255',
            'deskripsi' => 'required',
        ]);
  
        // Membuat record baru di database
        Stock::create($request->all());
   
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('stocks.index')->with('success', 'Stock berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit($id_stock)
    {
        $stocks = Stock::findOrFail($id_stock); 
        return view('stocks.edit', compact('stocks'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_stock)
    {
        $this->validate($request, [
            'satuan' => 'required|max:255',
            'deskripsi' => 'required',
          
        ]);
     
        $stocks = Stock::findOrFail($id_stock); 
        $stocks->update($request->all());

        return redirect()->route('stocks.index')->with('success', 'Stock berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_stock)
    {
        $stocks = Stock::findOrFail($id_stock); 
        $stocks->delete();

        return redirect()->route('stocks.index')->with('success', 'stocks berhasil dihapus.');
    }
}
