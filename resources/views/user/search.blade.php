@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container">
 
        
         @foreach($user as $user)
        <div class="card mb-3" style="cursor:pointer;" onclick="window.location.href='{{ route('profile', ['username' => $user->id]) }}'">
          
            <div class="card-body">
                <div class="d-flex">
                    <img src="@if($user->photo != '') {{asset('profile/photos/'.$user->photo)}} @else {{asset('img/user.png')}} @endif" alt="Usuario" width="50" height="50" class="rounded-circle mr-3">
                    <div class="w-100">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div>
                                <strong>{{ $user->username }}</strong>
                              
                            </div>
                            
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
        
    </div>
</div>


@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        

    });
</script>
@endsection
