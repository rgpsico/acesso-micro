@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
    /* Fontes */
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

    /* Estilos para h1 */
    h1.card-title {
      font-family: 'Montserrat', sans-serif;
      font-size: 36px;
      font-weight: 700;
      letter-spacing: 1px;
      margin-bottom: 0;
      text-transform: uppercase;
    }

    /* Estilos para h2 */
    h2.card-text {
      font-family: 'Roboto', sans-serif;
      font-size: 24px;
      font-weight: 400;
      margin-top: 0.5rem;
    }

    /* Estilos para parágrafo */
    p#motivo-status {
      background-color: #FFA500;
      border-radius: 50px;
      color: #fff;
      font-family: 'Roboto', sans-serif;
      font-size: 20px;
      font-weight: 700;
      letter-spacing: 1px;
      margin: 1rem 0 0;
      padding: 1rem 2rem;
      text-transform: uppercase;
    }
  </style>

<audio id="liberado" src="{{ asset('music/success.mp3') }}"></audio>
<audio id="bloqueado" src="{{ asset('music/error.mp3') }}"></audio>

<div class="container acesso">
    <input type="hidden" name="cliente_id" id="cliente_id" value="{{ env('CLIENTE') }}">
    <div class="form-group mb-2 col-4">
      <label for="matricula" class="label"></label>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Matrícula" id="matricula">
        <div class="input-group-append">
          <button class="btn btn-primary ml-2" type="button" id="buscar">Buscar</button>
        </div>
      </div>
    </div>


        <div class="card" style="max-height:600px; ">
          <div class="card-header text-center">
            <img src="https://photografos.com.br/wp-content/uploads/2020/09/fotografia-para-perfil.jpg" alt="Imagem do aluno" class="img-thumbnail" id="foto_avatar" width="350px" height="350px">
          </div>
          <div class="card-body">
            <div class="text-center">
              <h1 class="card-title" id="nomeAluno">Nome do Aluno</h1>
              <h2 class="card-text">Matrícula: <b id="matricula-aluno"></b></h2>
            </div>

            <div class="message text-success mt-3 text-center">
              <p id="motivo-status"  class="w3-tag w3-xxlarge w3-padding w3-orange w3-center" style="font-weight:bold; font-size:25px;">Motivo do status</p>
            </div>
          </div>
        </div>
      </div>




@vite('resources/js/app.js')

<script type="module">

$(document).ready(function(){
//acesso nao encontrado 1232
//Cliente Vencido 104
//Liberado 186


    $(document).on('click', '#buscar', function(event) {
        var matricula = $('#matricula').val();
         buscarByMatricula(matricula)
    });


    $(document).keypress(function(event) {
        var matricula = $('#matricula').val();
        if(event.which == 13){
            buscarByMatricula(matricula)
        }

    });

});


function buscarByMatricula(matricula)
       {
        $.get('https://vendas.mufitness.com.br/'+$('#cliente_id').val() +'/aluno/'+matricula+'/byid',function(data){
            var res = data.data;

            $('#foto_avatar').attr('src', res.photoUrl).on('error', function() {
                $(this).attr('src', 'https://photografos.com.br/wp-content/uploads/2020/09/fotografia-para-perfil.jpg');
            });

            if(res.released ==  true){
                execultarTeste()
                document.getElementById("liberado").play();
                $('#nomeAluno').text(res.nome)
                $("#matricula-aluno").text(res.id)
                $('#status').text('LIBERADO')
                $(".message").removeClass('text-danger')
                $(".message").addClass('text-success')
                $("#motivo-status").removeClass('bg-danger')
                $("#motivo-status").removeClass('bg-info')
                $('#motivo-status').addClass('bg-success')
                $('#motivo-status').text(res.text)
            } else {
                $('#nomeAluno').text(res.nome)
                $("#matricula-aluno").text(res.id)
                $('#status').text('BLOQUEADO')
                $(".message").removeClass('text-success')
                $(".message").addClass('text-danger')
                document.getElementById("bloqueado").play();
            }


            if(res.text == 'Cliente Vencido'){
                $("#motivo-status").removeClass('bg-success')
                $('#motivo-status').addClass('bg-danger')
                $('#motivo-status').text(res.text)

            } else if(res.text == 'acesso nao encontrado'){
                $("#motivo-status").removeClass('bg-success')
                $('#motivo-status').addClass('bg-danger')
                $('#motivo-status').text(res.text)
            }


            $("#matricula").val('');
            $("#matricula").focus();
        });

       }


    function execultarTeste()
    {
        $.get('executar-comando', function(data){

    })

    }

</script>
@endsection

