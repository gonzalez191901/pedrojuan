@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
 
        
        <!-- Contenido principal -->
        <main role="main" >
            <!-- Header del perfil -->
            <div class="profile-header">
                <!-- Banner del perfil -->
                <div class="profile-banner" style="height: 200px; background-color: #1DA1F2; position: relative;">
                    <div class="profile-avatar" style="position: absolute; bottom: -50px; left: 20px;">
                        <img src="{{ $user->avatar ?? 'https://via.placeholder.com/150' }}" alt="Avatar" class="rounded-circle border border-4 border-white" width="150" height="150">
                    </div>
                    <div class="profile-actions" style="position: absolute; bottom: 20px; right: 20px;">
                        @if(auth()->id() === $user->id)
                            <button class="btn btn-outline-light rounded-pill" data-toggle="modal" data-target="#editProfileModal">
                                <i class="fas fa-edit mr-1"></i> Editar perfil
                            </button>
                        @else
                            <button class="btn btn-primary rounded-pill mr-2">
                                <i class="fas fa-user-plus mr-1"></i> Seguir
                            </button>
                            <button class="btn btn-outline-light rounded-pill">
                                <i class="fas fa-envelope"></i>
                            </button>
                        @endif
                    </div>
                </div>
                
                <!-- Información del usuario -->
                <div class="profile-info mt-5 pt-4 px-3">
                    <h2 class="font-weight-bold mb-1">{{ $user->name }}</h2>
                    <p class="text-muted mb-1">@{{ $user->username }}</p>
                    
                    @if($user->bio)
                        <p class="my-3">{{ $user->bio }}</p>
                    @endif
                    
                    <div class="d-flex text-muted mb-3">
                        @if($user->location)
                            <div class="mr-3">
                                <i class="fas fa-map-marker-alt mr-1"></i> {{ $user->location }}
                            </div>
                        @endif
                        @if($user->website)
                            <div class="mr-3">
                                <i class="fas fa-link mr-1"></i> 
                                <a href="{{ $user->website }}" target="_blank" class="text-primary">{{ parse_url($user->website, PHP_URL_HOST) }}</a>
                            </div>
                        @endif
                        <div class="mr-3">
                            <i class="far fa-calendar-alt mr-1"></i> 
                            Se unió en {{ $user->created_at->format('F Y') }}
                        </div>
                    </div>
                    
                    <div class="d-flex mb-3">
                        <div class="mr-4">
                            <span class="font-weight-bold">{{ $user->following_count }}</span> 
                            <span class="text-muted">Siguiendo</span>
                        </div>
                        <div>
                            <span class="font-weight-bold">{{ $user->followers_count }}</span> 
                            <span class="text-muted">Seguidores</span>
                        </div>
                    </div>
                </div>
                
                <!-- Pestañas de navegación -->
                <ul class="nav nav-tabs border-0" id="profileTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab">Publicaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="replies-tab" data-toggle="tab" href="#replies" role="tab">Respuestas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="media-tab" data-toggle="tab" href="#media" role="tab">Multimedia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="likes-tab" data-toggle="tab" href="#likes" role="tab">Me gusta</a>
                    </li>
                </ul>
            </div>
            
            <!-- Contenido de las pestañas -->
            <div class="tab-content" id="profileTabsContent">
                <div class="tab-pane fade show active" id="posts" role="tabpanel">
                   
                </div>
                
                <div class="tab-pane fade" id="replies" role="tabpanel">
                    <div class="text-center py-5">
                        <i class="far fa-comment-dots fa-3x text-muted mb-3"></i>
                        <h4>No hay respuestas todavía</h4>
                        <p class="text-muted">Cuando {{ $user->username }} responda a publicaciones, aparecerán aquí.</p>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="media" role="tabpanel">
                    <div class="text-center py-5">
                        <i class="far fa-image fa-3x text-muted mb-3"></i>
                        <h4>No hay multimedia todavía</h4>
                        <p class="text-muted">Cuando {{ $user->username }} publique fotos o videos, aparecerán aquí.</p>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="likes" role="tabpanel">
                    <div class="text-center py-5">
                        <i class="far fa-heart fa-3x text-muted mb-3"></i>
                        <h4>No hay me gusta todavía</h4>
                        <p class="text-muted">Los posts que a {{ $user->username }} le gusten aparecerán aquí.</p>
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Sidebar derecho
        <div class="col-md-3 col-lg-4 d-none d-md-block">
            include('partials.right-sidebar')
        </div> -->
    </div>
</div>

<!-- Modal para editar perfil -->
@if(auth()->id() === $user->id)
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Editar perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="username">Nombre de usuario</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                    </div>
                    <div class="form-group">
                        <label for="bio">Biografía</label>
                        <textarea class="form-control" id="bio" name="bio" rows="3">{{ $user->bio }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="location">Ubicación</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ $user->location }}">
                    </div>
                    <div class="form-group">
                        <label for="website">Sitio web</label>
                        <input type="url" class="form-control" id="website" name="website" value="{{ $user->website }}">
                    </div>
                    <div class="form-group">
                        <label for="avatar">Foto de perfil</label>
                        <input type="file" class="form-control-file" id="avatar" name="avatar">
                    </div>
                    <div class="form-group">
                        <label for="banner">Foto de portada</label>
                        <input type="file" class="form-control-file" id="banner" name="banner">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary rounded-pill">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Activar tooltips
        $('[data-toggle="tooltip"]').tooltip();
        
        // Manejar el cambio de pestañas
        $('#profileTabs a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>
@endsection
