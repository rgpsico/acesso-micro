<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $connection = 'sqlsrvNovoBanco';

    protected $primaryKey = 'id_fornecedores_despesas';

    protected $fillable = [
        'razao_social',
    ];

    protected $table = 'sf_fornecedores_despesas';

    public $timestamps = false;



}
