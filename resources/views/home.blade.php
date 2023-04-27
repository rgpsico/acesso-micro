@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <audio id="liberado" src="{{ asset('music/success.mp3') }}"></audio>
    <audio id="bloqueado" src="{{ asset('music/error.mp3') }}"></audio>

    <button id="fullscreenToggle">
        <i class="fas fa-expand"></i>
    </button>


    <input type="hidden" name="cliente_id" id="cliente_id" value="{{ env('CLIENTE') }}">




    <x-notificationbox />

    <div class="container acesso">
        <div class="row">
            <div class="form-group mb-2 col-4">
                <label for="matricula" class="label"></label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Matrícula" id="matricula">
                    <div class="input-group-append">
                        <button class="btn btn-primary ml-2" type="button" id="buscar">Buscar</button>
                    </div>
                </div>
            </div>

            <div class="col-7 d-flex justify-content-center  my-4 " style="height:45px; font-size:14px;">
                <span id="clock" class="bg-light"></span>
            </div>

            <div class="col-1 d-flex justify-content-end h-50 my-4">
                <img src="" id="logo" alt="" height="40" width="100">
            </div>
        </div>


        <div class="card p-2">
            <div class="card-header text-center" style="min-height:300px; max-height:300px;">
                <img src="https://photografos.com.br/wp-content/uploads/2020/09/fotografia-para-perfil.jpg"
                    alt="Imagem do aluno" class="img-thumbnail" id="foto_avatar" width="280px" height="250px">
            </div>
            <div class="card-body">
                <div class="text-center">
                    <h1 class="card-title" id="nomeAluno">Nome do Aluno</h1>
                    <h2 class="card-text">Matrícula: <b id="matricula-aluno"></b></h2>
                    <h3 class="card-text">Plano: <b id="descricaoPlano"></b></h3>
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
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="module">

$(document).ready(function(){
//acesso nao encontrado 1232
//Cliente Vencido 104
//Liberado 186


const contrato = $('#cliente_id').val()
getLogo(contrato)



    $(document).on('click', '#liberacaoManual', function(event) {
        execultarTeste()
    });

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




    $('#menu-flutuante').mouseenter(function() {
        $('#menu-opcoes').slideDown('fast');
        $('#menu-opcoes').removeClass('d-none');
    });

    $('#menu-opcoes').mouseleave(function() {
        $('#menu-opcoes').addClass('d-none');
          $('#menu-opcoes').removeClass('d-block');

    });

    $("#fullscreenToggle").on("click", function() {
        toggleFullscreen();
    });

});

    function getLogo(contrato)
    {
        let logo = `http://127.0.0.1/projetos/mu.fitness.gestao/Pessoas/${contrato}/Empresa/logo_001.png`;
        $('#logo').attr('src', logo)
    }


    function buscarByMatricula(matricula)
    {
        $('#foto_avatar').fadeOut();;

        $.ajax({
  url: 'http://localhost:8001/'+306+'/aluno/'+matricula+'/byid',
  statusCode: {
    404: function() {
        $('#foto_avatar').attr('src', 'https://photografos.com.br/wp-content/uploads/2020/09/fotografia-para-perfil.jpg')
      $('#nomeAluno').text('')
      $("#matricula-aluno").text('')
      $('#motivo-status').text('')
      $('#status').text('BLOQUEADO');
      $('#motivo-status').text('Aluno não encontrado');
      $('#motivo-status').removeClass('bg-success');
      $('#motivo-status').addClass('bg-danger');

    }
  },
  success: function(data) {
    var res = data.data;

    $('#foto_avatar').attr('src', res.photoUrl).on('error', function() {
      $(this).attr('src', 'https://photografos.com.br/wp-content/uploads/2020/09/fotografia-para-perfil.jpg');
    }).fadeIn();

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
      $('#descricaoPlano').text(res.descricaoPlano)
      $('#acessoMsg').text(res.acessoMsg)
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

    if(res.text == 'Cliente Vencido') {
      $("#motivo-status").removeClass('bg-success')
      $('#motivo-status').addClass('bg-danger')
      $('#motivo-status').text(res.text)
    } else if(res.text == 'acesso nao encontrado') {
      $("#motivo-status").removeClass('bg-success')
      $('#motivo-status').addClass('bg-danger')
      $('#motivo-status').text(res.text)
    }

    $("#matricula").val('');
    $("#matricula").focus();
  }
});


    }


    function toggleFullscreen()
    {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    }


    function showNotification()
    {
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

    const clock = document.getElementById("clock");

        // Atualiza o relógio a cada segundo
        setInterval(() => {
        // Cria um objeto Date com a hora atual
        const now = new Date();

        // Formata a hora e o minuto como texto
        const hours = now.getHours().toString().padStart(2, "0");
        const minutes = now.getMinutes().toString().padStart(2, "0");
        const seconds = now.getSeconds().toString().padStart(2, "0");

        // Define o conteúdo do span com a hora e o minuto
        clock.textContent = `${hours}:${minutes}:${seconds}`;
        }, 1000);

</script>
@endsection
