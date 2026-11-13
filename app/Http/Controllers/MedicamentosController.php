<?php

namespace App\Http\Controllers;

use App\Models\Medicamentos;
use Illuminate\Http\Request;

class MedicamentosController extends Controller
{
    // Mostrar medicamentos y realizar búsquedas
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $medicamentos = Medicamentos::where('nombre', 'like', '%' . $buscar . '%')
            ->orWhere('codigo', 'like', '%' . $buscar . '%')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('medicamentos.index', compact('medicamentos'));
    }

    // Mostrar formulario de registro
    public function create()
    {
        return view('medicamentos.create');
    }

    // Registrar medicamento
    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo' => 'required|string|max:255|unique:medicamentos,codigo',
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

            $datos['imagen'] = 'uploads/medicamentos/' . $nombreImagen;
        }

        Medicamentos::create($datos);

        return redirect()->route('medicamentos.index')
                         ->with('success', '¡Medicamento registrado exitosamente!');
    }

    // Mostrar medicamento seleccionado
    public function show(Medicamentos $medicamento)
    {
        return redirect()->route('medicamentos.edit', $medicamento);
    }

    // Mostrar formulario de edición
    public function edit(Medicamentos $medicamento)
    {
        return view('medicamentos.edit', compact('medicamento'));
    }

    // Actualizar medicamento
    public function update(Request $request, Medicamentos $medicamento)
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

    // Eliminar medicamento
    public function destroy(Medicamentos $medicamento)
    {
        if ($medicamento->imagen && file_exists(public_path($medicamento->imagen))) {
            unlink(public_path($medicamento->imagen));
        }

        $medicamento->delete();

        return redirect()->route('medicamentos.index')
                         ->with('success', '¡Medicamento eliminado correctamente!');
    }
}

