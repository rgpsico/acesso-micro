@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


<div class="container acesso">
    @include('sidebar')

    <div class="my-4">
        <h5 class="mb-0 mt-5">Configurações</h5>
        <p></p>
        <section>
        <div class="list-group mb-5 shadow">
            <div class="list-group-item">
                <div class="row align-items-center border-1">
                    <div class="col">
                        <strong class="mb-2">Bloqueio</strong>
                        <p class="text-muted mb-0">Teste</p>
                    </div>
                    <div class="col-auto">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="bloqueio" checked="">
                            <span class="custom-control-label"></span>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center my-4">
                    <div class="col">
                        <strong class="mb-2">Carteira</strong>
                        <p class="text-muted mb-0">Teste</p>
                    </div>
                    <div class="col-auto">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="carteira" checked="">
                            <span class="custom-control-label"></span>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center my-4">
                    <div class="col">
                        <strong class="mb-2">Documento</strong>
                        <p class="text-muted mb-0">Teste</p>
                    </div>
                    <div class="col-auto">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="documento" checked="">
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

});

</script>
@endsection

