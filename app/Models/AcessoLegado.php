<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcessoLegado extends Model
{
    protected $table = 'sf_acessos';

    public $timestamps = false;

    protected $connection = 'sqlsrvNovoBanco';

    protected $fillable = [
        'id_fornecedor',
        'data_acesso',
        'status_acesso',
        'liberado_por',
        'motivo_liberacao',
        'ambiente',
        'id_empresa_origem',
        'id_empresa_local',
        'descricao_acesso',
        'tipo_liberacao'
    ];

}

