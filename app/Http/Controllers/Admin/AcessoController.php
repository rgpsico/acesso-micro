<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RedesFormRequest;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserValidacao;
use App\Models\Validacao;
use App\Services\AcessoService;
use App\Services\CatracaService;
use App\Services\ValidacoesAcessoService;

use GuzzleHttp\Client;



class AcessoController extends Controller
{

    protected $view = 'admin.pages.acesso';
    protected $module = 'Acesso';
    protected $pageTitle = "Acesso";
    protected $model;
    protected $service;
    protected $validacao;

    public function __construct(ValidacoesAcessoService $service, AcessoService $validacao )
    {
        $this->service = $service;
        $this->validacao = $validacao;
    }


    public function index()
    {
        $pageTitle = $this->pageTitle;

        return view($this->view.'.index', compact('pageTitle') );
    }

    public function enviarComando()
    {
        $client = new Client();
        $response = $client->request('POST', 'http://localhost:5070/send-command');

        if ($response->getStatusCode() == 200) {
            return "Comando enviado com sucesso!";
        } else {
            return "Ocorreu um erro ao enviar o comando: " . $response->getBody()->getContents();
        }
    }



    public function getByMatricula(Request $request)
    {

    $matricula = $request->matricula;
    $contrato = $request->contrato;

    if($this->validacao->validacoes($matricula)){
        return $this->validacao->validacoes($matricula);
    }

    $aluno = User::all(['id', 'nome', 'email'])->where('id', $matricula);
    return $this->response($aluno);
    }






    public function byNome(Request $request)
    {
        $nome = $request->nome;
        $contrato = $request->contrato;

        $aluno = User::select('id', 'nome', 'email')
        ->where('nome', 'like', '%' . $nome . '%')
        ->get();

        return $this->response($aluno);
    }


    public function addPermissoes(Request $request)
    {

        $userId = $request->userId;
        $validacao = $request->validacao;

        $user = User::findOrFail($userId);


        $validacaoResult = Validacao::where('nome', $validacao)->firstOrFail();

        if($validacaoResult)
        {

             UserValidacao::updateOrCreate(
                ['user_id' =>  request('userId')],
                ['validacao_id' => $validacaoResult->id]
            );
            return response()->json(['message' => 'Validação adicionada com sucesso!'], 200);
        }


        return response()->json(['message' => 'Validação Não foi encontrada'], 200);
    }



    public function removerPermissao(Request $request)
    {

        $validacao_id = $request->validacao_id;
        $user_id = $request->user_id;

        $userValidacao = UserValidacao::where('validacao_id', $validacao_id)
        ->where('user_id', $user_id)
        ->first();

        if ($userValidacao)
        {
            $userValidacao->delete();
            return response()->json(['message' => 'Validação excluída com sucesso!'], 200);
        }

            return response()->json(['message' => 'Validação não foi excluida!'], 404);
    }



    public function response($aluno)
    {

        if (count($aluno) != 0)
        {
            foreach ($aluno as $empresa) {
                $empresa->result = true;
                $empresa->banco = 'Bancox';
                $empresa->plano = 'Plano x';
                $empresa->mensagem = 'Usuário Liberado';
            }

            return response()->json($aluno->values()->first(), 200);

        }

        return response()->json(['Mensagem' => 'Aluno não encontrado'], 404);

    }




}
