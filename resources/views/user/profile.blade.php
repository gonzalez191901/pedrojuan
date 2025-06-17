@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container">
 
        
        <!-- Contenido principal -->
        <main role="main" >
            <!-- Header del perfil -->
            <div class="profile-header" style="width:100%;">
                <!-- Banner del perfil -->
                <div class="profile-banner" style="height: 200px; background-color: #1DA1F2; position: relative; ">
                    <div class="profile-avatar" style="position: absolute; bottom: -50px; left: 20px;">
                    <img src="{{ asset('img/user.png') }}" alt="Usuario" width="50" height="50" class="rounded-circle mr-3">    
                    <!--<img src="{{ $user->avatar ?? 'https://via.placeholder.com/150' }}" alt="Avatar" class="rounded-circle border border-4 border-white" width="150" height="150">-->
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
                    <h2 class="font-weight-bold mb-1">{{ $user->username }}</h2>
                   
                    
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
                <ul class="nav nav-tabs border-0" id="profileTabs" role="tablist" style="width:100%;">
                    <li class="nav-item">
                        <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab">Publicaciones</a>
                    </li>
         
                    
                </ul>
            </div>
            
            <!-- Contenido de las pestañas -->
            <div class="tab-content" id="profileTabsContent">
                <div class="tab-pane fade show active" id="posts" role="tabpanel">
                   @forelse(\App\Publicacione::orderBy('created_at', 'desc')->where('publ_id_user',$user->id)->get() as $publi)
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
                                        <button class="btn btn-sm text-muted"><i class="far fa-comment"></i> {{$publi->comentarios->count()}}</button>
                                        <button class="btn btn-sm text-muted"><i class="far fa-heart"></i>{{$publi->likes->count()}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-info">No hay publicaciones!</div>
                    @endforelse
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
