@extends('layout.admin')

@section('titulo', 'Editar proveedor')

@section('contenido')

<div class="container-fluid px-0">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mt-4">Editar proveedor</h1>
            <p class="text-muted">Modifique la información de la empresa proveedora.</p>
        </div>
        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Volver</a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Información del proveedor
        </div>
        <div class="card-body">
            <form action="{{ route('proveedores.update', $proveedor) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="rtn" class="form-label">RTN</label>
                        <input type="text" name="rtn" id="rtn" class="form-control @error('rtn') is-invalid @enderror" value="{{ old('rtn', $proveedor->rtn) }}" maxlength="14" required />
                        <div class="form-text">Debe contener exactamente 14 dígitos.</div>
                        @error('rtn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="empresa" class="form-label">Nombre de la empresa</label>
                        <input type="text" name="empresa" id="empresa" class="form-control @error('empresa') is-invalid @enderror" value="{{ old('empresa', $proveedor->empresa) }}" required />
                        @error('empresa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="contacto" class="form-label">Persona de contacto</label>
                        <input type="text" name="contacto" id="contacto" class="form-control @error('contacto') is-invalid @enderror" value="{{ old('contacto', $proveedor->contacto) }}" required />
                        @error('contacto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $proveedor->telefono) }}" maxlength="8" required />
                        <div class="form-text">Deben ser 8 dígitos y comenzar con 2, 3, 8 o 9.</div>
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="categoria" class="form-label">Categoría de suministro</label>
                        <select name="categoria" id="categoria" class="form-select @error('categoria') is-invalid @enderror" required>
                            <option value="">Seleccione una categoría</option>
                            <option value="Fármacos" {{ old('categoria', $proveedor->categoria) == 'Fármacos' ? 'selected' : '' }}>Fármacos</option>
                            <option value="Material Quirúrgico" {{ old('categoria', $proveedor->categoria) == 'Material Quirúrgico' ? 'selected' : '' }}>Material Quirúrgico</option>
                            <option value="Equipos" {{ old('categoria', $proveedor->categoria) == 'Equipos' ? 'selected' : '' }}>Equipos</option>
                        </select>
                        @error('categoria')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="limite_credito" class="form-label">Límite de crédito (L.)</label>
                        <input type="number" name="limite_credito" id="limite_credito" class="form-control @error('limite_credito') is-invalid @enderror" value="{{ old('limite_credito', $proveedor->limite_credito) }}" min="0" step="0.01" required />
                        @error('limite_credito')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="dias_credito" class="form-label">Días de crédito</label>
                        <select name="dias_credito" id="dias_credito" class="form-select @error('dias_credito') is-invalid @enderror" required>
                            <option value="">Seleccione los días de crédito</option>
                            <option value="15" {{ old('dias_credito', $proveedor->dias_credito) == '15' ? 'selected' : '' }}>15 días</option>
                            <option value="30" {{ old('dias_credito', $proveedor->dias_credito) == '30' ? 'selected' : '' }}>30 días</option>
                            <option value="45" {{ old('dias_credito', $proveedor->dias_credito) == '45' ? 'selected' : '' }}>45 días</option>
                            <option value="60" {{ old('dias_credito', $proveedor->dias_credito) == '60' ? 'selected' : '' }}>60 días</option>
                        </select>
                        @error('dias_credito')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="estado" class="form-label">Estado del proveedor</label>
                        <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror" required>
                            <option value="Activo" {{ old('estado', $proveedor->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('estado', $proveedor->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fecha_registro" class="form-label">Fecha de registro</label>
                        <input type="date" name="fecha_registro" id="fecha_registro" class="form-control @error('fecha_registro') is-invalid @enderror" value="{{ old('fecha_registro', $proveedor->fecha_registro) }}" required />
                        @error('fecha_registro')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
