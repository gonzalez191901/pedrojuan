<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Publicacione extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'publ_id_user');
    }
}
