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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
            <input type="hidden" name="id_user" id="id_user" class="form-control">
            <div class="row form-container">
               <x-usercomponent/>
                <div class="col-6">
                    <label for="" class="form-label mb-0">Password:</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <div class="valid-feedback">
                        Ok
                    </div>

                    <div class="invalid-feedback">
                        Ok
                    </div>
                </div>

                <div class="form-group col-12 mb-0">
                    <label for="" class="form-label mb-0">Tipo de Entrada</label>
                    <div class="d-flex align-items-center">
                        <input type="radio" name="tipo_entrada" id="aluno"  class="mr-2 tipo_entrada" value="aluno">
                        <label for="aluno" class="form-label  mr-5" style="margin:5px;">Aluno</label>
                        <input type="radio" name="tipo_entrada" id="outros" style="margin:5px;" class="mr-2 tipo_entrada" style="margin-left:20px;" value="outros">
                        <label for="outros" class="form-label">Outros</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 nome_div">
                        <label for="nome" class="form-label mb-0">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome">
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

    $('.tipo_entrada').click(function(){
        if($(this).val() == 'aluno'){
            $('.nome_div').show()
            return;
        }
        $('.nome_div').hide()
    })

    $('#password').change(function(){
    var selectedEmail = $('#user').find(":selected").data("email");
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/api/auth/login',
        type: 'POST',
        headers: {
                'Authorization': 'Bearer ' + token // Substitua 'token' pelo seu token de autenticação
        },
        data: {
            email:selectedEmail,
            password: $(this).val(),
        },
        success: function(response){
            // Callback de sucesso

            $("#salvar").prop('disabled', false)

            $('#password').removeClass('is-invalid').addClass('is-valid');
            $('.valid-feedback').text('Logado com sucesso!');
        },
        error: function(xhr, status, error){
            $("#salvar").prop('disabled', true)
            console.log(error);
            $('#password').removeClass('is-valid').addClass('is-invalid');
            $('.invalid-feedback').text('Erro ao fazer login!');
        }
    });
});


    $('#salvar').click(function(){
        var id_user = $('#username').val();
        var tipo_entrada = $('input[name="tipo_entrada"]:checked').val();
        var nome = $('#nome').val();
        var descricao = $('#descricao').val();
        var obs = $('#obs').val();

        $.ajax({
            url: 'api/justificativa/store',
            type: 'POST',
            data: {
                id_user: id_user,
                tipo_entrada: tipo_entrada,
                nome: nome,
                descricao: descricao,
                obs: obs
            },
            success: function(response){
                // Callback de sucesso
                console.log(response);
            },
            error: function(xhr, status, error){
                // Callback de erro
                console.log(error);
            }
        });
    })
});

</script>