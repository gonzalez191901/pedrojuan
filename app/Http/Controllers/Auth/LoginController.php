<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Sobrescribir el método username para permitir múltiples campos
    public function username()
    {
        $login = request()->input('login');
        
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 
            (is_numeric($login) ? 'telefono' : 'username');
        
        request()->merge([$fieldType => $login]);
        
        return $fieldType;
    }

    // Métodos para autenticación social (los mismos que en el registro)
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            
            $finduser = User::where('facebook_id', $user->id)->first();
            
            if($finduser){
                Auth::login($finduser);
                return redirect('/home');
            } else {
                // Crear nuevo usuario o redirigir a registro completo
                return redirect()->route('register')->with('social_user', [
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id
                ]);
            }
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Error al autenticar con Facebook');
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            
            $finduser = User::where('google_id', $user->id)->first();
            
            if($finduser){
                Auth::login($finduser);
                return redirect('/home');
            } else {
                return redirect()->route('register')->with('social_user', [
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id
                ]);
            }
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Error al autenticar con Google');
        }
    }

    public function redirectToInstagram()
    {
        return Socialite::driver('instagram')->redirect();
    }

    public function handleInstagramCallback()
    {
        try {
            $user = Socialite::driver('instagram')->user();
            
            $finduser = User::where('instagram_id', $user->id)->first();
            
            if($finduser){
                Auth::login($finduser);
                return redirect('/home');
            } else {
                return redirect()->route('register')->with('social_user', [
                    'name' => $user->name,
                    'email' => $user->nickname.'@instagram.com',
                    'instagram_id' => $user->id
                ]);
            }
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Error al autenticar con Instagram');
        }
    }
}