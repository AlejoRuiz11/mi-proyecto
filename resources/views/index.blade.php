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
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ofertas</a>
                    </li>
                </ul>
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
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="mt-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                                    Eliminar
                                </button>
                            </form>
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
