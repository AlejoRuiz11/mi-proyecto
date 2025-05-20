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

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío.');
        }

        // Validar dirección
        $request->validate([
            'address' => 'required|string|max:255',
        ]);

        // Guardar la dirección temporalmente en sesión
        session()->put('checkout_address', $request->address);

        foreach ($cart as $id => $item) {
            $product = Product::find($id);

            if (!$product) {
                return redirect()->route('cart.index')->with('error', 'Uno de los productos no existe.');
            }

            if ($product->stock < $item['quantity']) {
                return redirect()->route('cart.index')->with('error', "No hay suficiente stock para el producto: {$product->name}");
            }

            // Descontar stock
            $product->stock -= $item['quantity'];
            $product->save();
        }

        // Redirigir al OrderController para crear la orden
        return redirect()->route('orders.create');
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
