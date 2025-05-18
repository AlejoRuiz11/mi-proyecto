<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gracias por tu compra</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }

        .mensaje {
            text-align: center;
            max-width: 500px;
            background: white;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .chulito {
            font-size: 60px;
            color: #28a745;
            margin-bottom: 20px;
        }

        .texto {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .detalle {
            text-align: left;
            margin-bottom: 20px;
        }

        .detalle h3 {
            margin-bottom: 10px;
            font-weight: bold;
            color: #444;
        }

        .detalle ul {
            list-style: none;
            padding-left: 0;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .detalle ul li {
            padding: 8px 12px;
            border-bottom: 1px solid #eee;
            font-size: 16px;
            color: #555;
        }

        .detalle ul li:last-child {
            border-bottom: none;
        }

        .btn-volver {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            display: inline-block;
            margin-top: 10px;
        }

        .btn-volver:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="mensaje">
        <div class="chulito">✔️</div>
        <div class="texto">¡Gracias por tu compra, {{ $order->user_name }}!</div>

        <div class="detalle">
            <p><strong>Total pagado:</strong> ${{ number_format($order->total, 2) }}</p>

            <h3>Productos comprados:</h3>
            <ul>
                @foreach($order->items as $item)
                    <li>{{ $item->product_name }} — Cantidad: {{ $item->quantity }} — ${{ number_format($item->subtotal, 2) }}</li>
                @endforeach
            </ul>
        </div>

        <a href="/" class="btn-volver">Volver al inicio</a>
    </div>
</body>
</html>
