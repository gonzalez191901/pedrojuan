@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0">
                    <h4 class="mb-0">Verifica tu número de teléfono</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        Hemos enviado un código de verificación al número <strong>{{ auth()->user()->telefono }}</strong>.
                        Por favor ingresa el código a continuación.
                    </p>

                    <form method="POST" action="{{ route('phone.verify') }}">
                        @csrf

                        <div class="form-group">
                            <label for="code" class="col-form-label">Código de verificación</label>
                            <input id="code" type="text" class="form-control rounded-pill py-3 @error('code') is-invalid @enderror" name="code" required autofocus>
                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block rounded-pill py-2 font-weight-bold">
                                Verificar teléfono
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <form method="POST" action="{{ route('phone.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link">
                                No recibí el código, reenviar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
