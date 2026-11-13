
@extends('layout.admin')

@section('titulo', 'Registrar medicamento')

@section('contenido')

<div class="container-fluid px-0">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mt-4">Registrar medicamento</h1>
            <p class="text-muted">Ingrese la información del nuevo medicamento.</p>
        </div>

        <a href="{{ route('medicamentos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-capsules me-1"></i>Información del medicamento
        </div>
        <div class="card-body">
            <form action="{{ route('medicamentos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="codigo" class="form-label">Código SKU</label>
                        <input type="text" name="codigo" id="codigo" class="form-control @error('codigo') is-invalid @enderror" value="{{ old('codigo') }}" required />
                        @error('codigo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre del medicamento</label>
                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required />
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="categoria" class="form-label">Categoría</label>
                        <select name="categoria" id="categoria" class="form-select @error('categoria') is-invalid @enderror" required>
                            <option value="">Seleccione una categoría</option>
                            <option value="Antibióticos" {{ old('categoria') == 'Antibióticos' ? 'selected' : '' }}>Antibióticos</option>
                            <option value="Analgésicos" {{ old('categoria') == 'Analgésicos' ? 'selected' : '' }}>Analgésicos</option>
                            <option value="Sueros" {{ old('categoria') == 'Sueros' ? 'selected' : '' }}>Sueros</option>
                            <option value="Material Quirúrgico" {{ old('categoria') == 'Material Quirúrgico' ? 'selected' : '' }}>Material Quirúrgico</option>
                            <option value="Vitaminas" {{ old('categoria') == 'Vitaminas' ? 'selected' : '' }}>Vitaminas</option>
                        </select>
                        @error('categoria')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="precio" class="form-label">Precio de venta (L.)</label>
                        <input type="number" step="0.01" min="0.01" name="precio" id="precio" class="form-control @error('precio') is-invalid @enderror" value="{{ old('precio') }}" required />
                        @error('precio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="costo" class="form-label">Costo (L.)</label>
                        <input type="number" step="0.01" min="0" name="costo" id="costo" class="form-control @error('costo') is-invalid @enderror" value="{{ old('costo') }}" required />
                        @error('costo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="inventario" class="form-label">Cantidad en inventario</label>
                        <input type="number" min="0" name="inventario" id="inventario" class="form-control @error('inventario') is-invalid @enderror" value="{{ old('inventario') }}" required />
                        @error('inventario')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="laboratorio" class="form-label">Laboratorio</label>
                        <input type="text" name="laboratorio" id="laboratorio" class="form-control @error('laboratorio') is-invalid @enderror" value="{{ old('laboratorio') }}" required />
                        @error('laboratorio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="numero_lote" class="form-label">Número de lote</label>
                        <input type="text" name="numero_lote" id="numero_lote" class="form-control @error('numero_lote') is-invalid @enderror" value="{{ old('numero_lote') }}" required />
                        @error('numero_lote')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento</label>
                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control @error('fecha_vencimiento') is-invalid @enderror" value="{{ old('fecha_vencimiento') }}" required />
                        @error('fecha_vencimiento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fecha_registro" class="form-label">Fecha de registro</label>
                        <input type="date" name="fecha_registro" id="fecha_registro" class="form-control @error('fecha_registro') is-invalid @enderror" value="{{ old('fecha_registro', date('Y-m-d')) }}" required />
                        @error('fecha_registro')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="imagen" class="form-label">Imagen del medicamento</label>
                        <input type="file" name="imagen" id="imagen" class="form-control @error('imagen') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp" />
                        <div class="form-text">Formatos permitidos: JPG, JPEG, PNG y WEBP y Tamaño máximo: 5 MB.</div>
                        @error('imagen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('medicamentos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Registrar medicamento</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
