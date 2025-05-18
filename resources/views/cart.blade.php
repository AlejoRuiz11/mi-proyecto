<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('products.index') }}">VirtualShopping</a>

            <!-- Botón hamburguesa -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Contenido colapsable -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                @if (Route::has('login'))
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-dark btn-sm">Carrito</a>
                        @auth
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark btn-sm">Perfil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-dark btn-sm">Cerrar sesión</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-sm">Register</a>
                            @endif
                        @endauth
                        
                    </div>
                @endif
            </div>
        </div>
    </nav>


    <!-- Contenido principal -->
    <div class="container py-5">
        <h1 class="mb-4 fw-bold">Carrito de Compras</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(count($cart) > 0)
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($cart as $id => $producto)
                            @php $subtotal = $producto['price'] * $producto['quantity']; @endphp
                            <tr>
                                <td class="fw-medium">{{ $producto['name'] }}</td>
                                <td>
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center gap-2">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $producto['quantity'] }}" min="1" class="form-control form-control-sm w-50">
                                        <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
                                    </form>
                                </td>
                                <td>${{ number_format($producto['price'], 2) }}</td>
                                <td>${{ number_format($subtotal, 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @php $total += $subtotal; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <h3 class="mt-4 fw-semibold">Total: ${{ number_format($total, 2) }}</h3>
        @else
            <div class="alert alert-info mt-4">El carrito está vacío</div>
        @endif
        
        @php
            $hayProductos = count($cart) > 0;
        @endphp

        <form action="{{ route('checkout') }}" method="GET">
            <button type="submit"
                class="btn w-100 mt-4 {{ $hayProductos ? 'btn-success' : 'btn-secondary disabled' }}"
                {{ $hayProductos ? '' : 'disabled' }}
                style="{{ $hayProductos ? '' : 'pointer-events: none; cursor: default;' }}">
                Pagar
            </button>
        </form>

    </div>

    <!-- Bootstrap JS (opcional si usás cosas como collapses) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
