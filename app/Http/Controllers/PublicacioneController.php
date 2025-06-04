<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Publicacione;

class PublicacioneController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comentario' => 'required|string|max:280'
        ]);
        
        $publicacion = new Publicacione();
        $publicacion->publ_id_user = auth()->id(); // Asignar el usuario autenticado
        $publicacion->publ_comentario = $request->comentario;
        $publicacion->save();
        
        return response()->json(['message' => 'Publicación creada con éxito']);
    }

    public function publicacion($id){

   
        $publicacion = Publicacione::find($id);

       // dd($publicacion->comentarios);

        return view('publicacion.publicacion',compact('publicacion'));
    }
}
