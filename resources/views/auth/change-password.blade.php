@extends('layout.admin')

@section('titulo', 'Cambiar contraseña')

@section('contenido')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Actualizar contraseña</h5>
                </div>
                <div class="card-body">
                    <p>Por motivos de seguridad, debes cambiar la contraseña al iniciar sesion por primera vez</p>
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="password" class="form-label">Nueva contraseña</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required/>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required/>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Actualizar contraseña</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
