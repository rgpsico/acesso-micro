<?php

namespace App\Services;

use App\Models\User;

use App\Models\Validacao;

class ValidacoesAcessoService
{

    public $model;
    public $aluno;
    public $config;


    public function __construct(User $aluno)
    {


        $this->aluno = $aluno;
    }


    public function temValidacao($matricula, $validacaoNome)
    {
        $validacao = Validacao::where('nome', $validacaoNome)->first();
        if ($validacao)
        {
            $userValidacao = UserValidacao::where('user_id', $matricula)->where('validacao_id', $validacao->id)->first();
            if ($userValidacao)
            {
                return true;
            }
        }

        return false;
    }



    public function validacaoPlano($matricula)
    {
        $result = false;
        $validacaoNome = 'plano';
        $config = $this->config::where('nome', $validacaoNome)->get();

        if($config->value('status') == 1 && $this->temValidacao($matricula, $validacaoNome))
        {
            return true;
        }

         return $result;
    }



    public function validacaoBloqueioCadastro($matricula)
    {
         $result = false;
         $validacao = 'BloqueioCadastro';

         $config = $this->config::where('nome', $validacao )->get();



         if($config->value('status') == 1 && $this->temValidacao($matricula, $validacao))
         {
             return true;
         }

          return $result;
    }


    public function validacaoCarteira($matricula)
    {
         $result = false;
         $validacao = 'carteira';

         $config = $this->config::where('nome', $validacao)->get();

         if($config->value('status') == 1 && $this->temValidacao($matricula, $validacao))
         {
             return true;
         }

          return $result;
    }


    public function validacaoDocumento($matricula)
    {
         $result = false;
         $validacao = 'documento';

         $config = $this->config::where('nome', $validacao)->get();

         if($config->value('status') == 1 && $this->temValidacao($matricula, $validacao))
         {
             return true;
         }

          return $result;
    }


    public function validacaoAcesso($matricula)
    {
         $result = false;
         $validacao = 'acesso';

         $config = $this->config::where('nome', $validacao)->get();

         if($config->value('status') == 1 && $this->temValidacao($matricula, $validacao))
         {
             return true;
         }

          return $result;
    }





}
