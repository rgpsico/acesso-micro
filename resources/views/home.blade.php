@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<audio id="liberado" src="{{ asset('music/success.mp3') }}"></audio>
<audio id="bloqueado" src="{{ asset('music/error.mp3') }}"></audio>
 
  <button id="fullscreenToggle">
    <i class="fas fa-expand"></i>
  </button>

<style>
  .notification-box {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 250px;
    height: 200px;
    background-color: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    padding: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.notification-content {
    display: flex;
    align-items: center;
}

.user-status {
    font-size: 14px;
    color: #333333;
}
</style>

<div class="notification-box" style="display:none;">
  <div class="notification-content">
      <span class="user-status">Usuário entrou</span>
  </div>
</div>
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
      showNotification()
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
        var contrato = $('#cliente_id').val() 
        $('#foto_avatar').fadeOut();;
        $.get('https://vendas.mufitness.com.br/'+502+'/aluno/'+matricula+'/byid',function(data){
            var res = data.data;

            $('#foto_avatar').attr('src', res.photoUrl).on('error', function() {
                $(this).attr('src', 'https://photografos.com.br/wp-content/uploads/2020/09/fotografia-para-perfil.jpg');
            }).fadeIn();;
            showNotification() 
            if(res.released ==  true){
                $('#nomeAluno').text(res.nome)
                $("#matricula-aluno").text(res.id)
                $('#status').text('LIBERADO')
                $(".message").removeClass('text-danger')
                $(".message").addClass('text-success')
                $("#motivo-status").removeClass('bg-danger')
                $("#motivo-status").removeClass('bg-info')
                $('#motivo-status').addClass('bg-success')
                $('#motivo-status').text(res.text)
                $('.user-status').text(res.text)
                $('#app').removeClass('bg-dark')
               

                document.getElementById("liberado").play();
               
            } else {
                $('#nomeAluno').text(res.nome)
                $("#matricula-aluno").text(res.id)
                $('#status').text('BLOQUEADO')
                $(".message").removeClass('text-success')
                $(".message").addClass('text-danger')
                $('.user-status').text(res.text)
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

       $("#fullscreenToggle").on("click", function() {
        toggleFullscreen();
    });

       function toggleFullscreen() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    }


    function showNotification() {
    $(".notification-box").slideDown(500, function () {
        setTimeout(function () {
            $(".notification-box").slideUp(500);
        }, 3000); // A notificação desaparece após 3 segundos
    });
}


    function execultarTeste()
    {
        $.get('executar-comando', function(data){

    })

    }

</script>
@endsection

