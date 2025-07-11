<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Publicacione;

Route::get('/', function () {
    $user = Auth::user();
    $populares = Publicacione::withCount('likes')
    ->orderBy('likes_count', 'desc')
    ->take(10)
    ->get();
    return view('home.home',compact('user','populares'));
})
->name('inicio')
->middleware('auth');

Auth::routes();

// Ruta de home protegida
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

// Rutas de autenticación (no deben estar protegidas)
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
 
Auth::routes(['verify' => true]);

// Ruta para verificación de teléfono (protegida)
Route::middleware(['auth'])->group(function () {
    Route::get('/phone/verify', 'Auth\PhoneVerificationController@show')->name('phone.verify');
    Route::post('/phone/verify', 'Auth\PhoneVerificationController@verify');
    Route::post('/phone/resend', 'Auth\PhoneVerificationController@resend')->name('phone.resend');
});

// Rutas de perfil (protegidas)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/{username}', 'ProfileController@show')->name('profile');
    Route::post('/profile/update', 'ProfileController@update')->name('profile.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/user/search', 'ProfileController@search')->name('profile.search');
});

// Rutas de publicaciones y comentarios (protegidas)
Route::middleware(['auth'])->group(function () {
    Route::post('/publicaciones/store', 'PublicacioneController@store')->name('publicaciones.store');
    Route::get('/publicacion/{id}', 'PublicacioneController@publicacion')->name('publicaciones.publicacion');
    Route::post('/comentario/create', 'ComentarioController@create')->name('comentario.create');
    Route::post('/comentario/delete', 'ComentarioController@delete')->name('comentario.delete');
    Route::post('/like/add', 'LikeController@create')->name('like.add');
    Route::post('/like/comentario/add', 'LikeController@createComentario')->name('like.add.comentario');
});