<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class UserValidacao extends Model
{
    protected $table = "user_validacoes";

    public function validacao()
    {
        return $this->belongsTo(Validacao::class);
    }

}
