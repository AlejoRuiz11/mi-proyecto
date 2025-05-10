<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Pagina de listado de estudiantes
    public function index()
    {
        $students = Student::all();
        return view('listado', ['students' => $students]);
    }

    // Pagina de agregar estudiantes
    public function showForm()
    {
        return view('add-student');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'email' => 'required|email|unique:students,email',
        ]);

        $student = new Student();
        $student->name = $request->input('name');
        $student->age = $request->input('age');
        $student->email = $request->input('email');
        $student->save();

        return redirect('/add-student')->with('success', 'Estudiante agregado correctamente');
    }
}
