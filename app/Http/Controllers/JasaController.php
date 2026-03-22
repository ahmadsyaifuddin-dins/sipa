<?php

namespace App\Http\Controllers;

use App\Http\Requests\JasaRequest;
use App\Models\Category;
use App\Models\Item;

class JasaController extends Controller
{
    public function index()
    {
        // Hanya ambil data jasa
        $jasas = Item::with('category')->where('type', 'jasa')->latest()->paginate(10);

        return view('jasa.index', compact('jasas'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('jasa.create', compact('categories'));
    }

    public function store(JasaRequest $request)
    {
        $validated = $request->validated();
        $validated['type'] = 'jasa'; // Set tipe item
        $validated['stok'] = null;   // Jasa tidak memiliki stok

        Item::create($validated);

        return redirect()->route('jasa.index')->with('success', 'Jasa Layanan berhasil ditambahkan!');
    }

    public function edit(Item $jasa)
    {
        $categories = Category::all();

        return view('jasa.edit', compact('jasa', 'categories'));
    }

    public function update(JasaRequest $request, Item $jasa)
    {
        $validated = $request->validated();

        $jasa->update($validated);

        return redirect()->route('jasa.index')->with('success', 'Data Jasa Layanan berhasil diperbarui!');
    }

    public function destroy(Item $jasa)
    {
        $jasa->delete();

        return redirect()->route('jasa.index')->with('success', 'Jasa Layanan berhasil dihapus!');
    }
}
