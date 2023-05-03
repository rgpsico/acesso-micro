<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\ConfiguracaoLegado;
use Illuminate\Http\Request;

class ConfiguracaoControllerApi extends Controller
{
    protected $model;



    public function __construct(ConfiguracaoLegado $model )
    {
        $this->model = $model;
    }

    public function updateConfiguracao(Request $request)
    {
        $nomeConfiguracao = $request->input('nomeConfiguracao');
        $status = $request->input('status') == 'on' ? 1 : 0;

        $this->model::where('id', 1)
            ->update([$nomeConfiguracao => $status]);

        return response()->json(['status' => 'success', 'message' => 'Configuração atualizada com sucesso!']);
    }


}


