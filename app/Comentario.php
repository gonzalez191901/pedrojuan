<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    public $primaryKey = 'come_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'come_id_user');
    }

    public function likes()
    {
        return $this->hasMany(LikesComentario::class, 'id_comentario' , 'come_id');
    }
}
