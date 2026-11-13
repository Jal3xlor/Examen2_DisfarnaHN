<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    // Mostrar empleados y realizar búsquedas
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $empleados = Empleado::where('identidad', 'like', '%' . $buscar . '%')
            ->orWhere('nombre', 'like', '%' . $buscar . '%')
            ->orWhere('apellido', 'like', '%' . $buscar . '%')
            ->orWhere('correo', 'like', '%' . $buscar . '%')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('empleados.index', compact('empleados'));
    }

    // Mostrar formulario de registro
    public function create()
    {
        return view('empleados.create');
    }

    // Registrar empleado
    public function store(Request $request)
    {
        $datos = $request->validate([
            'identidad' => 'required|digits:13|unique:empleados,identidad',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|unique:empleados,correo',
            'cargo' => 'required|in:Regente Farmacéutico,Asistente de Farmacia,Jefe de Bodega,Despachador,Cajero',
            'salario' => 'required|numeric|min:0.01',
            'fecha_ingreso' => 'required|date',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        Empleado::create($datos);

        return redirect()->route('empleados.index')
                         ->with('success', '¡Empleado registrado exitosamente!');
    }

    // Mostrar empleado seleccionado
    public function show(Empleado $empleado)
    {
        return redirect()->route('empleados.edit', $empleado);
    }

    // Mostrar formulario de edición
    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    // Actualizar empleado
    public function update(Request $request, Empleado $empleado)
    {
        $datos = $request->validate([
            'identidad' => 'required|digits:13|unique:empleados,identidad,' . $empleado->id,
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|unique:empleados,correo,' . $empleado->id,
            'cargo' => 'required|in:Regente Farmacéutico,Asistente de Farmacia,Jefe de Bodega,Despachador,Cajero',
            'salario' => 'required|numeric|min:0.01',
            'fecha_ingreso' => 'required|date',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        $empleado->update($datos);

        return redirect()->route('empleados.index')
                         ->with('success', '¡Empleado actualizado correctamente!');
    }

    // Eliminar empleado
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()->route('empleados.index')
                         ->with('success', '¡Empleado eliminado correctamente!');
    }
}
