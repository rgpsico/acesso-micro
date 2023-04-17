@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


<div class="container acesso">
    @include('sidebar')

    <div class="my-4">
        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Security</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Notifications</a>
            </li>
        </ul>
        <h5 class="mb-0 mt-5">Settings</h5>
        <p>These settings are helps you keep your account secure.</p>
        <section>
        <div class="list-group mb-5 shadow">
            <div class="list-group-item">
                <div class="row align-items-center border-1">
                    <div class="col">
                        <strong class="mb-2">Bloqueio</strong>
                        <p class="text-muted mb-0">TESTE</p>
                    </div>
                    <div class="col-auto">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="activityLog" checked="">
                            <span class="custom-control-label"></span>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center my-4">
                    <div class="col">
                        <strong class="mb-2">Carteira</strong>
                        <p class="text-muted mb-0">TEste</p>
                    </div>
                    <div class="col-auto">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="activityLog" checked="">
                            <span class="custom-control-label"></span>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center my-4">
                    <div class="col">
                        <strong class="mb-2">Documento</strong>
                        <p class="text-muted mb-0">TEste</p>
                    </div>
                    <div class="col-auto">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="activityLog" checked="">
                            <span class="custom-control-label"></span>
                        </div>
                    </div>
                </div>



            </div>
        </div>
      </section>


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

