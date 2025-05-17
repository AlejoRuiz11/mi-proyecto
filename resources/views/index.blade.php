<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>VirtualShopping</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">VirtualShopping</a>
            <div class="collapse navbar-collapse justify-content-end">
                @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark btn-sm">
                        Perfil
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark btn-sm">
                            Cerrar sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-sm">
                            Register
                        </a>
                    @endif
                @endauth

                </nav>
            @endif
            </div>
        </div>
    </nav>
    
    <!-- Contenido -->
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @auth
            <p>Bienvenido, {{ Auth::user()->name }}!</p>
        @endauth

        @guest
            <p>Debes iniciar sesión para ver esto.</p>
        @endguest

        <div class="mb-4 text-end">
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        Añadir producto
                    </a>
                @endif
            @endauth
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="fw-bold">${{ $product->price }}</p>
                            
                            @auth
                                @if(Auth::user()->role === 'admin')
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="mt-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                                            Eliminar
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="d-flex flex-wrap justify-content-between align-items-center pt-3 mt-4 border-top">
      <p class="col-md-4 mb-4 mx-3 text-center" style="color: rgb(34, 34, 34);"> © 2024 Alejandro Ruiz</p>

      <ul class="nav col-md-4 mb-4 mx-3 justify-content-center">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#" style="color: rgb(34, 34, 34);">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#tareasDeHoy" style="color: rgb(34, 34, 34);">Blablabla</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#informacion" style="color: rgb(34, 34, 34);">Blabla Bla</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#custom-cards" style="color: rgb(34, 34, 34);">BlaBla</a>
        </li>
      </ul>
    </footer>

</body>
</html>
