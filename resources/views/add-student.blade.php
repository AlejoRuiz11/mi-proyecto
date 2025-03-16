<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Estudiante</title>
</head>
<body>
    <h2>Agregar Estudiante</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="/add-student" method="POST">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" name="name" required><br><br>

        <label for="age">Edad:</label>
        <input type="number" name="age" required><br><br>

        <label for="email">Correo:</label>
        <input type="email" name="email" required><br><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>
