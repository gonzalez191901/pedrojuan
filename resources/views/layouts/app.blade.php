<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Microblog') }}</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    
    <!-- CSS personalizado -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar izquierdo -->
            <div class="col-md-2 col-lg-2 d-none d-md-block bg-dark sidebar vh-100 sticky-top">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item mb-4">
                            <a class="nav-link text-white" href="#">
                                <i class="fab fa-x-twitter fa-2x"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white active" href="#">
                                <i class="fas fa-home mr-2"></i> Inicio
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">
                                <i class="fas fa-bell mr-2"></i> Notificaciones
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link text-white" href="profile/trytrytr">
                                <i class="fas fa-user mr-2"></i> Perfil
                            </a>
                        </li>
                        
                    </ul>
                    
                    <button class="btn btn-primary btn-block rounded-pill mt-3">Publicar</button>
                    
                    <div class="dropdown mt-5">
                        <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" href="#" id="dropdownUser1" data-toggle="dropdown" aria-expanded="false">
                            <img src="https://via.placeholder.com/40" alt="Usuario" width="32" height="32" class="rounded-circle mr-2">
                            <strong>Usuario</strong>
                        </a>
                        <div class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <a class="dropdown-item" href="#">Perfil</a>
                            <a class="dropdown-item" href="#">Configuración</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Cerrar sesión</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contenido principal -->
       
            <main role="main" class="col-md-10 col-lg-10 ml-sm-auto px-md-4 py-4">
                @yield('content')
            </main>
            
            
        </div>
    </div>

  

     <!-- jQuery primero -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @yield('scripts')
</body>
</html>