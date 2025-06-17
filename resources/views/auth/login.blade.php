@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <img src="{{ asset('img/Logo_IAEDPG.png') }}" alt="Usuario" width="150" height="150" class="text-center">    
                        <i class="fab fa-x-twitter text-primary fa-3x"></i>
                        <h2 class="mt-3 font-weight-bold">Inicia sesión en el Foro de IAEDPG </h2>
                    </div>

                    <!-- Formulario de login -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <input id="login" type="text" class="form-control rounded-pill py-3 @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus placeholder="Correo, usuario o teléfono">
                            @error('login')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control rounded-pill py-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-muted" for="remember">
                                    Recordarme
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-primary" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>

                        <div class="form-group mb-4">
                            <button type="submit" class="btn btn-primary btn-block rounded-pill py-2 font-weight-bold">
                                Iniciar sesión
                            </button>
                        </div>
                    </form>

                    <!-- Divisor -->
                    <div class="d-flex align-items-center my-4">
                        <div class="flex-grow-1 bg-secondary" style="height: 1px;"></div>
                        <div class="px-3 text-muted">o</div>
                        <div class="flex-grow-1 bg-secondary" style="height: 1px;"></div>
                    </div>

                    <!-- Botones de redes sociales -->
                    <!--<div class="social-login">
                        <a href="{{ url('/auth/facebook') }}" class="btn btn-outline-primary rounded-pill py-2 mb-3 btn-block">
                            <i class="fab fa-facebook-f mr-2"></i> Continuar con Facebook
                        </a>
                        
                        <a href="{{ url('/auth/google') }}" class="btn btn-outline-danger rounded-pill py-2 mb-3 btn-block">
                            <i class="fab fa-google mr-2"></i> Continuar con Google
                        </a>
                        
                        <a href="{{ url('/auth/instagram') }}" class="btn btn-outline-dark rounded-pill py-2 mb-3 btn-block">
                            <i class="fab fa-instagram mr-2"></i> Continuar con Instagram
                        </a>
                    </div>-->

                    <!-- Enlace a registro -->
                    <div class="text-center mt-4">
                        <p class="text-muted">¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-primary">Regístrate</a></p>
                    </div>
                </div>
            </div>

            <!-- Términos y condiciones -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    Al iniciar sesión, aceptas los <a href="#" class="text-primary">Términos de servicio</a> y la <a href="#" class="text-primary">Política de privacidad</a>, incluida la política de <a href="#" class="text-primary">Uso de Cookies</a>.
                </small>
            </div>
        </div>
    </div>
</div>
@endsection