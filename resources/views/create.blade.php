<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Nombre:</label>
    <input type="text" name="name" required>

    <label>Descripción:</label>
    <textarea name="description"></textarea>

    <label>Precio:</label>
    <input type="number" name="price" step="0.01" required>

    <label>Stock:</label>
    <input type="number" name="stock" required>

    <label>Imagen:</label>
    <input type="file" name="image">

    <button type="submit">Guardar producto</button>
    
    <a href="{{ route('products.cancelar') }}" class="btn btn-danger">
        Cancelar
    </a>
</form>
