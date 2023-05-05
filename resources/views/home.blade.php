@extends('layouts.app')

@section('content')
<style>
        .btn-desktop {
        background-color: #fff;
        border: none;
        color: #000;
        padding: 8px 12px;
        text-align: center;
        text-decoration: none;
        font-size: 13px;
        cursor: pointer;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

      }

      .btn-desktop:hover {
        opacity: 0.9;
      }

</style>



    <x-notificationbox />

    <div class="container acesso">
     <div class="row">
        <div class="col-1 d-flex align-items-center justify-content-start">
            <img src="" id="logo" alt="" height="40" width="100">
        </div>

        <div class="form-group col-5 d-flex align-items-center my-2 mr-2">
            <div class="input-group">
           <select name="" id="id_filial" class="form-select">
            <option value="" selected>Selecione</option>
            <option value="">Empresa 004</option>
            <option value="">Empresa 02</option>
            <option value="">Empresa 03</option>
            <option value="">Empresa 04</option>
           </select>
                <input type="text" class="form-control" placeholder="Matrícula" id="matricula">
            </div>
        </div>

        <div class="col-2 d-flex align-items-center">
            <button class="btn-desktop" type="button" id="buscar">Buscar</button>
        </div>

        <div class="col-4 d-flex  justify-content-end my-2 mr-2 " style="margin-top:20px; text-align:center; ">
            <span id="clock" class="bg-dark  d-flex" ></span>
        </div>
</div>




        <div class="card p-2">
            <div class="card-header text-center" style="min-height:300px; max-height:300px;">
                <img src="https://photografos.com.br/wp-content/uploads/2020/09/fotografia-para-perfil.jpg"
                    alt="Imagem do aluno" class="img-thumbnail" id="foto_avatar" width="280px" height="240px" style="max-height:240px;">
            </div>
            <div class="card-body">
                <div class="text-center">
                    <h1 class="card-title nome_Aluno1" id="nomeAluno">Nome do Aluno</h1>
                    <h2 class="card-text">Matrícula: <b id="matricula-aluno"></b></h2>
                    <h3 class="card-text">Plano: <b id="descricaoPlano"></b></h3>
                    <h5 class="card-text">Data Vencimento: <b id="data_venct"></b></h3>
                    <h5 class="card-text">Motivo: <b id="acessoMsg"></b></h3>
                </div>
            </div>
            <div class=" text-success mt-3 text-center">
                <p id="motivo-status" class="w3-tag w3-xxlarge w3-padding w3-orange w3-center"
                    style="font-weight:bold; font-size:25px;">Motivo do status</p>
            </div>
        </div>
    </div>
    </div>




    @vite('resources/js/app.js')


@endsection
