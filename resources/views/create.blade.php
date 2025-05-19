@if ($errors->any())
    <div style="color: red; margin-bottom: 1em;">
        <strong>Se encontraron errores:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Nombre:</label>
    <input type="text" name="name" value="{{ old('name') }}" required>
    @error('name')
        <div style="color: red;">{{ $message }}</div>
    @enderror

    <br><br>

    <label>Descripción:</label>
    <textarea name="description">{{ old('description') }}</textarea>
    @error('description')
        <div style="color: red;">{{ $message }}</div>
    @enderror

    <br><br>

    <label>Precio:</label>
    <input type="number" name="price" step="0.01" min="0" value="{{ old('price') }}" required>
    @error('price')
        <div style="color: red;">{{ $message }}</div>
    @enderror

    <br><br>

    <label>Stock:</label>
    <input type="number" name="stock" min="0" value="{{ old('stock') }}" required>
    @error('stock')
        <div style="color: red;">{{ $message }}</div>
    @enderror

    <br><br>

    <label>Imagen:</label>
    <input type="file" name="image" accept=".jpg,.jpeg,.png" required>
    @error('image')
        <div style="color: red;">{{ $message }}</div>
    @enderror

    <br><br>

    <button type="submit">Guardar producto</button>

    <a href="{{ route('products.cancelar') }}" class="btn btn-danger" style="margin-left: 10px;">
        Cancelar
    </a>
</form>
