<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Kategori;

class BarangController extends Controller
{
    public function index(Request $request)
    {    $barangs = Barang::with('kategori');

        if ($request->has('search')) {
            $search = $request->input('search');
            $barangs->where(function($barangs) use ($search) {
                $barangs->where('merk', 'like', '%' . $search . '%')
                      ->orWhere('seri', 'like', '%' . $search . '%')
                      ->orWhere('spesifikasi', 'like', '%' . $search . '%')
                      ->orWhereHas('kategori', function ($q) use ($search) {
                          $q->where('deskripsi', 'like', '%' . $search . '%');
                      });
            });
        }
    
        $rsetBarang = $barangs->latest()->paginate(5);
    
        if ($request->has('search') && $rsetBarang->isEmpty()) {
            return redirect()->route('barang.index')->with('warning', 'Data tidak ditemukan.');
        }
    
        return view('barang.index', compact('rsetBarang'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    
    
    }


    public function create()
    {
        $kategori = Kategori::all();
        return view('barang.create', compact('kategori'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required',
            'seri' => 'required',
            'spesifikasi' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
        ]);


        Barang::create($request->all());


        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }


    public function edit(Barang $barang)
    {
        $kategori = Kategori::all();
        return view('barang.edit', compact('barang', 'kategori'));
    }


    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'merk' => 'required',
            'seri' => 'required',
            'spesifikasi' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
        ]);


        $barang->update($request->all());


        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!');
    }


    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function destroy(string $id)
    {
        if (DB::table('barangmasuk')->where('barang_id', $id)->exists() || DB::table('barangkeluar')->where('barang_id', $id)->exists()) {
            return redirect()->route('barang.index')->with(['error' => 'Data Gagal Dihapus karena terdapat relasi dengan data lain!']);
        }
    
        $barang = Barang::findOrFail($id);
        $barang->delete();
    
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    
}