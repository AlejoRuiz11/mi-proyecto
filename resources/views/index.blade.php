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
                            <a href="{{ route('login') }}" class="btn btn-outline-dark btn-sm">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-outline-dark btn-sm">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>
    
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" aria-label="Slide 1" class="active" ></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class="" ></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="storage/Images/pcgamer2.jpg" class="d-block w-100"style="width: 100%; height: 100%;">
            <div class="container">
              <div class="carousel-caption text-start carouselTexto">
                <h1>Tu Entretenimiento en Alta Definición</h1>
                <p class="opacity-75">Vive una experiencia visual envolvente con nuestras pantallas y equipos para el hogar.</p>                
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="storage/Images/pcgamer.jpg" class="d-block w-100"style="width: 100%; height: 100%;">
            <div class="container">
              <div class="carousel-caption text-start carouselTexto">
                <h1 >Rendimiento que Impulsa tus Ideas</h1>
                <p>Explora nuestras PCs de alto rendimiento diseñadas para gamers, creadores y profesionales exigentes.</p>
                
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="storage/Images/phones.jpg" class="d-block w-100" style="width: 100%; height: 100%;">
            <div class="container">
              <div class="carousel-caption text-end">
                <h1>Conectado a lo Importante</h1>
                <p>Descubre los últimos modelos de smartphones y mantente siempre cerca de lo que más te importa.</p>
                
              </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
    </div>



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
                            <p>Stock: {{ $product->stock }}</p>
                            
                            @auth
                                @if(Auth::user()->role === 'admin')
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="mt-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                                            Eliminar
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm w-100">
                                            Añadir al carrito
                                        </button>
                                    </form>
                                @endif
                            @endauth

                            @guest
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm w-100">
                                        Añadir al carrito
                                    </button>
                                </form>
                            @endguest
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

    <!-- Bootstrap JS (opcional si usás cosas como collapses) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
