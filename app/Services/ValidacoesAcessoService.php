<?php

namespace App\Services;

use App\Models\EmpresaCancelamento;
use App\Models\User;
use App\Models\UserValidacao;

class ValidacoesAcessoService
{

    public $model;
    public $aluno;
    public function __construct(UserValidacao $model, User $aluno)
    {
        $this->model = $model;
        $this->aluno = $aluno;
    }



    public function validacoes($matricula)
    {
        return  $this->model::with('validacao')->where('user_id', $matricula)->get();
    }

    public function getAlunoById($matricula)
    {
        return  $this->aluno::where('id', $matricula)->get();
    }


    public function getIdsValidacoes($matricula)
    {
        $validacoes = $this->model::where('user_id', $matricula)->pluck('validacao_id')->toArray();
        return $validacoes;
    }


    public function Bloqueio($matricula, $nomeValidacao)
    {
        $validacoes = $this->validacoes($matricula);

        $result = false;

        foreach ($validacoes as $value)
        {
            if ($value->validacao->nome == $nomeValidacao)
            {
               $result = true;
            }
        }

       return $result;
    }



    public function validacaoBloqueioGeral($matricula)
    {
       $bloqueio = $this->Bloqueio($matricula, 'bloqueio');
       $result = false;

            if ($bloqueio)
            {
                $aluno = User::find($matricula);

                $dataPlano = $aluno->created_at;

                if($dataPlano == true){ // Validação
                    $result =  true;
                }

            }
            return $result;
    }



    public function validacaoPlano($matricula)
    {
       $bloqueio = $this->Bloqueio($matricula, 'plano');
       $result = false;

            if ($bloqueio)
            {
                $aluno = User::find($matricula);

                $dataPlano = $aluno->created_at;

                if($dataPlano == true){ // Validação
                    $result =  true;
                }

            }
            return $result;
    }



    public function validacaoCarteira($matricula)
    {
       $bloqueio = $this->Bloqueio($matricula, 'carteira');
       $result = false;

       if ($bloqueio)
       {
           $aluno = User::find($matricula);
           $dataPlano = $aluno->created_at;

           if($dataPlano == true){ // Validação
               $result =  true;
           }
       }

       return $result;
    }


    public function validacaoHorarios($matricula)
    {
       $bloqueio = $this->Bloqueio($matricula, 'bloqueio');

            if ($bloqueio)
            {
                $aluno = User::find($matricula);

                $dataPlano = $aluno->created_at;
                dd('AQUIaaaa');

            }
    }


    public function validacaoSessao($matricula)
    {
       $bloqueio = $this->Bloqueio($matricula, 'bloqueio');

            if ($bloqueio)
            {
                $aluno = User::find($matricula);

                $dataPlano = $aluno->created_at;
                dd('AQUIaaaaa');

            }
    }

    public function validacaoGympass($matricula)
    {
       $bloqueio = $this->Bloqueio($matricula, 'bloqueio');

            if ($bloqueio)
            {
                $aluno = User::find($matricula);

                $dataPlano = $aluno->created_at;
                dd('AQUIaaa');

            }
    }

    public function validacaoTurmas($matricula)
    {
       $bloqueio = $this->Bloqueio($matricula, 'bloqueio');

            if ($bloqueio)
            {
                $aluno = User::find($matricula);

                $dataPlano = $aluno->created_at;
                dd('AQUI');

            }
    }


    public function validacaoCadastro($matricula)
    {
       $bloqueio = $this->Bloqueio($matricula, 'bloqueio');

            if ($bloqueio)
            {
                $aluno = User::find($matricula);

                $dataPlano = $aluno->created_at;
                dd('AQUI');

            }
    }


    public function validacaoFacial($matricula)
    {
       $bloqueio = $this->Bloqueio($matricula, 'bloqueio');

            if ($bloqueio)
            {
                $aluno = User::find($matricula);

                $dataPlano = $aluno->created_at;
                dd('AQUI');

            }
    }


    public function validacaoBloqueioCadastro($matricula)
    {
       $bloqueio = $this->Bloqueio($matricula, 'bloqueioCadastro');
        $result = false;
        if ($bloqueio)
        {
            $aluno = User::find($matricula);
            $dataPlano = $aluno->created_at;

            if($dataPlano == true)
            { // Validação
                $result =  true;
            }
        }

        return $result;
    }


    public function validacaoDocumento($matricula)
    {
       $bloqueio = $this->Bloqueio($matricula, 'bloqueioDocumento');
        $result = false;
        if ($bloqueio)
        {
            $aluno = User::find($matricula);
            $dataPlano = $aluno->created_at;

            if($dataPlano == true)
            { // Validação
                $result =  true;
            }
        }

        return $result;
    }


}
