<!-- resources/views/orders/index.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de pedidos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        h2 {
            color: #333;
        }

        .card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
        }

        .card-header {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .card-body p {
            margin: 5px 0;
        }

        ul {
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Historial de pedidos</h2>

        <?php if ($orders->isEmpty()): ?>
            <p>No has realizado ningún pedido aún.</p>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="card">
                    <div class="card-header">
                        Pedido #<?= $order->id ?> - <?= $order->created_at->format('d/m/Y H:i') ?>
                    </div>
                    <div class="card-body">
                        <p><strong>Nombre:</strong> <?= $order->user_name ?></p>
                        <p><strong>Correo:</strong> <?= $order->user_email ?></p>
                        <p><strong>Dirección:</strong> <?= $order->address ?></p> <!-- Dirección añadida -->
                        <p><strong>Total:</strong> $<?= number_format($order->total, 2) ?></p>
                        <h4>Productos:</h4>
                        <ul>
                            <?php foreach ($order->items as $item): ?>
                                <li><?= $item->product_name ?> (x<?= $item->quantity ?>) - $<?= number_format($item->subtotal, 2) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
