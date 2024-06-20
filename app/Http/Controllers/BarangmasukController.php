<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barangmasuk;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;


class BarangmasukController extends Controller
{
    public function index()
    {
        $barangmasuk = Barangmasuk::with('barang')->latest()->paginate(10);
        return view('barangmasuk.index', compact('barangmasuk'));
    }


    public function create()
    {
        $merkBarang = Barang::pluck('merk', 'id');
        return view('barangmasuk.create', compact('merkBarang'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tgl_masuk' => 'required',
            'qty_masuk' => 'required|numeric|min:0',
            'barang_id' => 'required',
        ]);


        $barangMasuk = new Barangmasuk();
        $barangMasuk->tgl_masuk = $request->tgl_masuk;
        $barangMasuk->qty_masuk = $request->qty_masuk;
        $barangMasuk->barang_id = $request->barang_id;
        $barangMasuk->save();


        return redirect()->route('barangmasuk.index')->with('success', 'Barang masuk berhasil ditambahkan');
    }


    public function show($id)
    {
        $barangmasuk = Barangmasuk::findOrFail($id);
        return view('barangmasuk.show', compact('barangmasuk'));
    }


    public function edit($id)
    {
        $barangmasuk = Barangmasuk::findOrFail($id);
        $merkBarang = Barang::pluck('merk', 'id');
        return view('barangmasuk.edit', compact('barangmasuk', 'merkBarang'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tgl_masuk' => 'required',
            'qty_masuk' => 'required|numeric|min:0',
        ]);


        $barangmasuk = Barangmasuk::findOrFail($id);
        $barangmasuk->tgl_masuk = $request->tgl_masuk;
        $barangmasuk->qty_masuk = $request->qty_masuk;
        $barangmasuk->save();


        $barang = Barang::find($request->barang_id);
        $barang->stok += $request->qty_masuk;


        return redirect()->route('barangmasuk.index')->with('success', 'Barang masuk berhasil diperbarui');
    }


    public function destroy(BarangMasuk $barangmasuk)
    {
        $qty_masuk = $barangmasuk->qty_masuk;


        $barang_id = $barangmasuk->barang_id;
        $barangmasuk->delete();


        return redirect()->route('barangmasuk.index')->with('success', 'Barang masuk berhasil dihapus');
    }
}
