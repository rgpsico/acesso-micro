<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Validacao extends Model
{
    protected $table = 'validacoes';

    public function users()
    {
        return $this->belongsToMany(User::class, 'UserValidacao', 'validacao_id', 'user_id');
    }

}
