<?php

namespace App\Services;

use App\Models\EmpresaCancelamento;
use App\Models\User;


class CatracaService
{

    protected $service;

    public function __construct(ValidacoesAcessoService $service )
    {
        $this->service = $service;
    }



    public function liberarCatraca()
    {
        exec('C:\Users\barbara.MU\Downloads\Debug\nseUSB2E2S.exe');
    }




}
