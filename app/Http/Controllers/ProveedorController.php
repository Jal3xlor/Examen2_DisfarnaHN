<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    // Mostrar proveedores y realizar búsquedas
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $proveedores = Proveedores::where('empresa', 'like', '%' . $buscar . '%')
            ->orWhere('rtn', 'like', '%' . $buscar . '%')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('proveedores.index', compact('proveedores'));
    }

    // Mostrar formulario de registro
    public function create()
    {
        return view('proveedores.create');
    }

    // Registrar proveedor
    public function store(Request $request)
    {
        $datos = $request->validate([
            'rtn' => 'required|digits:14|unique:proveedores,rtn',
            'empresa' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'telefono' => ['required', 'digits:8', 'regex:/^[2389]/'],
            'categoria' => 'required|in:Fármacos,Material Quirúrgico,Equipos',
            'limite_credito' => 'required|numeric|min:0',
            'dias_credito' => 'required|integer|in:15,30,45,60',
            'estado' => 'required|in:Activo,Inactivo',
            'fecha_registro' => 'required|date',
        ]);

        Proveedores::create($datos);

        return redirect()->route('proveedores.index')
                         ->with('success', '¡Proveedor registrado exitosamente!');
    }

    // Mostrar proveedor seleccionado
    public function show(Proveedores $proveedor)
    {
        return redirect()->route('proveedores.edit', $proveedor);
    }

    // Mostrar formulario de edición
    public function edit(Proveedores $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    // Actualizar proveedor
    public function update(Request $request, Proveedores $proveedor)
    {
        $datos = $request->validate([
            'rtn' => 'required|digits:14|unique:proveedores,rtn,' . $proveedor->id,
            'empresa' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'telefono' => ['required', 'digits:8', 'regex:/^[2389]/'],
            'categoria' => 'required|in:Fármacos,Material Quirúrgico,Equipos',
            'limite_credito' => 'required|numeric|min:0',
            'dias_credito' => 'required|integer|in:15,30,45,60',
            'estado' => 'required|in:Activo,Inactivo',
            'fecha_registro' => 'required|date',
        ]);

        $proveedor->update($datos);

        return redirect()->route('proveedores.index')
                         ->with('success', '¡Proveedor actualizado correctamente!');
    }

    // Eliminar proveedor
    public function destroy(Proveedores $proveedor)
    {
        $proveedor->delete();

        return redirect()->route('proveedores.index')
                         ->with('success', '¡Proveedor eliminado correctamente!');
    }
}

