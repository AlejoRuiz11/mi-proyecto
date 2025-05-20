<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $orders = Order::with('items')->orderByDesc('created_at')->get();
        }
        else {
        $orders = Order::with('items')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();
    }
        return view('orders', compact('orders'));
    }

    public function create()
    {
        $cart = session()->get('cart', []);
        $address = session()->get('checkout_address');

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío.');
        }

        if (!$address) {
            return redirect()->route('cart.index')->with('error', 'No se proporcionó dirección de envío.');
        }

        // Crear la orden
        $order = new Order();
        $order->user_id = Auth::id() ?? null;
        $order->user_name = Auth::user()->name ?? 'Invitado';
        $order->user_email = Auth::user()->email ?? 'invitado@ejemplo.com';
        $order->address = $address;
        $order->total = 0; // Se actualizará más adelante
        $order->save();

        $total1 = 0;

        foreach ($cart as $id => $item) {
            $subtotal = $item['price'] * $item['quantity'];

            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'product_price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $subtotal,
            ]);

            $total1 += $subtotal;
        }

        $order->total = $total1;
        $order->save();

        // Limpiar carrito y dirección
        session()->forget('cart');
        session()->forget('checkout_address');

        // Mostrar vista gracias por la compra
        return view('purchase', compact('order'));
    }


}
