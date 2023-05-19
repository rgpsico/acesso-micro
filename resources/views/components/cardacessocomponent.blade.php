<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="container acesso">
''
<div class="row">
    <div class="col-12 col-md-1 d-flex align-items-center justify-content-center">
      <img src="" id="logo" alt="" height="40" width="100" class="img-fluid mb-4 mx-auto">
    </div>
    <div class="form-group col-12 col-md-5 d-flex align-items-center my-2 mr-2">
      <div class="input-group col-12">
        <select name="" id="id_filial" class="form-select mr-2 col-12 col-md-auto">
        </select>

        <input type="hidden" id="nativaId" class="form-control">
        <input type="hidden" id="matricula" class="form-control">
        <input type="text" id="buscar_aluno" class="form-control ml-3" style="margin-left:10px;" placeholder="Nome Aluno" autocomplete="off">

        <div class="col-12" style="position:absolute; right:0; width:250px; top:105%; z-index:10000;">
          <select name="alunos_multifilai"
                  id="alunos_multifilai"
                  class="form-select"
                  style="display:none;"
                  placeholder="Nome Aluno"
                  style="position:absoulute;">
          </select>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-2 my-md-0 my-1 d-flex align-items-center">
      <button class="btn-desktop" type="button" id="buscar">Buscar</button>
    </div>
    <div class="col-12 my-md-0 my-4 col-md-4 d-flex justify-content-end my-2 mr-2" style="margin-top:20px; text-align:center;">
      <span id="clock" class="bg-dark d-flex"></span>
    </div>
  </div>


    <div class="card p-2">
        <div class="card-header text-center" style="min-height:300px; max-height:300px;">
            <img src="{{ asset('img/defaultAvatarPng2.png') }}"
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


