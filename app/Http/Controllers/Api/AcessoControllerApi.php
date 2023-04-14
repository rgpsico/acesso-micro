<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RedesFormRequest;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Models\Redes;
use App\Models\User;
use App\Models\UserValidacao;
use App\Models\Validacao;
use App\Services\AcessoService;
use App\Services\CatracaService;
use App\Services\ValidacoesAcessoService;
use Illuminate\Support\Str;
use Carbon\Carbon;
use GuzzleHttp\Client;
use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Output\OutputPin;


class AcessoControllerApi extends Controller
{

    protected $view = 'admin.cadastro.acesso';
    protected $module = 'Acesso';
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
        $getNomePaginaInterno = $this->module;

        return view($this->view.'.index', compact('getNomePaginaInterno') );
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

    $catraca = app(CatracaService::class);
    $catraca->liberarCatraca();

    $aluno = User::all(['id', 'nome', 'email'])->where('id', $matricula);
    return $this->response($aluno);
}



    public function validacao($matricula)
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
