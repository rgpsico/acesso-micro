
function erro_004()
{

    $('#foto_avatar').attr('src', '/img/defaultAvatarPng2.png')
    $('.nome_Aluno1').text('')
    $("#matricula-aluno").text('')
    $('#motivo-status').text('')
    $('#motivo-status').text('Aluno não encontrado');
    $('#motivo-status').removeClass('bg-success');
    $('#motivo-status').addClass('bg-danger');

}



    function erro_403()
    {
        $('#foto_avatar').attr('src', '/img/defaultAvatarPng2.png')
        $('#nomeAluno').text('')
        $("#matricula-aluno").text('Bloqueio Manual')
        $('#motivo-status').text('Bloqueio Manual')
        $('#status').text("Bloqueio Manual");
        $('#motivo-status').text("Bloqueio Manual");
        $('#motivo-status').removeClass('bg-success');
        $('#motivo-status').addClass('bg-danger');
        $('#buscar_aluno').focus()
        $('#buscar_aluno').val('')
    }

    function success_response(res)
    {

        $('#foto_avatar').attr('src', res.photoUrl).on('error', function() {
            $(this).attr('src', '/img/defaultAvatarPng2.png');
        }).fadeIn();


        if(res.released ==  true)
        {
            $('.nome_Aluno1').text(res.nome)
            $("#matricula-aluno").text(res.id)
            $('#descricaoPlano').text(res.descricaoPlano ?? 'Sem plano')
            $('#data_venct').text(formatarDataBr(res.dueDate ?? ''))
            $('.motivo-statu').text(res.text)
            $('#motivo-status').text(res.text)
            $("#motivo-status").removeClass('bg-danger bg-info  bg-warning ')
            $("#motivo-status").addClass('bg-success')
            $('#motivo-status').text("LIBERADO")


            if(aConfiguracaoEstaAtiva(getUrlVendas(),empresaId, 'ativar_som_acesso')){
                document.getElementById("liberado").play();
            }

            if(aConfiguracaoEstaAtiva(getUrlVendas(),empresaId, 'liberar_catraca_rele')){
                execultarApp()
            }

            showNotification()
            return;

        } else {

            try {
                gympass = JSON.parse(res);

                if(verificarSeEGympass(gympass)){
                 return;
                }

            } catch (error) {

            }


            $('.nome_Aluno1').text(res.nome)
            $("#matricula-aluno").text(res.id)
            $('#descricaoPlano').text(res.descricaoPlano ?? 'Sem plano')
            $('#data_venct').text(formatarDataBr(res.dueDate ?? ''))
            $('.motivo-statu').text(res.text)
            $("#motivo-status").removeClass('bg-warning')
            $("#motivo-status").addClass('bg-danger')
            $('#motivo-status').text(res.text)
            return;

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


    }

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

    function limparCard()
    {
        $('#foto_avatar').fadeOut()
        $('#foto_avatar').attr('src','').on('error', function() {
            $(this).attr('src', '/img/defaultAvatarPng2.png');
        }).fadeIn();

        $(".nome_Aluno1").text('NOME DO ALUNO');
        $("#matricula-aluno").text('');
        $('#descricaoPlano').text('')
        $('#data_venct').text(' ')
        $('#acessoMsg').text('')

        $("#motivo-status").removeClass('bg-success bg-danger ')
        $('#motivo-status').addClass('bg-warning')
        $('#motivo-status').text('Espera')
    }

    function verificarSeEGympass(gympass)
    {

        $('.modal-body').empty();

        if(gympass['metadata']['total'] == 1)
        {
            produto = gympass['results']['gym']['product']['description']
            gympass_id = gympass['results']['user']['gympass_id']
            let validated_at = gympass['results']['validated_at'];
            var selectedId = $('#gympassSelect').val();




        $('.nome_Aluno1').text('Aluno Gympass');
        $('#matricula-aluno').text(selectedId);
        $('#descricaoPlano').text(produto);
        $('#data_venct').text(validated_at);
        $('#acessoMsg').text('Gympass');
        $('#motivo-status').text('Liberado')
        $('#motivo-status').removeClass('bg-danger bg-warning')
        $('#motivo-status').addClass('bg-success')
        return true;
        }
    }
