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

        $bloqueioAcesso = $this->service->validacaoBloqueioCadastro($matricula);

        if ($bloqueioAcesso)
        {
            return response()->json(['content' => 'Aluno está bloqueado'], 200);
        }


        $validacaoPlanoEstaEmDia = $this->service->validacaoPlano($matricula);

        if ($validacaoPlanoEstaEmDia)
        {
            return response()->json(['content' => 'aluno não está em dia, bloqueio Plano'], 200);
        }


        $validacaoCarteira = $this->service->validacaoCarteira($matricula);

        if ($validacaoCarteira)
        {
            return response()->json(['content' => 'Bloqueio Carteira'], 200);
        }


         $validacaoDocumento = $this->service->validacaoDocumento($matricula);

         if ($validacaoDocumento)
        {
            return response()->json(['content' => 'Bloqueio Documento'], 200);
        }


        $validacaoDocumento = $this->service->validacaoDocumento($matricula);

        if ($validacaoDocumento)
       {
           return response()->json(['content' => 'Bloqueio Documento'], 200);
       }


       $validacaoAcesso = $this->service->validacaoAcesso($matricula);

       if ($validacaoAcesso)
       {
            return response()->json(['content' => 'aluno bloqueio Acesso'],  200);
       }


        // if ($validacaoDocumento) {
        //     return response()->json(['content' => 'bloqueio documento'], 200);
        // }

        // if ($validacaoCarteira) {
        //     return response()->json(['content' => 'bloqueio carteira'], 200);
        // }
    }




}
