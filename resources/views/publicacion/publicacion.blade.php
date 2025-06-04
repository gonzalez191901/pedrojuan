@extends('layouts.app') <!-- Asumiendo que tu plantilla se llama app.blade.php -->

@section('content')

<div class="container">
    <!-- Publicación Principal -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="d-flex align-items-start mb-3">
                <img src="https://via.placeholder.com/50" alt="Autor" class="rounded-circle mr-3">
                <div>
                    <h5 class="mb-1">{{ $publicacion->user->name }}</h5>
                    <small class="text-muted">{{ $publicacion->created_at->diffForHumans() }}</small>
                </div>
            </div>
            
            <h4 class="card-title">{{ $publicacion->titulo }}</h4>
            <p class="card-text">{{ $publicacion->contenido }}</p>
            
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">
                        <i class="far fa-thumbs-up"></i> Me gusta ({{ $publicacion->likes_count }})
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">
                        <i class="far fa-comment"></i> Comentar
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-share"></i> Compartir
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
                <input type="hidden" name="publicacion_id" value="{{ $publicacion->publ_id }}">
                <div class="form-group">
                    <textarea class="form-control" name="contenido" rows="3" placeholder="Escribe tu comentario..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Comentar</button>
            </form>
        </div>
    </div>

    <!-- Lista de Comentarios -->
    <div class="mb-4">
        <h5 class="mb-3">Comentarios ({{ $publicacion->comentarios_count }})</h5>
        
        @forelse($publicacion->comentarios->sortByDesc('created_at') as $comentario)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-start mb-2">
                    <img src="https://via.placeholder.com/40" alt="Autor" class="rounded-circle mr-3">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">{{ $comentario->user->name }}</h6>
                            <small class="text-muted">{{ $comentario->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-2 mt-2">{{ $comentario->come_comentario }}</p>
                        
                        <div class="d-flex">
                            <button class="btn btn-sm btn-outline-secondary mr-2">
                                <i class="far fa-thumbs-up"></i> ($comentario->likes_count)
                            </button>
                            @if(auth()->id() == $comentario->come_id_user)
                            <form action="" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
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
        
         $publicacion->comentarios->links()  <!-- Paginación -->
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
                fetch(`/publicaciones/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    if(response.ok) {
                        window.location.href = '{{ route("home") }}';
                    }
                });
            }
        });
    }
</script>
@endsection