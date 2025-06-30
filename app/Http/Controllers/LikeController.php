<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\LikesComentario;

class LikeController extends Controller
{
    public function create(Request $request){

        $like = Like::where('id_usuario',auth()->id())->where('id_publicacion',$request->id)->first();


        if($like){
            $like->delete();
        }else{
            $like = new Like;
            $like->id_usuario = auth()->id();
            $like->id_publicacion = $request->id;
            $like->save();
        }

        return Like::where('id_publicacion',$request->id)->get();
        
    }

    public function createComentario(Request $request){

        $like = LikesComentario::where('id_usuario',auth()->id())->where('id_comentario',$request->id)->first();

        if($like){
            $like->delete();
        }else{
            $like = new LikesComentario;
            $like->id_usuario = auth()->id();
            $like->id_comentario = $request->id;
            $like->save();
        }

        return LikesComentario::where('id_comentario',$request->id)->get();

    }
}
