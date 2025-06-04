<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comentario;

class Publicacione extends Model
{
    public $primaryKey = 'publ_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'publ_id_user');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'come_publ_id' , 'publ_id');
    }
}
