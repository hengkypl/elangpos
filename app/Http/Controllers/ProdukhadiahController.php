<?php

namespace App\Http\Controllers;

use App\Models\Produkhadiah;
use Illuminate\Http\Request;

class ProdukhadiahController extends Controller
{
    public function index(Request $request)
    {
        $query = Produkhadiah::query()->orderBy('point', 'asc')->orderBy('namabarang', 'asc');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->whereRaw('LOWER(namabarang) LIKE ?', ['%' . $search . '%']);
        }

        $produkhadiahs = $query->paginate(12);

        return view('Produkhadiah.index', compact('produkhadiahs'));
    }

    public function create()
    {
        return view('Produkhadiah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namabarang' => 'required|string|max:255',
            'point' => 'required|integer',
            'keterangan' => 'nullable|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = $request->file('foto')->store('public/fotos');
        
        $produkhadiah = new Produkhadiah();
        $produkhadiah->namabarang = $request->namabarang;
        $produkhadiah->point = $request->point;
        $produkhadiah->keterangan = $request->keterangan;
        $produkhadiah->foto = $path;
        $produkhadiah->save();

        return redirect()->route('hadiah.index')->with('success','Produk telah tersimpan');
    }

    public function show($id)
    {
        $produkhadiah = Produkhadiah::findOrFail($id);
        return view('produkhadiah.show', compact('produkhadiah'));
    }

    public function edit($id)
    {
        $produkhadiah = Produkhadiah::findOrFail($id);
        return view('produkhadiah.edit', compact('produkhadiah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namabarang' => 'required|string|max:255',
            'point' => 'required|integer',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $produkhadiah = Produkhadiah::findOrFail($id);
        $produkhadiah->namabarang = $request->namabarang;
        $produkhadiah->point = $request->point;
        $produkhadiah->keterangan = $request->keterangan;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/fotos');
            $produkhadiah->foto = $path;
        }

        $produkhadiah->save();

        return redirect()->route('hadiah.index')->with('success','Produk telah dihapus');
    }

    public function destroy($id)
    {
        $produkhadiah = Produkhadiah::find($id);
        if ($produkhadiah) {
            $produkhadiah->delete();
            return redirect()->route('hadiah.index')->with('success','Produk telah dihapus');    
        } else {
            return redirect()->route('hadiah.index')->with('error', 'Produk tidak ditemukan');
        }
    }
}
