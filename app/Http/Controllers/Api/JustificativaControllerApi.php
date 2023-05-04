<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AcessoLegado;
use App\Models\Config;
use App\Models\ConfiguracaoLegado;
use Illuminate\Http\Request;



class JustificativaControllerApi extends Controller
{

    protected $model;
    protected $config;



    public function __construct(AcessoLegado $model, ConfiguracaoLegado $config )
    {
        $this->model = $model;
        $this->config = $config;
    }

    public function all()
    {
        return $this->model::all();
    }

    public function store(Request $request)
    {
        $configuracao_legado = $this->config->where('id',1)->first();
        $tipo_liberacao = $configuracao_legado->JUSTIFICATIVA == 1 ? 'liberação justificada' : 'Liberação manual';

         $sf_acesso = $this->model::create([
            'id_fornecedor' => $request->input('id_fornecedor'),
            'data_acesso' => now(),
            'status_acesso' => $request->input('status_acesso'),
            'liberador_por' => $request->input('liberador_por'),
            'motivo_liberacao' => $request->input('motivo_liberacao'),
            'ambiente' => $request->input('ambiente'),
            'id_empresa_local' => $request->input('id_empresa_local'),
            'id_empresa_origem' => $request->input('id_empresa_origem'),
            'descricao_acesso' => $request->input('descricao_acesso'),
            'tipo_liberacao' => $tipo_liberacao ,
        ]);

        return response()->json($sf_acesso, 201);
    }












}
