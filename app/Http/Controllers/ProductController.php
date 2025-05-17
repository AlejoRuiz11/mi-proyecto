<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('index', compact('products'));
    }

    public function store(Request $request)
    {
        // Validar que solo admin pueda crear (por si alguien hace POST directo)
        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permiso para crear productos.');
        }

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath
        ]);

        return redirect('/productos');
    }

    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        return view('create');
    }


    public function destroy($id)
    {
        // Solo admin puede eliminar
        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permiso para eliminar productos.');
        }

        $product = Product::findOrFail($id);

        // Borra la imagen si existe
        if ($product->image && \Storage::disk('public')->exists($product->image)) {
            \Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect('/productos')->with('success', 'Producto eliminado');
    }
}
