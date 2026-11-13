<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedores::where('empresa', 'like', '%' . $request->buscar . '%')
            ->orWhere('rtn', 'like', '%' . $request->buscar . '%')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        return redirect()->route('proveedores.edit', $proveedor);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedor)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        return redirect()->route('proveedores.index')
                         ->with('success', '¡Proveedor eliminado correctamente!');
    }
}
