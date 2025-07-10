<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Publicacione;
use \App\PublicacionImg;

class PublicacioneController extends Controller
{
    public function store(Request $request)
    {
       
        $request->validate([
            'comentario' => 'required|string',
            'tittle' => 'required|string',
            'imagen' => 'nullable|image|max:2048',
        ]);
        
        $publicacion = new Publicacione();
        $publicacion->publ_id_user = auth()->id(); // Asignar el usuario autenticado
        $publicacion->publ_comentario = $request->comentario;
        $publicacion->tittle = $request->tittle;
        $publicacion->save();

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombre =  $publicacion->publ_id . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('publicaciones/imagenes'), $nombre);
            // Guardar $nombre en la BD si hace falta

            $publicacion_img = new PublicacionImg;
            $publicacion_img->photo = $nombre;
            $publicacion_img->publ_id = $publicacion->publ_id;
            $publicacion_img->save();
        }
        
        return response()->json(['message' => 'Publicación creada con éxito']);
    }

    public function publicacion($id){

   
        $publicacion = Publicacione::find($id);

       // dd($publicacion->comentarios);

        return view('publicacion.publicacion',compact('publicacion'));
    }
}
