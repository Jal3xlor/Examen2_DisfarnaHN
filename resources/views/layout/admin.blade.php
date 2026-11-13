
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('titulo', 'Dashboard') - DISFARMA Honduras</title>
    <link href="{{ asset('sb-admin/css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="{{ route('dashboard') }}">
            DISFARMA Honduras
        </a>

        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <ul class="navbar-nav ms-auto me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user fa-fw me-1"></i>
                    {{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">

        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">

                    <div class="text-center py-4">
                        <img
                            src="{{ asset('sb-admin/assets/img/logo-disfarma.png') }}"
                            alt="Logo DISFARMA Honduras"
                            class="img-fluid"
                            style="max-width: 160px; max-height: 90px;"
                        />
                        <div class="text-white fw-bold mt-2">DISFARMA Honduras</div>
                        <small class="text-white-50">Sistema de Gestión Interna</small>
                    </div>

                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Principal</div>

                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <div class="sb-sidenav-menu-heading">Gestión Farmacéutica</div>

                        <a class="nav-link {{ request()->routeIs('medicamentos.*') ? 'active' : '' }}" href="{{ route('medicamentos.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-capsules"></i></div>
                            Medicamentos
                        </a>

                        <a class="nav-link {{ request()->routeIs('proveedores.*') ? 'active' : '' }}" href="{{ route('proveedores.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                            Proveedores
                        </a>

                        <div class="sb-sidenav-menu-heading">Recursos Humanos</div>

                        <a class="nav-link {{ request()->routeIs('empleados.*') ? 'active' : '' }}" href="{{ route('empleados.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Empleados
                        </a>
                    </div>
                </div>

                <div class="sb-sidenav-footer">
                    <div class="small">Conectado como:</div>
                    {{ auth()->user()->name }}
                    <div class="small mt-1">{{ auth()->user()->rol }}</div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mt-4">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('contenido')

                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <h6 class="fw-bold">DISFARMA Honduras</h6>
                            <p class="small mb-1">Droguería y Distribuidora Farmacéutica San Rafael S. de R.L</p>
                            <p class="small text-muted mb-0">Distribución mayorista de medicamentos, insumos médico-quirúrgicos y material hospitalario</p>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <h6 class="fw-bold">Nuestras sucursales</h6>
                            <p class="small mb-1"><i class="fas fa-map-marker-alt me-2"></i>Bulevar Suyapa, Tegucigalpa</p>
                            <p class="small mb-0"><i class="fas fa-map-marker-alt me-2"></i>Bulevar del Norte, San Pedro Sula</p>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <h6 class="fw-bold">Contacto y redes sociales</h6>
                            <p class="small mb-1"><i class="fas fa-phone me-2"></i>Teléfonos: +504 2220-2222</p>
                            <p class="small mb-2"><i class="fas fa-envelope me-2"></i>disfarmahn@disfarma.h</p>
                            <a href="" class="text-dark me-3" title="Facebook"><i class="fab fa-facebook fa-lg"></i></a>
                            <a href="" class="text-dark me-3" title="Instagram"><i class="fab fa-instagram fa-lg"></i></a>
                            <a href="" class="text-dark" title="WhatsApp"><i class="fab fa-whatsapp fa-lg"></i></a>
                        </div>
                    </div>
                    <hr />
                    <div class="text-center small text-muted">
                        &copy; {{ date('Y') }} DISFARMA Honduras. Todos los derechos reservados.
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('sb-admin/js/scripts.js') }}"></script>
</body>
</html>