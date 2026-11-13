@extends('layout.admin')

@section('titulo', 'Empleados')

@section('contenido')

<div class="container-fluid px-0">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mt-4">Empleados</h1>
            <p class="text-muted">Administración de empleados de DISFARMA (RRHH ;D)</p>
        </div>
        <a href="{{ route('empleados.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Nuevo empleado</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('empleados.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-10 mb-2">
                        <input type="text" name="buscar" class="form-control" placeholder="Buscar por identidad, nombre o correo..." value="{{ request('buscar') }}"/>
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
            <i class="fas fa-users me-1"></i>
            Listado de empleados
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Identidad</th>
                            <th>Nombre completo</th>
                            <th>Correo</th>
                            <th>Cargo</th>
                            <th>Salario</th>
                            <th>Fecha de ingreso</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->identidad }}</td>
                                <td>{{ $empleado->nombre }} {{ $empleado->apellido }}</td>
                                <td>{{ $empleado->correo }}</td>
                                <td><span class="badge bg-info text-dark">{{ $empleado->cargo }}</span></td>
                                <td>L. {{ number_format($empleado->salario, 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('d/m/Y') }}</td>
                                <td>
                                    @if ($empleado->estado == 'Activo')
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-secondary">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este empleado?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No se encontraron empleados registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $empleados->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
