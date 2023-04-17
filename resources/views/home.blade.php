@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


<div class="container acesso">
    @include('sidebar')
    <div class="form-group mb-2">
      <label for="matricula" class="label"></label>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Matrícula" id="matricula">
        <div class="input-group-append">
          <button class="btn btn-primary ml-2" type="button" id="buscar">Buscar</button>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header text-center">
            <img src="https://photografos.com.br/wp-content/uploads/2020/09/fotografia-para-perfil.jpg" alt="Imagem do aluno" class="img-thumbnail" width="150px" height="150px">
          </div>
          <div class="card-body">
            <div class="text-center">
              <h5 class="card-title" id="nomeAluno">Nome do Aluno</h5>
              <p class="card-text">Matrícula:<b id="matricula-aluno"></b></p>
            </div>
            <div class="text-center">
              <span class="badge badge-success" id="status">Liberado</span>
              <i class="fas fa-info-circle ml-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Motivo do status"></i>
            </div>
            <div class="message text-success mt-3 text-center">
              <p id="motivo-status">Motivo do status</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@vite('resources/js/app.js')

<script type="module">

$(document).ready(function(){
    $(document).on('click','#buscar', function(){
        let matricula = $('#matricula').val();

        fetch(`/api/acesso/bymatricula`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ matricula: matricula })
        })
        .then(response => response.json())
        .then(data => {
            if(data.ativo){
                alert("liberado")
                $('#status').text('LIBERADO')
                $(".message").removeClass('text-danger')
                $(".message").addClass('text-success')
            } else {
                $('#status').text('BLOQUEADO')
                $(".message").removeClass('text-success')
                $(".message").addClass('text-danger')
            }

        })
        .catch(error => {
            console.log(error);
            // trate o erro, se necessário
        });
    })

    function execultarTeste()
    {
        $.get('executar-comando', function(data){

    })

    }
    $(document).on('click', '#buscar', function() {
    var matricula = 10;
        $.get('https://vendas.mufitness.com.br/004/aluno/3/byid',function(data){
                    if(data.data.released == false){
                        execultarTeste()
                    }
            })
        });
})


</script>
@endsection

