<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RedesFormRequest;
use App\Models\ConfiguracaoLegado;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserValidacao;
use App\Models\Validacao;
use App\Services\AcessoService;
use App\Services\CatracaService;
use App\Services\ValidacoesAcessoService;

use GuzzleHttp\Client;



class ConfigController extends Controller
{

    protected $view = 'admin.pages.config';
    protected $module = 'config';
    protected $pageTitle = "Configurações";
    protected $model;
    protected $service;
    protected $validacao;
    protected $configuracao;
    public function __construct(ValidacoesAcessoService $service, AcessoService $validacao, ConfiguracaoLegado $configuracao )
    {
        $this->service = $service;
        $this->validacao = $validacao;
        $this->configuracao = $configuracao;
    }


    public function index()
    {
        $pageTitle = $this->pageTitle;

        $configuracao = $this->configuracao->get();

        return view($this->view.'.index', compact('pageTitle','configuracao') );
    }




}
