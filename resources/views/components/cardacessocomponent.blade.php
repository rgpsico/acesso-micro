<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="container acesso">
''
<div class="row">
    <input type="hidden" id="tempoReloadCard" >

    <div class="form-group col-12 col-md-10 d-flex align-items-center">
        <img src="" id="logo" alt="" height="40" width="100" class="img-fluid">
        <select name="" id="select_id_filial" class="form-select mr-2 col-12 col-md-auto">
        </select>

        <input type="hidden" id="nativaId" class="form-control" >
        <input id="inputField" type="text" class="form-control col-3" style="width:30%; border-radius:0;" placeholder="Buscar por Matricula ou Nome">

        <select id="selectField" class="form-control" style="width:20%; display: none; border-radius:0;"></select>

        <button class="btn-desktop" type="button" id="buscar" style="margin-left:5px; border-radius:0;">Buscar</button>

    </div>
    <div class="col-1 my-4">
        <span id="clock" class="col-1 bg-dark justify-content-end"></span>
    </div>




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

<script>


$('#inputField').on('input', function(e) {

    var inputVal = $(this).val();

    var empresa = $('#select_id_filial').val();

    if (empresa == '')
    {
        empresa = $('#nativaId').val();
    }

    $('#selectField').empty();

    if (inputVal.length < 3)
    {
        $('#selectField').hide();


    } else {
        $('#buscar').prop('disabled',true);
        $.ajax({
            url: getUrlVendas() + empresa + '/aluno/byname',
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
                        text: item.razao_social // ou o que quer que seja apropriado para o seu caso
                    }));
                });
                $('#buscar').prop('disabled', false);
            },
            error: function() {
                alert('Erro ao obter dados da API');
            }
        });
    }
});





// var $select = $('#alunos_multifilai').selectize({
//     options: [],

//     optionGroupRegister: function (optgroup) {
//     var capitalised = optgroup.charAt(0).toUpperCase() + optgroup.substring(1);

//     var group = {
//         label: 'Manufacturer: ' + capitalised
//     };

//     group[this.settings.optgroupValueField] = optgroup;

//     return group;
//     },

//     optgroupField: 'manufacturer',

//     labelField: 'name',

//     //searchField: ['name', 'id'],

//     sortField: 'name',
//     openOnFocus: false,
// });


// function getTodosAlunos(url) {
//     $.get(url, function(data) {

//         var selectizeControl = $('#alunos_multifilai')[0].selectize;

//         // Limpar opções existentes
//         selectizeControl.clearOptions();

//         // Preencher o Selectize com os dados recebidos
//         data.forEach(function(item) {
//             selectizeControl.addOption({
//                 manufacturer: item.manufacturer,
//                 value: item.id,
//                 name: item.id+ '-' +item.name
//             });
//         });
//     });
// }

// Chamada de função para carregar os dados





$(document).on('change', '#select_id_filial', function(event) {

        $('#buscar_aluno').val('');

        var idweb = $(this).val();
        var formattedId = String(idweb).padStart(3, '0');

        if(formattedId == '000')
        {
            formattedId =  String($('#nativaId').val()).padStart(3, '0')
        }


        //getEmpresasByIdweb(getUrlVendas(), formattedId)

        // getTodosAlunos(getUrlVendas()+formattedId+'/alunosmf');


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





</script>


