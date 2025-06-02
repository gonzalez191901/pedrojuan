@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Inicio</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Para ti</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Siguiendo</button>
        </div>
    </div>
</div>

<!-- Crear publicación -->
<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex">
            <img src="https://via.placeholder.com/50" alt="Usuario" width="50" height="50" class="rounded-circle mr-3">
            <div class="w-100">
                <textarea class="form-control border-0" rows="3" placeholder="¿Qué está pasando?"></textarea>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <button class="btn btn-sm text-primary"><i class="far fa-image"></i></button>
                        <button class="btn btn-sm text-primary"><i class="fas fa-poll"></i></button>
                        <button class="btn btn-sm text-primary"><i class="far fa-smile"></i></button>
                        <button class="btn btn-sm text-primary"><i class="far fa-calendar-alt"></i></button>
                    </div>
                    <button class="btn btn-primary rounded-pill px-4">Publicar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Publicaciones -->
  @foreach(\App\Publicacione::orderBy('created_at', 'desc')->get() as $publi)
  <div class="card mb-3">
      <div class="card-body">
          <div class="d-flex">
              <img src="https://via.placeholder.com/50" alt="Usuario" width="50" height="50" class="rounded-circle mr-3">
              <div class="w-100">
                  <div class="d-flex justify-content-between align-items-center mb-1">
                      <div>
                          <strong>{{ $publi->user->name }}</strong>
                          <span class="text-muted ml-2">· 2h</span>
                      </div>
                      <button class="btn btn-sm text-muted"><i class="fas fa-ellipsis-h"></i></button>
                  </div>
                  <p class="mb-2"> {{ $publi->publ_comentario }}</p>
                  <div class="d-flex justify-content-between text-muted mt-3">
                      <button class="btn btn-sm text-muted"><i class="far fa-comment"></i> 15</button>
                      <button class="btn btn-sm text-muted"><i class="fas fa-retweet"></i> 5</button>
                      <button class="btn btn-sm text-muted"><i class="far fa-heart"></i> 32</button>
                      <button class="btn btn-sm text-muted"><i class="far fa-share-square"></i></button>
                  </div>
              </div>
          </div>
      </div>
  </div>
  @endforeach
@endsection
@section('scripts')
  <script>
    $(document).ready(function() {
    $('.btn-primary').click(function(e) {
        e.preventDefault();
        
        // Obtener el contenido del textarea
        var contenido = $('.form-control').val().trim();
        
        // Verificar que el contenido no esté vacío
        if (contenido === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Por favor escribe algo para publicar',
                confirmButtonColor: '#3085d6',
            });
            return;
        }
        
        // Enviar la solicitud AJAX
        $.ajax({
            url: '{{ route("publicaciones.store") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                comentario: contenido
            },
            success: function(response) {
                // Limpiar el textarea después de publicar
                $('.form-control').val('');
                
                // Mostrar mensaje de éxito con SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Publicación creada con éxito',
                    showConfirmButton: false,
                    timer: 1500
                });
                
                // Recargar después de 1.5 segundos
                setTimeout(() => {
                    location.reload();
                }, 1500);
            },
            error: function(xhr) {
                // Mostrar mensaje de error con SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al publicar: ' + (xhr.responseJSON?.message || 'Error desconocido'),
                    confirmButtonColor: '#d33',
                });
            }
        });
    });
});
  </script>
@endsection