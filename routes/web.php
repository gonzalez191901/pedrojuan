<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home.home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.login'); // Puedes crear esta vista similar al registro
})->name('login');
 
Auth::routes(['verify' => true]);

// Rutas para autenticación social
/*Route::get('/auth/facebook', 'Auth\LoginController@redirectToFacebook')->name('auth.facebook');
Route::get('/auth/facebook/callback', 'Auth\LoginController@handleFacebookCallback');

Route::get('/auth/google', 'Auth\LoginController@redirectToGoogle')->name('auth.google');
Route::get('/auth/google/callback', 'Auth\LoginController@handleGoogleCallback');

Route::get('/auth/instagram', 'Auth\LoginController@redirectToInstagram')->name('auth.instagram');
Route::get('/auth/instagram/callback', 'Auth\LoginController@handleInstagramCallback');*/

// Ruta para verificación de teléfono
Route::get('/phone/verify', 'Auth\PhoneVerificationController@show')->name('phone.verify');
Route::post('/phone/verify', 'Auth\PhoneVerificationController@verify');
Route::post('/phone/resend', 'Auth\PhoneVerificationController@resend')->name('phone.resend');

Route::get('/profile/{username}', 'ProfileController@show')->name('profile');
Route::post('/profile/update', 'ProfileController@update')->name('profile.update')->middleware('auth');


Route::post('/publicaciones', 'PublicacioneController@store')->name('publicaciones.store');
Route::get('/publicacion/{id}', 'PublicacioneController@publicacion')->name('publicaciones.publicacion');

Route::post('/comentario/create', 'ComentarioController@create')->name('comentario.create');