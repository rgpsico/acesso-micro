<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class LegadoControllerApi extends Controller
{

    protected $model;
    protected $config;


    public function multiFilial($idweb)
    {





        $urlLocal = env('APP_ENV') == 'local' ? 'http://localhost:8001/' : "https://vendas.mufitness.com.br/";

        $url = $urlLocal.$idweb.'/sfmfrede';


        try {
            $response = Http::get($url);

            if ($response->successful()) {
                $dados = $response->json();

                return response()->json($dados);
            } else {

                return redirect()->back()->withErrors(['error' => 'Ocorreu um erro na requisição.']);
            }
        } catch (\Exception $e) {
            // Trate erros de conexão e outros erros inesperados aqui
            // ...
            return redirect()->back()->withErrors(['error' => 'Ocorreu um erro na requisição.']);
        }
    }




}
