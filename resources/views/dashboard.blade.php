@extends('layout.admin')

@section('titulo', 'Dashboard')

@section('contenido')

<div class="container-fluid px-4">

    <h1 class="mt-4">Dashboard</h1>
    <p>Panel de control gerencial de DISFARMA Honduras.</p>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-primary border-4 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-primary text-uppercase mb-2">
                        Total de medicamentos
                    </div>
                    <h2 class="mb-0">{{ $totalMedicamentos }}</h2>
                    <div class="text-muted small mt-2">
                        Medicamentos registrados en el catálogo
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('medicamentos.index') }}" class="text-primary text-decoration-none">Ver medicamentos <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-success border-4 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-success text-uppercase mb-2">
                        Proveedores activos
                    </div>
                    <h2 class="mb-0">{{ $proveedoresActivos }}</h2>
                    <div class="text-muted small mt-2">
                        Laboratorios y proveedores activos
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('proveedores.index') }}" class="text-success text-decoration-none">Ver proveedores <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-warning border-4 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-warning text-uppercase mb-2">
                        Empleados en nómina
                    </div>
                    <h2 class="mb-0">{{ $totalEmpleados }}</h2>
                    <div class="text-muted small mt-2">
                        Colaboradores con estado activo
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('empleados.index') }}" class="text-warning text-decoration-none">Ver empleados <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-info border-4 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-info text-uppercase mb-2">
                        Valor del inventario
                    </div>
                    <h2 class="mb-0">L. {{ number_format((float) $valorInventario, 2) }}</h2>
                    <div class="text-muted small mt-2">
                        <p>Existencias multiplicadas por precio</p>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('medicamentos.index') }}" class="text-info text-decoration-none">Consultar inventario <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <i class="fas fa-chart-line me-1"></i>Información general
        </div>
        <div class="card-body">Bienvenido al sistema de gestión interna de DISFARMA HondurasD, aqui puedes consultar los indicadores principales y acceder a los módulos de medicamentos, proveedores y empleados</div>
    </div>

</div>
@endsection

