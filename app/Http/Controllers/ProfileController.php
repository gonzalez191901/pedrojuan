<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show($id)
    {
        //$user = \App\User::where('id', 1)->firstOrFail();
        $user = \App\User::where('id', $id)->firstOrFail();
        
        /*$posts = $user->posts()
            ->withCount(['comments', 'retweets', 'likes'])
            ->latest()
            ->paginate(10);
            
        $user->loadCount(['following', 'followers']);*/
        
        return view('user.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'phone' => 'required|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Guardar imagen si se envió
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = $user->id . '.' . $extension;
            $path = public_path('profile/photos/');

            // Crear la carpeta si no existe
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // Mover el archivo
            $file->move($path, $filename);

            // Guardar ruta en la base de datos si lo deseas
            $user->photo = $filename;
        }

        // Actualizar otros campos
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->save();

        return response()->json([
            'message' => 'Perfil actualizado correctamente',
        ]);
    }

}
