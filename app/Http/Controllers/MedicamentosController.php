<?php

namespace App\Http\Controllers;

use App\Models\Medicamentos;
use Illuminate\Http\Request;

class MedicamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicamentos = Medicamentos::where('nombre', 'like', '%' . $request->buscar . '%')
            ->orWhere('codigo', 'like', '%' . $request->buscar . '%')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('medicamentos.index', compact('medicamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medicamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo'=>'required|string|max:255|unique:medicamentos,codigo',
            'nombre'=>'required|string|max:255',
            'categoria'=>'required|in:Antibióticos,Analgésicos,Sueros,Material Quirúrgico,Vitaminas',
            'precio'=>'required|numeric|min:0.01',
            'costo'=>'required|numeric|min:0',
            'inventario'=>'required|integer|min:0',
            'imagen'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'laboratorio'=>'required|string|max:255',
            'fecha_vencimiento'=>'required|date',
            'fecha_registro'=>'required|date',
            'numero_lote'=>'required|string|max:255',
        ]);

        if ($request->hasFile('imagen')) {
            $ruta = public_path('uploads/medicamentos');

            if (!file_exists($ruta)) {
                mkdir($ruta, 0777, true);
            }

            $nombreImagen = uniqid() . '.' . $request->file('imagen')->extension();

            $request->file('imagen')->move($ruta, $nombreImagen);

            $datos['imagen'] = 'uploads/medicamentos/' . $nombreImagen;
        }

        Medicamentos::create($datos);

        return redirect()->route('medicamentos.index')
                         ->with('success', '¡Medicamento registrado exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicamentos $medicamentos)
    {
        return redirect()->route('medicamentos.edit', $medicamento);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicamentos $medicamentos)
    {
        return view('medicamentos.edit', compact('medicamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicamentos $medicamentos)
    {
        $datos = $request->validate([
            'codigo' => 'required|string|max:255|unique:medicamentos,codigo,' . $medicamento->id,
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|in:Antibióticos,Analgésicos,Sueros,Material Quirúrgico,Vitaminas',
            'precio' => 'required|numeric|min:0.01',
            'costo' => 'required|numeric|min:0',
            'inventario' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'laboratorio' => 'required|string|max:255',
            'fecha_vencimiento' => 'required|date',
            'fecha_registro' => 'required|date',
            'numero_lote' => 'required|string|max:255',
        ]);

        if ($request->hasFile('imagen')) {
            $ruta = public_path('uploads/medicamentos');

            if (!file_exists($ruta)) {
                mkdir($ruta, 0777, true);
            }

            $nombreImagen = uniqid() . '.' . $request->file('imagen')->extension();

            $request->file('imagen')->move($ruta, $nombreImagen);

            if ($medicamento->imagen && file_exists(public_path($medicamento->imagen))) {
                unlink(public_path($medicamento->imagen));
            }

            $datos['imagen'] = 'uploads/medicamentos/' . $nombreImagen;
        } else {
            unset($datos['imagen']);
        }

        $medicamento->update($datos);

        return redirect()->route('medicamentos.index')
                         ->with('success', '¡Medicamento actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicamentos $medicamentos)
    {
        if ($medicamento->imagen && file_exists(public_path($medicamento->imagen))) {
            unlink(public_path($medicamento->imagen));
        }

        $medicamento->delete();

        return redirect()->route('medicamentos.index')
                         ->with('success', '¡Medicamento eliminado correctamente!');
    }
}
