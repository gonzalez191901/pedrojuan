@extends('layouts.app') <!-- Asumiendo que tu plantilla se llama app.blade.php -->

@section('content')

<div class="container">
    <!-- Publicación Principal -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="d-flex align-items-start mb-3">
                <img src="@if($publicacion->user->photo != '') {{asset('profile/photos/'.$publicacion->user->photo)}} @else {{asset('img/user.png')}} @endif" alt="Usuario" width="50" height="50" class="rounded-circle mr-3">
                <div>
                    <h5 class="mb-1">{{ $publicacion->user->username }}</h5>
                    <small class="text-muted">{{ $publicacion->created_at->diffForHumans() }}</small>
                </div>
            </div>
            
            <h4 class="card-title">{{ $publicacion->tittle }}</h4>
            <p class="card-text">{{ $publicacion->publ_comentario }}</p>

            <div class="content_publi_img">
                        @foreach($publicacion->publi_img as $img_publ)
                        <img src="{{asset('publicaciones/imagenes/'.$img_publ->photo)}}" alt="" class="photo_publ">
                        @endforeach
                    </div>
        
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="dar_like({{$publicacion->publ_id}})">
                        <i class="far fa-heart"></i> Me gusta <span id="contador_likes">{{ $publicacion->likes->count() }}</span> 
                    </button>
                    
                </div>
                @if(auth()->id() == $publicacion->user_id)
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('publicaciones.edit', $publicacion->id) }}">Editar</a>
                        <a class="dropdown-item text-danger" href="#" onclick="confirmarEliminacion({{ $publicacion->id }})">Eliminar</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Formulario para nuevo comentario -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form action="{{ route('comentario.create') }}" method="POST">
                @csrf
                <input type="hidden" name="publicacion_id" value="{{ $publicacion->publ_id }}" required="">
                <div class="form-group">
                    <textarea class="form-control" name="contenido" rows="3" placeholder="Escribe tu comentario..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Comentar</button>
            </form>
        </div>
    </div>

    <!-- Lista de Comentarios -->
    <div class="mb-4">
        <h5 class="mb-3">Comentarios  <span id="contador_comentario">{{ $publicacion->comentarios->count() }}</span></h5>
        
        
        @forelse($publicacion->comentarios->sortByDesc('created_at') as $comentario)
        <div class="card mb-3 shadow-sm" id="div_comentario_{{$comentario->come_id}}">
            <div class="card-body">
                <div class="d-flex align-items-start mb-2">
                    <img src="@if($comentario->user->photo != '') {{asset('profile/photos/'.$comentario->user->photo)}} @else {{asset('img/user.png')}} @endif" alt="Usuario" width="50" height="50" class="rounded-circle mr-3">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">{{ $comentario->user->username }}</h6>
                            <small class="text-muted">{{ $comentario->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-2 mt-2">{{ $comentario->come_comentario }}</p>
                        
                        <div class="d-flex">
                            <button class="btn btn-sm btn-outline-secondary mr-2" onclick="like_comentario({{ $comentario->come_id }})" >
                               <i class="far fa-heart"></i> <span id="comentario_{{$comentario->come_id}}">{{$comentario->likes->count()}}</span>
                            </button>
                            @if(auth()->id() == $comentario->come_id_user)
                            <form action="" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmarEliminacion({{$comentario->come_id}})">Eliminar</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="alert alert-info">No hay comentarios aún. ¡Sé el primero en comentar!</div>
        @endforelse
        
         
    </div>
</div>
@endsection

@section('scripts')
<script>
    function confirmarEliminacion(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar formulario de eliminación
                $.ajax({
                    type: "POST",
                    url: "{{ route('comentario.delete') }}",
                    data: { 
                        id: id,
                        _token: "{{ csrf_token() }}"  // Opcional si ya usas $.ajaxSetup
                    },
                    success: function (data) {
                        console.log(data);
                         $("#div_comentario_"+id).hide();
                         let contador = parseInt($("#contador_comentario").text());
                         $("#contador_comentario").html(contador - 1);
                        
                    },
                    error: function (jQXHR, textStatus, errorMessage) {
                        console.log("Error:", jQXHR.responseJSON); // Mejor manejo de errores
                    }
                });
            }
        });
    }

    function dar_like(id){
    

       $.ajax({
            type: "POST",
            url: "{{ route('like.add') }}",
            data: { 
                id: id,
                _token: "{{ csrf_token() }}"  // Opcional si ya usas $.ajaxSetup
            },
            success: function (data) {
                console.log(data);
                $("#contador_likes").html(data.length);
            },
            error: function (jQXHR, textStatus, errorMessage) {
                console.log("Error:", jQXHR.responseJSON); // Mejor manejo de errores
            }
        });
        
    }

    function like_comentario(id){
        $.ajax({
            type: "POST",
            url: "{{ route('like.add.comentario') }}",
            data: { 
                id: id,
                _token: "{{ csrf_token() }}"  // Opcional si ya usas $.ajaxSetup
            },
            success: function (data) {
                console.log(data);
                $("#comentario_"+id).html(data.length);
            },
            error: function (jQXHR, textStatus, errorMessage) {
                console.log("Error:", jQXHR.responseJSON); // Mejor manejo de errores
            }
        });
    }

    $(document).ready(function() {
    // Selecciona todos los textarea o usa un ID específico
    $('textarea').on('input', function() {
        // Obtiene el valor actual
        let value = $(this).val();
        
        // Elimina espacios al principio
        value = value.replace(/^\s+/, '');
        
        // Reemplaza múltiples espacios por uno solo (opcional)
        value = value.replace(/\s+/g, ' ');
        
        // Actualiza el valor del textarea
        $(this).val(value);
    });
});
</script>
@endsection