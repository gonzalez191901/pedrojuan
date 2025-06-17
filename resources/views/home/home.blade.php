@extends('layouts.app')

@section('content')


<!-- Crear publicación -->
<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex">
            <img src="{{ asset('img/user.png') }}" alt="Usuario" width="50" height="50" class="rounded-circle mr-3">
            <div class="w-100">
                <input type="text" class="form-control" name="tittle" id="tittle" placeholder="Titulo" style="width:50%;">
                <textarea class="form-control border-0" rows="3" placeholder="¿Qué está pasando?" id="contenido"></textarea>
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
  <div class="card mb-3" style="cursor:pointer;" onclick="window.location.href='{{ route('publicaciones.publicacion', ['id' => $publi->publ_id]) }}'">
      <div class="card-body">
          <div class="d-flex">
              <img src="{{ asset('img/user.png') }}" alt="Usuario" width="50" height="50" class="rounded-circle mr-3">
              <div class="w-100">
                  <div class="d-flex justify-content-between align-items-center mb-1">
                      <div>
                          <strong>{{ $publi->user->name }}</strong>
                          <span class="text-muted ml-2">· 2h</span>
                      </div>
                      <button class="btn btn-sm text-muted"><i class="fas fa-ellipsis-h"></i></button>
                  </div>
                  <strong> {{ $publi->tittle }}</strong>
                  <p class="mb-2"> {{ $publi->publ_comentario }}</p>
                  <div class="d-flex justify-content-between text-muted mt-3">
                      <button class="btn btn-sm text-muted"><i class="far fa-comment"></i>{{$publi->comentarios->count()}}</button>
                    
                      <button class="btn btn-sm text-muted"><i class="far fa-heart"></i>{{$publi->likes->count()}}</button>
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
        var contenido = $('#contenido').val().trim();
        var tittle = $('#tittle').val().trim();
        
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

        if (tittle === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Por favor escribe un titulo',
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
                comentario: contenido,
                tittle:tittle,
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