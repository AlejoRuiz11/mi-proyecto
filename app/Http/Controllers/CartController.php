<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function add(Product $producto)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$producto->id])) {
            $cart[$producto->id]['quantity']++;
        } else {
            $cart[$producto->id] = [
                "name" => $producto->name,
                "quantity" => 1,
                "price" => $producto->price,
                "image" => $producto->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    public function remove(Product $producto)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$producto->id])) {
            unset($cart[$producto->id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }

    public function update(Request $request, Product $producto)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$producto->id])) {
            $cart[$producto->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Carrito actualizado');
    }
}
