@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<style>
    body {
      background-color: #f5f5f5;
    }

    .config-container {
      background-color: #ffffff;
      border-radius: 5px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 30px;
    }

    .form-check-label {
      font-weight: 500;
    }
    #flexSwitchCheckDefault{

    }
  </style>
    <div class="container mt-5">

        <h1 class="mb-4" style="color:#fff;">Configuração de Controle de Acesso</h1>

        <div class="row bg-light">
            <div class="col-md-6 col-6">
                <div class="form-check form-switch my-3">
                    <label class="form-check-label" for="flexSwitchCheckDefault">CPF</label>
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                </div>

                <div class="form-check form-switch my-3">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Telefone residêncial</label>
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                </div>

                <div class="form-check form-switch my-3">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Telefone celular</label>
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                </div>

                <div class="form-check form-switch my-3">
                    <label class="form-check-label" for="flexSwitchCheckDefault"> Endereço</label>
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                </div>

                <div class="form-check form-switch my-3">
                    <label class="form-check-label" for="flexSwitchCheckDefault"> Promotor de venda</label>
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                </div>

                <div class="form-check form-switch  my-3">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Tipo sanguineo orbigátorio</label>
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                </div>

                <div class="form-check form-switch  my-3">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Estado Civil</label>
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                </div>

                <div class="form-check form-switch  my-3">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Email obrigátorio a partir de </label>
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                </div>

                <div class="form-check form-switch  my-3">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Permitir logar estando inativo</label>
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                </div>

                <div class="form-check form-switch  my-3">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Permitir reservar aula coletiva estando inativo</label>
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                </div>
            </div>
            <div class="col-6 my-3">
                <div class="form-switch">
                    <label class="form-check-label" >CPF</label>
                    <input class="form-control" type="text">
                </div>

                <div class="form-switch my-4">
                    <label class="form-check-label" >CPF</label>
                    <input class="form-control" type="text">
                </div>
            </div>

        </div>
    </div>
</div>




@vite('resources/js/app.js')

<script type="module">

</script>
@endsection

