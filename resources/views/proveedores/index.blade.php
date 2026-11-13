
@extends('layout.admin')

@section('titulo', 'Proveedores')

@section('contenido')

<div class="container-fluid px-0">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mt-4">Proveedores</h1>
            <p class="text-muted">Administración de laboratorios y proveedores mayoristas de DISFARMA.</p>
        </div>

        <a href="{{ route('proveedores.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Nuevo proveedor</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('proveedores.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-10 mb-2">
                        <input type="text" name="buscar" class="form-control" placeholder="Buscar por empresa o RTN..." value="{{ request('buscar') }}"/>
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
            <i class="fas fa-truck me-1"></i>
            Listado de proveedores
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>RTN</th>
                            <th>Empresa</th>
                            <th>Contacto</th>
                            <th>Teléfono</th>
                            <th>Categoría</th>
                            <th>Límite de crédito</th>
                            <th>Días de crédito</th>
                            <th>Estado</th>
                            <th>Fecha de registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($proveedores as $proveedor)
                            <tr>
                                <td>{{ $proveedor->rtn }}</td>
                                <td>{{ $proveedor->empresa }}</td>
                                <td>{{ $proveedor->contacto }}</td>
                                <td>{{ $proveedor->telefono }}</td>
                                <td>{{ $proveedor->categoria }}</td>
                                <td>L. {{ number_format($proveedor->limite_credito, 2) }}</td>
                                <td>{{ $proveedor->dias_credito }} días</td>

                                <td>
                                    @if ($proveedor->estado == 'Activo')
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-secondary">Inactivo</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($proveedor->fecha_registro)->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este proveedor?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted py-4">No se encontraron proveedores registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $proveedores->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
