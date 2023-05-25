<!-- basic modal -->

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }
    .modal-content-micro {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
    }
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
    .form-label {
        font-weight: bold;
    }
</style>


<script src={{ asset('js/tostr.js') }}></script>
<link rel="stylesheet" href="{{ asset('css/tostr.css') }}">


<div id="modal_micro" class="modal">

    <div class="modal-content-micro">
        <div class="row">
            <div class="col-11">
                <h2>Micro acesso - Justificar Liberação</h2>
            </div>
            <div class="col-1">
                <span id="fecharModal" class="close">&times;</span>
            </div>
        </div>
        <div class="modal-body-micro my-2">
            <div class="row form-container">
                <input type="hidden" name="idweb" id="idweb" class="form-control">
               <x-usercomponent/>
                <div class="col-4">
                    <label for="" class="form-label mb-0">Password:</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <div class="valid-feedback">
                        Ok
                    </div>

                    <div class="invalid-feedback">
                        Ok
                    </div>
                </div>
                <div class="col-2 my-4">
                    <button class="btn btn-success" id="logar">Logar</button>
                </div>

                <div class="form-group col-12 mb-0">
                    <label for="" class="form-label mb-0">Tipo de Entrada</label>
                    <div class="d-flex align-items-center">
                        <input type="radio" name="tipo_entrada" checked id="tipo_entrada"  class="mr-2 tipo_entrada" value="aluno">
                        <label for="aluno" class="form-label  mr-5"  style="margin:5px;">Aluno</label>
                        <input type="radio" name="tipo_entrada" id="tipo_entrada" style="margin:5px;" class="mr-2 tipo_entrada" style="margin-left:20px;" value="outros">
                        <label for="outros" class="form-label">Outros</label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="" class="form-label m-0 label-aluno">Alunos:</label>
                         <input type='txt' name="nomeAluno" id="nomeAluno"  class="form-control" autocomplete="off">
                         <input type='txt' name="aluno_id" id="aluno_id"  class="form-control" style="display:none;">

                    </div>

                    <div class="form-group col-6 quando_for_numero">
                        <label for="" class="form-label m-0 label-aluno">Nome:</label>
                        <select name="nomeAluno_by_matricula" id="nomeAluno_by_matricula" class="form-control js-states">
                        </select>
                        <div id="message" style="display: none;"></div>
                    </div>

                    <x-justificativacomponent/>


                    <div class="col-12 my-2">
                        <label for="descricao" class="form-label mb-0">Descrição</label>
                        <textarea name="descricao" class="form-control" id="descricao" cols="10" rows="5"></textarea>
                    </div>
                 </div>



                <div class="col-12 d-flex justify-content-end my-3">
                    <span><button class="btn btn-success" id="salvar" name="salvar" disabled>Salvar</button></span>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
  $(document).ready(function(){

    $(document).on({
    ajaxStart: function() {
        $("#message").show().text("Buscando aluno...");
    },
    ajaxStop: function() {
        $("#message").text("Alunos localizados").delay(3000).fadeOut();
    }
});
    getJustificativas(getUrlVendas() , empresaId)
    getUsers(getUrlVendas() , empresaId)

    function getJustificativas(vendas_url_local, idweb)
        {
            var formattedId = String(idweb).padStart(3, '0');
            $.get(vendas_url_local+'/'+ formattedId+'/justificativa/all', function(data){
                $('#justificativa').empty();

                data.forEach(function(item){
                    $('#justificativa').append('<option value="' + item.id + '">' +item.id + '-' +item.justificativa + '</option>');
                });
            });

        }

        function getUsers(vendas_url_local, idweb)
        {
            var formattedId = String(idweb).padStart(3, '0');
            $.get(vendas_url_local+'/'+ formattedId+'/users/all', function(data){
                $('#user').empty();

                data.forEach(function(item){
                    $('#user').append('<option value="' + item.id_usuario + '" data-name='+item.nome+'>' +item.id_usuario + '-' +item.nome + '</option>');
                });
            });

        }






$('#nomeAluno').on('keyup', function() {
    var query = $(this).val();
    $("#nomeAluno_by_matricula").val('')

    if (query.length >= 3 && isNaN(query) )
    {
        $('.quando_for_numero').show();
        $('#nomeAluno_by_matricula').show()
        $.get(getUrlVendas() +'/'+empresaId+'/aluno/byname', { name: query }, function(data) {

            var options = '<option></option>';
            $.each(data, function(key, value) {
                if(value.razao_social != ''){
                    options += '<option selected data-empresa_origem='+value.empresa+' value="' + value.id_fornecedores_despesas + '">' + value.razao_social + '</option>';
                }

            });
            $('#nomeAluno_by_matricula').html(options);
        }, 'json');
        return;
    }

    getAlunoById(getUrlVendas(), empresaId, query)
});



function getAlunoById(vendas_url_local, idweb, matricula)
{

    var formattedId = String(idweb).padStart(3, '0');
    $.get(vendas_url_local+formattedId+'/aluno/justificativa/'+matricula+'/byid', function(data){


        if(data.data.lenght == 0)
         {
            $('#nomeAluno_by_matricula').val('')
            $('#aluno_id').val('')
         }


        $('#aluno_id').val(data.data.id);

        var item = data.data;

        $('#nomeAluno_by_matricula').append('<option value="' + item.id + '" data-name='+item.nome+'>' +item.id + '-' +item.nome + '</option>');
    return;
    });

}








    $('#nomeAluno').on('change', function() {
        $("#nomeAluno_by_matricula").val('')
    })


    $('#nomeAluno_by_matricula').on('click', function() {
        var selectedOption = $(this).find(':selected');
        $('#nomeAluno').val(selectedOption.text());
        $('#aluno_id').val(selectedOption.val());

    });


    $('.tipo_entrada').click(function(){

        if($(this).val() == 'aluno')
        {
            $('#label-aluno').show()
            $('#nomeAluno').show()
            $('#aluno').show()
            return;
        }

        $('#nomeAluno').hide()
        $('#aluno').hide()
        $('.label-aluno').hide()
        $('.aluno').hide()

    })

    $('#logar').click(function(){

    var selectedNome = $('#user').find(":selected").data("name");
    var token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: getUrlVendas() +empresaId+'/auth',
        dataType: 'json',
        method: 'POST',

        data: {
            nome:selectedNome,
            senha: $('#password').val(),
        },
        success: function(response){
            $("#salvar").prop('disabled', false)
            $('#password').removeClass('is-invalid').addClass('is-valid');
            $('.valid-feedback').text('Logado com sucesso!');
            $('.valid-feedback').show()
        },
        error: function(xhr, status, error){
            $("#salvar").prop('disabled', true)

            $('#password').removeClass('is-valid').addClass('is-invalid');
            $('.invalid-feedback').text('Erro ao fazer login!');
        }
    });






    $(document).on('click', '#salvar', function(event) {
        event.preventDefault();
        var id_user = $('#user').val();

        var nome = $('#nome').val();
        var descricao = $('#descricao').val();
        var id_aluno = $('#aluno_id').val();



        if($('#nomeAluno').val() == '')
        {
            alert('O aluno é  obrigatório')
            return;
        }

        var tipo_entrada = $('input[name="tipo_entrada"]:checked').val();

        if(tipo_entrada == 'outros'){
            id_aluno = 0;
        }


        var justificativa = $('#justificativa :selected').text()

        $.ajax({
            url: getUrlVendas() +'/'+empresaId+'/acesso/store',
            type: 'POST',
            data:{
                "id_fonecedor":id_aluno,
                "status_acesso": "AP",
                "liberado_por": id_user,
                "motivo_liberacao": justificativa,
                "ambiente": 1,
                "id_empresa_acesso":$('#cliente_id').val(),
                "descricao_acesso":descricao,
                "id_empresa_origem":$('#nativaId').val(),
                "id_empresa_local":$('#cliente_id').val(),
                "tipo_liberacao":"JUSTIFICADA"
            },
            success: function(response, status){

                if(status == 'success')
                {
                    alert('Justificativa Salva com sucesso')
                    $("#salvar").prop('disabled', true)

                    $.get(urlExe, function(data){

                        $('#password').removeClass('is-valid')

                        $('#user').val('')
                        $('#nome').val('')
                        $("#nomeAluno").val('')
                        $('#descricao').val('')
                        $('#aluno_id').val('')
                        $('#modal_micro').fadeOut();
                })
            }
            },
            error: function(xhr, status, error){
                // Callback de erro
                console.log(error);
            }
        });
    })

});




});


</script>


