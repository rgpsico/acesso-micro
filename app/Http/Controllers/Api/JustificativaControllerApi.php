<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RedesFormRequest;
use App\Models\Empresa;
use App\Models\Justificativa;
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
use Illuminate\Support\Facades\DB;
use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Output\OutputPin;


class JustificativaControllerApi extends Controller
{

    protected $model;

    public $timestamps = false;

    protected $connection = 'sqlsrvNovoBanco';

    public function __construct(Justificativa $model )
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model::all();
    }

    public function store()
    {
        $this->model::store([
            ''
        ]);
    }












}
