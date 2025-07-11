@extends('layouts.app')

@section('content')
<div class="row">


    <div class="col-md-8 col-12" id="publicaciones">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex">
                    <img src="@if($user->photo != '') {{ asset('profile/photos/'.$user->photo) }} @else {{ asset('img/user.png') }} @endif"
                        alt="Usuario" width="50" height="50" class="rounded-circle mr-3">

                    <div class="w-100">
                        <input type="text" class="form-control mb-2" name="tittle" id="tittle" placeholder="Título" style="width:50%;">
                        <textarea class="form-control" rows="3" placeholder="¿Qué está pasando?" id="contenido"></textarea>

                        <!-- Contenedor para vista previa -->
                        <div id="preview-container" class="mt-3" style="display: none;">
                            <img id="preview-image" src="#" alt="Vista previa" class="img-fluid rounded" style="max-height: 300px;">
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <!-- Botón con ícono para cargar imagen -->
                                <button type="button" class="btn btn-sm text-primary" title="Subir Imagen" id="uploadTrigger">
                                    <i class="far fa-image"></i>
                                </button>

                                <!-- Input de archivo oculto -->
                                <input type="file" id="imageInput" name="image" accept="image/*" class="d-none">
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
                <img src="@if($publi->user->photo != '') {{asset('profile/photos/'.$publi->user->photo)}} @else {{asset('img/user.png')}} @endif" alt="Usuario" width="50" height="50" class="rounded-circle mr-3">
                <div class="w-100">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <strong>{{ $publi->user->username }}</strong>
                            <span class="text-muted ml-2">· {{ $publi->created_at->diffForHumans() }}</span>
                        </div>
                        <button class="btn btn-sm text-muted"><i class="fas fa-ellipsis-h"></i></button>
                    </div>
                    <strong> {{ $publi->tittle }}</strong>
                    <p class="mb-2"> {{ $publi->publ_comentario }}</p>
                        <div class="content_publi_img">
                            @foreach($publi->publi_img as $img_publ)
                            <img src="{{asset('publicaciones/imagenes/'.$img_publ->photo)}}" alt="" class="photo_publ">
                            @endforeach
                        </div>
                    <div class="d-flex justify-content-between text-muted mt-3">
                        <button class="btn btn-sm text-muted"><i class="far fa-comment"></i>{{$publi->comentarios->count()}}</button>
                        
                        <button class="btn btn-sm text-muted"><i class="far fa-heart"></i>{{$publi->likes->count()}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    </div><!--fin div publicacion -->
    <div class="col-md-4 d-none d-md-block" id="populares">


        

        <div class="card populares" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Publicaciones Populares</h5>
            </div>
            <ul class="list-group list-group-flush">
                @foreach($populares as $populares)
                    <li class="list-group-item">
                        <a href="{{ route('publicaciones.publicacion', ['id' => $populares->publ_id]) }}'" class="div-populares">
                            <p>{{ $populares->tittle }}</p> <span><i class="fas fa-heart"></i> {{$populares->likes->count()}}</span>
                        </a>
                    </li>
                 @endforeach
            </ul>
        </div>


    </div>
</div>



@endsection
@section('scripts')
  <script>
    $(document).ready(function() {
      
        // Al hacer clic en el ícono de imagen
        $('#uploadTrigger').on('click', function () {
            $('#imageInput').click();
        });

        // Al seleccionar un archivo
        $('#imageInput').on('change', function (e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview-image').attr('src', e.target.result);
                    $('#preview-container').show();
                };

                reader.readAsDataURL(file);
            } else {
                $('#preview-container').hide();
            }
        });
   
    $('.btn-primary').click(function (e) {
        e.preventDefault();

        let contenido = $('#contenido').val().trim();
        let tittle = $('#tittle').val().trim();
        let imagen = $('#imageInput')[0].files[0]; // obtener el archivo si existe

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
                text: 'Por favor escribe un título',
                confirmButtonColor: '#3085d6',
            });
            return;
        }

        // Crear objeto FormData
        let formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('comentario', contenido);
        formData.append('tittle', tittle);
        if (imagen) {
            formData.append('imagen', imagen);
        }

        $.ajax({
            url: '{{ route("publicaciones.store") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.form-control').val('');
                $('#preview-container').hide(); // Ocultar vista previa

                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Publicación creada con éxito',
                    showConfirmButton: false,
                    timer: 1500
                });

                setTimeout(() => location.reload(), 1500);
            },
            error: function (xhr) {
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