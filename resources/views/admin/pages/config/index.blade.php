@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<style>
     .container {
      background-color: #ffffff;
      border-radius: 5px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      height: 660px;
    }

    .form-check-label {
      font-weight: 500;
    }

  </style>

    <div class="container">
        <div class="col-12 p-2 d-flex  justify-content-end my-2 mr-2 " style="margin-top:20px; text-align:center; ">
            <span id="clock" class="bg-dark  d-flex" ></span>
        </div>
        <h1 style="color:#000; margin-top:10px;">Configuração de Controle de Acesso</h1>

        <div class="row bg-light">
            <div class="col-md-6 col-6">
                <div class="form-check form-switch  my-3">
                    <label class="form-check-label" for="">Justificativa</label>
                    <input class="form-check-input" type="checkbox" id="justificativa">
                </div>
            </div>


        </div>
    </div>
</div>




@vite('resources/js/app.js')

<script type="module">
    function updateConfiguracao(nomeConfiguracao, status){
        $.ajax({
            url: '/api/configuracao/update',
            type: 'PUT',
            data: {
                nomeConfiguracao: nomeConfiguracao,
                status: status
            },
            success: function(response){
                if(response.status == 'success')
                {
                    window.location.reload()
                }

            },
            error: function(xhr, status, error){
                console.log(error);
            }
        });
    }


$(document).ready(function(){

$(document).on('click', "#justificativa", function(){

    var status = $(this).prop('checked') ? 'on' : 'off';
        updateConfiguracao('JUSTIFICATIVA', status)
    })




})
</script>
@endsection

