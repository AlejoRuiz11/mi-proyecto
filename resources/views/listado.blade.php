    <style>
        table {
            border: 1px solid #ddd;
        }
        th, td {
            border: 1px solid #ddd;
        }
    </style>

    <h1 class="text-3xl">Listado de Estudiantes</h1>

    <table class="min-w-full">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Edad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td class="px-4 py-2">{{ $student->name }}</td>
                    <td class="px-4 py-2">{{ $student->age }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>



