<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comentario;

class ComentarioController extends Controller
{
    public function create(Request $request){


        $model = new Comentario;

        $model->come_id_user = auth()->id();
        $model->come_comentario = $request->contenido;
        $model->come_publ_id = $request->publicacion_id;
        $model->save();

        //return redirect('publicaciones.publicacion',['id' => $request->publicacion_id]);
        return redirect()->route('publicaciones.publicacion', ['id' => $request->publicacion_id]);

    }

    public function delete(Request $request){

        $comen = Comentario::find($request->id);
        $comen->delete();

        return 1;
    }
}
