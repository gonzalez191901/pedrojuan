<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:50'],
            'apellido' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'telefono' => ['required', 'string', 'max:20'],
            'fecha_nacimiento' => ['required', 'date', 'before:-18 years'],
            'carrera' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'username' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-Z0-9_]+$/',
                'unique:users,username' // Valida que el username no exista en la tabla 'users'
            ],
        ], [
            'fecha_nacimiento.before' => 'Debes tener al menos 18 años para registrarte.',
            'username.regex' => 'El nombre de usuario solo puede contener letras y números, sin espacios ni caracteres especiales.',
            'username.unique' => 'Este nombre de usuario ya está en uso.',
        ]);
    }

    protected function create(array $data)
{
    $model = new User;
    $model->name = $data['nombre'];
    $model->last_name = $data['apellido'];
    $model->email = $data['email'];
    $model->phone = $data['telefono'];
    $model->fecha_nacimiento = $data['fecha_nacimiento'];
    $model->carrera_id = $data['carrera'];
    $model->username = $data['username'];
    $model->password = Hash::make($data['password']);
    $model->save();

    return $model; // ¡Esto es lo importante que faltaba!
}
}