@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <i class="fab fa-x-twitter text-primary fa-3x"></i>
                        <h2 class="mt-3 font-weight-bold">Únete a nuestra comunidad</h2>
                    </div>

                    <!-- Formulario de registro -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input id="nombre" type="text" class="form-control rounded-pill py-3 @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="given-name" placeholder="Nombre">
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <input id="apellido" type="text" class="form-control rounded-pill py-3 @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" required autocomplete="family-name" placeholder="Apellido">
                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <input id="username" type="username" class="form-control rounded-pill py-3 @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required placeholder="Username">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="email" type="email" class="form-control rounded-pill py-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo electrónico">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="telefono" type="tel" class="form-control rounded-pill py-3 @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required autocomplete="tel" placeholder="Número de teléfono">
                            @error('telefono')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fecha_nacimiento" class="text-muted small ml-3">Fecha de nacimiento</label>
                            <input id="fecha_nacimiento" type="date" class="form-control rounded-pill py-3 @error('fecha_nacimiento') is-invalid @enderror" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                            @error('fecha_nacimiento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select id="carrera" class="form-control rounded-pill py-3 @error('carrera') is-invalid @enderror" name="carrera" required>
                                <option value="" disabled selected>Selecciona tu carrera</option>
                                @foreach(\App\Carrera::all() as $car)
                                <option value="{{$car->carr_id}}">{{$car->carr_descripcion}}</option>
                                @endforeach
                           
                            </select>
                            @error('carrera')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control rounded-pill py-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control rounded-pill py-3" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar contraseña">
                        </div>

                        <div class="form-group mb-4">
                            <button type="submit" class="btn btn-primary btn-block rounded-pill py-2 font-weight-bold">
                                Registrarse
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

                    <!-- Enlace a login -->
                    <div class="text-center mt-4">
                        <p class="text-muted">¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-primary">Inicia sesión</a></p>
                    </div>
                </div>
            </div>

            <!-- Términos y condiciones -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    Al registrarte, aceptas los <a href="#" class="text-primary">Términos de servicio</a> y la <a href="#" class="text-primary">Política de privacidad</a>, incluida la política de <a href="#" class="text-primary">Uso de Cookies</a>.
                </small>
            </div>
        </div>
    </div>
</div>
@endsection