<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class KategoriController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(Request $request):View
    {
        $kategoris = Kategori::select('id', 'deskripsi', 'kategori', \DB::raw('(CASE
        WHEN kategori = "M" THEN "Modal"
        WHEN kategori = "A" THEN "Alat"
        WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
        ELSE "Bahan Tidak Habis Pakai"
        END) AS ketKategorik'));

    if ($request->has('search')) {
        $search = $request->input('search');
        $kategoris->where(function($q) use ($search) {
            $q->where('deskripsi', 'like', '%' . $search . '%')
                ->orWhere('kategori', 'like', '%' . $search . '%')
                ->orWhereRaw('(CASE
                    WHEN kategori = "M" THEN "Modal"
                    WHEN kategori = "A" THEN "Alat"
                    WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
                    ELSE "Bahan Tidak Habis Pakai"
                    END) LIKE ?', ['%' . $search . '%']);
        });
    }

         $rsetKategori = $kategoris->paginate(10);
        // $rsetKategori = Kategori::all();
        return view('kategori.index', compact('rsetKategori'));

    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        $aKategori = array(
            'blank' => 'Pilih Kategori',
            'M' => 'Barang Modal',
            'A' => 'Alat',
            'BHP' => 'Bahan Habis Pakai',
            'BTHP' => 'Bahan Tidak Habis Pakai'
        );
        return view('kategori.create', compact('aKategori'));
    }

    /**
     * store
     *
     * @param  Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate form
        $request->validate([
            'kategori' => 'required|in:M,A,BHP,BTHP',
            'deskripsi' => 'required|max:100'
        ]);

        // Create kategori
        Kategori::create($request->all());

        // Redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  int $id
     * @return View
     */
    public function show(int $id): View
    {
        // Get kategori by ID
        $kategori = Kategori::select(
            'id',
            'deskripsi',
            'kategori',
            \DB::raw('(CASE
            WHEN kategori = "M" THEN "Modal"
            WHEN kategori = "A" THEN "Alat"
            WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
            ELSE "Bahan Tidak Habis Pakai"
            END) AS ketKategori')
        )->findOrFail($id);

        // Render view with kategori
        return view('kategori.show', compact('kategori'));
    }

    /**
     * edit
     *
     * @param  int $id
     * @return View
     */
    public function edit(int $id): View
    {
        // Get kategori by ID
        $kategori = Kategori::select(
            'id',
            'deskripsi',
            'kategori',
            \DB::raw('(CASE
            WHEN kategori = "M" THEN "Modal"
            WHEN kategori = "A" THEN "Alat"
            WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
            ELSE "Bahan Tidak Habis Pakai"
            END) AS ketKategori')
        )->findOrFail($id);
        // Render view with kategori
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * update
     *
     * @param  Request $request
     * @param  int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        // Validate form
        $request->validate([
            'kategori' => 'required|in:M,A,BHP,BTHP',
            'deskripsi' => 'required|max:100'
        ]);

        // Get kategori by ID
        $kategori = Kategori::findOrFail($id);

        // Update kategori
        $kategori->update($request->all());

        // Redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
{
    // Check if the kategori is referenced in the barang table
    if (DB::table('barang')->where('kategori_id', $id)->exists()) {
        return redirect()->route('kategori.index')->with(['error' => 'Data Gagal Dihapus karena terdapat relasi dengan data lain!']);
    }

    // Get kategori by ID
    $kategori = Kategori::findOrFail($id);

    // Delete kategori
    $kategori->delete();

    // Redirect to index with success message
    return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
}
}
