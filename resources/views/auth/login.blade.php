<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Iniciar Sesión - DISFARMA Honduras</title>
    <link href="{{asset('sb-admin/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">

    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">

                            <div class="card shadow-lg border-0 rounded-lg mt-5">

                                <div class="card-header bg-dark text-white text-center py-4">
                                    <h3 class="font-weight-light my-2"><i class="fas fa-capsules text-warning me-2"></i>DISFARMA Honduras</h3>
                                    <small class="text-light">Sistema de Gestión Interna</small>
                                </div>

                                <div class="card-body p-4">
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <i class="fas fa-exclamation-circle me-1"></i>Verifique los datos ingresados.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                    @endif

                                    <form action="{{ route('login.post') }}" method="POST">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('email') is-invalid @enderror" id="inputEmail" type="email" name="email" value="{{ old('email') }}" placeholder="usuario@disfarma.hn" required autofocus/>
                                            <label for="inputEmail"><i class="fas fa-envelope me-1"></i>Correo Institucional</label>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('password') is-invalid @enderror" id="inputPassword" type="password" name="password" placeholder="Contraseña" required/>
                                            <label for="inputPassword"><i class="fas fa-lock me-1"></i>Contraseña </label>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" value="1"/>
                                            <label class="form-check-label" for="remember">Recordar mi sesión</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-sign-in-alt me-1"></i>Ingresar</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="card-footer text-center py-3 bg-light">
                                    <div class="small text-muted">Plataforma de Gestión Empresarial<br>
                                        Droguería y Distribuidora Farmacéutica San Rafael S. de R.L.
                                        derechos reservados ;D
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('sb-admin/js/scripts.js') }}"></script>

</body>
</html>