<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="container acesso">
<style>
    .Gympass{
        background:blue;
        color:red;
        font-size: 40px;
    }
    </style>
<div class="row">
    <input type="hidden" id="tempoReloadCard" >
    <input type="hidden" id="X-Gym-Id">
    <input type="hidden" id="gympass-auth-token">
    <div class="form-group col-12 col-sm-12 d-flex align-items-center">
        <img src="" id="logo" alt="" height="40" width="100" class="img-fluid">
        <select name="" id="select_id_filial" class="form-select" style="width:20%;" >
        </select>

        <input type="hidden" id="nativaId" class="form-control" >
        <input id="inputField" type="text" class="form-control" style="width:20%; margin-left:10px; border-radius:0;" placeholder="Buscar por Matricula ou Nome">

        <select id="selectField" class="form-control" style="width:20%; display: none; border-radius:0;"></select>

        <button class="btn-desktop" type="button" id="buscar" style="margin-left:5px; border-radius:0;">Buscar</button>

        <div style="width:20px; margin:10px;">
            <input type="checkbox" class="form-control" id="gympassCheckbox" style="margin-left:5px;">
        </div>

        <div style="margin:5px; width:50%;">
            <select id="gympassSelect" class="form-control gympass-select" style="width:40%; display: none; border-radius:0;"></select>
            <button id="searchButton" class="btn btn-success" style="display:none;">Buscar usuário Gympass</button>
        </div>
    </div>

    <script>

    </script>


    {{-- <div class="col-3 my-4">
        <span id="clock" class="col-1 bg-dark justify-content-end"></span>
    </div> --}}




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

<script src="{{ asset('js/helpers.js') }}">

</script>



