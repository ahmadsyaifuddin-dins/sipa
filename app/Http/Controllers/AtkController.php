<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtkRequest;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\File;

class AtkController extends Controller
{
    public function index()
    {
        // Hanya ambil data barang (bukan jasa)
        $barangs = Item::with('category')->where('type', 'barang')->latest()->paginate(10);

        return view('atk.index', compact('barangs'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('atk.create', compact('categories'));
    }

    public function store(AtkRequest $request)
    {
        $validated = $request->validated();
        $validated['type'] = 'barang'; // Set default tipe item

        // Aturan 2: Upload File Old School
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            // Pindah langsung ke public/uploads
            $file->move(public_path('uploads'), $filename);
            $validated['foto'] = $filename;
        }

        Item::create($validated);

        return redirect()->route('atk.index')->with('success', 'Barang ATK berhasil ditambahkan!');
    }

    public function edit(Item $atk)
    {
        $categories = Category::all();

        return view('atk.edit', compact('atk', 'categories'));
    }

    public function update(AtkRequest $request, Item $atk)
    {
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $validated['foto'] = $filename;

            // Hapus foto lama jika ada
            if ($atk->foto && File::exists(public_path('uploads/'.$atk->foto))) {
                File::delete(public_path('uploads/'.$atk->foto));
            }
        }

        $atk->update($validated);

        return redirect()->route('atk.index')->with('success', 'Data Barang ATK berhasil diperbarui!');
    }

    public function destroy(Item $atk)
    {
        // Hapus foto fisik dari folder public/uploads
        if ($atk->foto && File::exists(public_path('uploads/'.$atk->foto))) {
            File::delete(public_path('uploads/'.$atk->foto));
        }

        $atk->delete();

        return redirect()->route('atk.index')->with('success', 'Barang ATK berhasil dihapus!');
    }
}
