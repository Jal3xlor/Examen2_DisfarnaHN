
@extends('layout.admin')

@section('titulo', 'Medicamentos')

@section('contenido')

<div class="container-fluid px-0">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mt-4">Medicamentos</h1>
            <p class="text-muted">Administración de medicamentos</p>
        </div>
        <a href="{{ route('medicamentos.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Nuevo medicamento</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('medicamentos.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-10 mb-2">
                        <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre o código..." value="{{ request('buscar') }}"/>
                    </div>

                    <div class="col-md-2 mb-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search me-1"></i> Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-capsules me-1"></i>Listado de medicamentos
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Imagen</th>
                            <th>Código</th>
                            <th>Medicamento</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Inventario</th>
                            <th>Laboratorio</th>
                            <th>Vencimiento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($medicamentos as $medicamento)
                            <tr>
                                <td class="text-center">
                                    @if ($medicamento->imagen)
                                        <img
                                            src="{{ asset($medicamento->imagen) }}"
                                            alt="{{ $medicamento->nombre }}"
                                            style="width: 55px; height: 55px; object-fit: contain;"
                                        />
                                    @else
                                        <i class="fas fa-pills fa-2x text-secondary"></i>
                                    @endif
                                </td>

                                <td>{{ $medicamento->codigo }}</td>
                                <td>{{ $medicamento->nombre }}</td>
                                <td>{{ $medicamento->categoria }}</td>
                                <td>L. {{ number_format($medicamento->precio, 2) }}</td>

                                <td>
                                    @if ($medicamento->inventario > 20)
                                        <span class="badge bg-success">Optimo</span>
                                    @elseif ($medicamento->inventario >= 10)
                                        <span class="badge bg-warning text-dark">Moderado</span>
                                    @else
                                        <span class="badge bg-danger">Desabastecido!</span>
                                    @endif

                                    <div class="small text-muted mt-1">
                                        {{ $medicamento->inventario }} unidades
                                    </div>
                                </td>
                                <td>{{ $medicamento->laboratorio }}</td>
                                <td>{{ \Carbon\Carbon::parse($medicamento->fecha_vencimiento)->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('medicamentos.edit', $medicamento) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('medicamentos.destroy', $medicamento) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este medicamento?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">No se encontraron medicamentos registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-3">{{$medicamentos->links()}}</div>
        </div>
    </div>

</div>

@endsection
