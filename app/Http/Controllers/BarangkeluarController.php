<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barangkeluar;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class BarangkeluarController extends Controller
{
    public function index()
    {
        $barangkeluar = Barangkeluar::with('barang')->latest()->paginate(10);
        return view('barangkeluar.index', compact('barangkeluar'));
    }

    public function create()
    {
        $merkBarang = Barang::pluck('merk', 'id');
        return view('barangkeluar.create', compact('merkBarang'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'tgl_keluar' => 'required|date',
            'qty_keluar' => 'required|integer|min:1',
            'barang_id' => 'required|exists:barang,id',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        // Cek apakah stok mencukupi
        if ($barang->stok < $request->qty_keluar) {
            return redirect()->back()->withInput()->withErrors(['qty_keluar' => 'Stok barang tidak mencukupi.']);
        }

        // Cek apakah tanggal keluar lebih awal dari tanggal barang masuk terakhir
        $barangMasukTerakhir = DB::table('barangmasuk')
            ->where('barang_id', $request->barang_id)
            ->orderBy('tgl_masuk', 'desc')
            ->first();

        if ($barangMasukTerakhir && $request->tgl_keluar < $barangMasukTerakhir->tgl_masuk) {
            return redirect()->back()->withInput()->withErrors(['tgl_keluar' => 'Tanggal keluar tidak bisa lebih awal dari tanggal barang masuk terakhir.']);
        }

        // Simpan data barang keluar ke database
        Barangkeluar::create([
            'tgl_keluar' => $request->tgl_keluar,
            'qty_keluar' => $request->qty_keluar,
            'barang_id' => $request->barang_id,
        ]);

        // Update stok barang
        $barang->stok -= $request->qty_keluar;
        $barang->save();

        return redirect()->route('barangkeluar.index')->with('success', 'Data barang keluar berhasil disimpan');
    }

    public function edit($id)
    {
        $barangkeluar = Barangkeluar::findOrFail($id);
        $merkBarang = Barang::pluck('merk', 'id');
        return view('barangkeluar.edit', compact('barangkeluar', 'merkBarang'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'tgl_keluar' => 'required|date',
            'qty_keluar' => 'required|integer|min:1',
            'barang_id' => 'required|exists:barang,id',
        ]);

        $barangkeluar = Barangkeluar::findOrFail($id);
        $barang = Barang::findOrFail($request->barang_id);

        // Periksa apakah stok barang mencukupi sebelum update
        $qty_difference = $request->qty_keluar - $barangkeluar->qty_keluar;
        if ($barang->stok < $qty_difference) {
            return redirect()->back()->withInput()->withErrors(['qty_keluar' => 'Stok barang tidak mencukupi.']);
        }

        // Update data barang keluar
        $barangkeluar->update([
            'tgl_keluar' => $request->tgl_keluar,
            'qty_keluar' => $request->qty_keluar,
            'barang_id' => $request->barang_id,
        ]);

        // Update stok barang
        $barang->stok -= $qty_difference;
        $barang->save();

        return redirect()->route('barangkeluar.index')->with('success', 'Data barang keluar berhasil diperbarui');
    }

    public function destroy($id)
    {
        $barangkeluar = Barangkeluar::findOrFail($id);
        $barang = Barang::find($barangkeluar->barang_id);
        $barang->stok += $barangkeluar->qty_keluar;
        $barang->save();

        $barangkeluar->delete();

        return redirect()->route('barangkeluar.index')->with('success', 'Barang keluar berhasil dihapus');
    }
}
