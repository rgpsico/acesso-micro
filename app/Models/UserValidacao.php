<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class UserValidacao extends Model
{
    protected $table = "user_validacoes";

    public $timestamps = false;

    protected $fillable = ['user_id', 'validacao_id'];
    protected $primaryKey = 'validacao_id';

    public function validacao()
    {
        return $this->belongsTo(Validacao::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

