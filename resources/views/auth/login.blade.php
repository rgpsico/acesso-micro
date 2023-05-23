@extends('layouts.app')

@section('content')
@php

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$pathSegments = explode('/', parse_url($url, PHP_URL_PATH));

// Obter os valores de empresaId e nomeUsuario
$empresaId = $pathSegments[count($pathSegments) - 2];
$nomeUsuario = $pathSegments[count($pathSegments) - 1];


@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Acesso') }}</div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <input type="hidden" id="empresaID" name="empresaID" value="004">

                        <div class="row mb-3">
                            <label for="nome" class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="nome"
                                type="text"
                                 class="form-control @error('nome') is-invalid @enderror"
                               value="{{$nomeUsuario }}"

                                   autofocus>

                                @error('nome')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="senha" type="password" class="form-control @error('senha') is-invalid @enderror" name="senha" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="logar">
                                    {{ __('Login') }}
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <span id="clock" class="bg-dark d-flex"></span>
    </div>
</div>


<script>
  $(document).ready(function(){




try {
    if (decodedToken) {
    window.location.href = "/home";
} else {
    window.location.href = "/login";
}
} catch (error) {

}




    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



    $(document).on('click', '#logar', function(event) {
        event.preventDefault();

        // Obtenha os valores dos campos
        var idweb = $('#empresaID').val();

        var formattedId = String(idweb).padStart(3, '0');
        var nome = $('#nome').val();
        var senha = $('#senha').val();

        // Crie um objeto com os dados a serem enviados
        var data = {
            idEmpresa: formattedId,
            nome: nome,
            senha: senha
        };

        // Faça a chamada AJAX
        $.ajax({
            url: '/api/'+formattedId+'/authUrl', // Substitua pela URL correta
            method: 'POST',
            data: data,
            success: function(response)
            {
               if(response.content == 'success'){
               // const token = generateToken(user, permissions);
                 window.location.href = "/home";

                 return;
               }
               alert(response.content)

            },
            error: function(xhr, status, error) {
                alert('Erro'+error)
                console.log(error);
            }
        });
    });
});

</script>
@endsection
