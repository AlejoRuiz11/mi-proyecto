<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gracias por tu compra</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .mensaje {
            text-align: center;
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

        .btn-volver {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-volver:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="mensaje">
        <div class="chulito">✔️</div>
        <div class="texto">¡Gracias por tu compra!</div>
        <a href="/" class="btn-volver">Volver al inicio</a>
    </div>
</body>
</html>
