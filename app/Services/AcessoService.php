<?php

namespace App\Services;

use App\Models\EmpresaCancelamento;
use App\Models\User;
use App\Models\UserValidacao;

class AcessoService
{

    protected $service;

    public function __construct(ValidacoesAcessoService $service )
    {
        $this->service = $service;
    }



    public function validacoes($matricula)
    {

        $bloqueioAcesso = $this->service->validacaoBloqueioGeral($matricula);

        $bloqueioCadastro = $this->service->validacaoBloqueioCadastro($matricula);

        $estaEmDia = $this->service->validacaoPlano($matricula);

        $validacaoCarteira = $this->service->validacaoCarteira($matricula);

        $validacaoDocumento = $this->service->validacaoDocumento($matricula);


        if ($bloqueioCadastro) {
            return response()->json(['content' => 'aluno bloqueio cadastro'],  200);
        }


        if ($bloqueioAcesso) {
            return response()->json(['content' => 'aluno bloqueado'],  200);
        }


        if ($estaEmDia) {
            return response()->json(['content' => 'aluno não está em dia'], 200);
        }

        if ($validacaoDocumento) {
            return response()->json(['content' => 'bloqueio documento'], 200);
        }

        if ($validacaoCarteira) {
            return response()->json(['content' => 'bloqueio carteira'], 200);
        }
    }




}
