<?php
namespace App\Http\Controllers;

use App\Models\TidakTerdaftar;
use Illuminate\Http\Request;

class TidakTerdaftarController extends Controller
{
    public function index()
    {
        $query = TidakTerdaftar::query()->orderBy('id', 'desc');
        $items = $query->paginate(10);

        return view('tidakterdaftar.index', compact('items'));
    }

    public function create()
    {
        return view('tidakterdaftar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kassa' => 'required|string|max:10',
            'operator' => 'required|string|max:10',
            'kodebarang' => 'required|string|max:20',
        ]);

        TidakTerdaftar::create($request->all());

        return redirect()->route('tidakterdaftar.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(TidakTerdaftar $tidakterdaftar)
    {
        return view('tidakterdaftar.show', compact('tidakterdaftar'));
    }

    public function edit(TidakTerdaftar $tidakterdaftar)
    {
        return view('tidakterdaftar.edit', compact('tidakterdaftar'));
    }

    public function update(Request $request, TidakTerdaftar $tidakterdaftar)
    {
        $request->validate([
            'kassa' => 'required|string|max:10',
            'operator' => 'required|string|max:10',
            'kodebarang' => 'required|string|max:20',
        ]);

        $tidakterdaftar->update($request->all());

        return redirect()->route('tidakterdaftar.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(TidakTerdaftar $tidakterdaftar)
    {
        $tidakterdaftar->delete();

        return redirect()->route('tidakterdaftar.index')->with('success', 'Data berhasil dihapus.');
    }
}
