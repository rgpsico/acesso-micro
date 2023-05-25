<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\ConfiguracaoLegado;
use GuzzleHttp\Client;
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
        $idweb = $request->idweb;

        $nomeConfiguracao = $request->input('nomeConfiguracao');

        $status = $request->input('status') == 'on' ? 1 : 0;


        $client = new Client();

        // Definir a URL do serviço externo que você está chamando.
        $url = 'http://localhost:8001/'.$idweb.'/configbyname';


        $response = $client->request('POST', $url, [
            'json' => [
                'status' => $status,
                'configName' =>  $nomeConfiguracao
            ]
        ]);



        return response()->json(['status' => 'success', 'message' => 'Configuração atualizada com sucesso!']);
    }


}