<script>
// Função debounce
function debounce(func, wait) {
    var timeout;

    return function executedFunction() {
        var context = this;
        var args = arguments;

        var later = function() {
          timeout = null;
          func.apply(context, args);
        };

        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
};

// Função que faz a chamada para a API
function apiCall(inputVal, empresa) {
    var formattedId = String(empresa).padStart(3, '0');
    $('#buscar').prop('disabled',true);

    $.ajax({
        url: getUrlVendas() + formattedId + '/aluno/byname',
        data: {
            'name': inputVal
        },
        dataType: 'json',
        success: function(data) {
            var selectField = $('#selectField');
            selectField.show();
            selectField.empty();

            // Assumindo que 'data' é uma lista de opções
            $.each(data, function(index, item) {
                selectField.append($('<option>', {
                    value: item.id_fornecedores_despesas,
                    text: item.razao_social
                }));
            });
            $('#buscar').prop('disabled', false);
        },
        error: function() {
            alert('Erro ao obter dados da API');
        }
    });
};

// Criando a função debounced fora do manipulador de eventos
var debouncedApiCall = debounce(apiCall, 500);

$('#inputField').on('input', function(e) {

    $("#gympassSelect").hide()
    $("#searchButton").hide()

    var inputVal = $(this).val();
    var empresa = $('#select_id_filial').val();

    var isAllLetters = /^[a-zA-Z]*$/.test(inputVal);

    if (empresa == '')
    {
        empresa = $('#nativaId').val();
    }

    $('#selectField').empty();

    if (inputVal.length < 3)
    {
        $('#selectField').hide();
    }
    else
    {
        if(isAllLetters){
            // Usando a função debounced
            debouncedApiCall(inputVal, empresa);
        }
    }
});






function getTodosAlunos(url) {
    $.get(url, function(data) {
        var selectizeControl = $('#alunos_multifilai');

    });
}

// Chamada de função para carregar os dados





$(document).on('change', '#select_id_filial', function(event) {

        $('#buscar_aluno').val('');

        var idweb = $(this).val();
        var formattedId = String(idweb).padStart(3, '0');

        if(formattedId == '000')
        {
            formattedId =  String($('#nativaId').val()).padStart(3, '0')
        }


        getEmpresasByIdweb(getUrlVendas(), formattedId)

        getTodosAlunos(getUrlVendas()+formattedId+'/alunosmf');


    });


function getEmpresasByIdweb(vendas_url_local, idweb)
        {
            var formattedId = String(idweb).padStart(3, '0');

            $.get(vendas_url_local+'/'+ formattedId+'/alunosmf', function(data){

                $('#alunos_multifilai').empty();

                // Preencher o select com os dados recebidos
                data.forEach(function(item){
                    $('#alunos_multifilai').append('<option value="' + item.id + '">' +item.id + '-' +item.name + '</option>');
                });
            });

            //  getTodosAlunos(getUrlVendas()+idweb+'/alunosmf');

        }




        document.getElementById('gympassCheckbox').addEventListener('change', function() {
            var gympassSelect = document.getElementById('gympassSelect');
            var botaoBuscarGympass = document.getElementById('searchButton');
            if (this.checked) {
                gympassSelect.style.display = 'block';
                botaoBuscarGympass.style.display ='block'
                $('#selectField').hide()
                $('#inputField').val('')
            } else {
                gympassSelect.style.display = 'none';
                botaoBuscarGympass.style.display ='none'
                botaoBuscarGympass.style.display ='none'

            }
        });


        const empresaIdLocal = localStorage.getItem('loginEmpresa')

        function getUrl()
        {
            // pega a URL atual
            const currentUrl = window.location.href;

            // define as URLs para produção e local
            const urlProducao = 'https://vendas.mufitness.com.br/';
            const urlLocal = 'http://localhost:8001';

            // verifica se a URL atual é a URL local
            if (currentUrl.startsWith('https')) {
                return urlProducao;
            } else {
                return urlLocal;
            }
        }

// Agora você pode usar getUrl() para pegar a URL a


        $.get(getUrl()+'/'+empresaIdLocal+'/gympass/checkin/list', function(data) {
            // Preencha o menu suspenso com os dados retornados pela API
            for (var i = 0; i < data.length; i++) {
                var option = document.createElement('option');
                option.value = data[i].gym_id;
                option.text = data[i].first_name;
                $('#gympassSelect').append(option);
            }
        });


        // Quando o botão é pressionado, faça uma requisição POST com o ID selecionado


    $('#searchButton').click(function() {
     var selectedId = $('#gympassSelect').val();
     var selectedName = $('#gympassSelect option:selected').text();

     $.ajax({
        url: 'https://sandbox.partners.gympass.com/access/v1/validate',
        type: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+$('#gympass-auth-token').val(),
            'X-Gym-Id': $('#X-Gym-Id').val()
        },
        data: JSON.stringify({ gympass_id: selectedId }),
        success: function(response) {

            $('.nome_Aluno1').text(selectedName);
            $('#matricula-aluno').text(selectedId);
            $('#descricaoPlano').text('Plano Gympass'); // Substitua por dados reais, se disponíveis
            $('#data_venct').text('Vencimento Gympass'); // Substitua por dados reais, se disponíveis
            $('#acessoMsg').text('Gympass'); // Substitua por dados reais, se disponíveis
            $('#motivo-status').text('Liberado')
            $('#motivo-status').removeClass('bg-danger bg-success bg-warning')
            $('#motivo-status').addClass('bg-dark')
        },
        error: function(jqXHR, textStatus, errorThrown) {
            if (jqXHR.status == 404) {

                $('.nome_Aluno1').text(selectedName);
                $('#matricula-aluno').text(selectedId);
                $('#descricaoPlano').text('');
                $('#data_venct').text('');
                $('#acessoMsg').text('');
                $('#motivo-status').text('Não autorizado')
                $('#motivo-status').removeClass('bg-dark bg-success bg-warning')
                $('#motivo-status').addClass('bg-danger')
            }
        }
    });
});





</script>


