
function erro_004()
{
    $('#foto_avatar').attr('src', '/img/defaultAvatarPng2.png')
    $('#nomeAluno').text('')
    $("#matricula-aluno").text('')
    $('#motivo-status').text('')
    $('#status').text('BLOQUEADO');
    $('#motivo-status').text('Aluno não encontrado');
    $('#motivo-status').removeClass('bg-success');
    $('#motivo-status').addClass('bg-danger');
    $('#buscar_aluno').focus()
    $('#buscar_aluno').val('')

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

        if(res.released ==  true){

            $('.nome_Aluno1').text(res.nome)
            $("#matricula-aluno").text(res.id)
            $('#status').text('LIBERADO')
            $(".message").removeClass('text-danger')
            $(".message").addClass('text-success')
            $("#motivo-status").removeClass('bg-danger')
            $("#motivo-status").removeClass('bg-info')
            $('#motivo-status').addClass('bg-success')
            $('#data_venct').text(formatarDataBr(res.dueDate))
            $('#motivo-status').text(res.text)
            $('.user-status').text(res.text)
            $('#descricaoPlano').text(res.descricaoPlano)
            $('#acessoMsg').text(res.acessoMsg)
            document.getElementById("liberado").play();
            showNotification()
            execultarApp()
        } else {
            $('#nomeAluno').text(res.nome)
            $("#matricula-aluno").text(res.id)
            $('#status').text(res.status)
            $(".message").removeClass('text-success')
            $(".message").addClass('text-danger')
            $('#data_venct').text(formatarDataBr(res.dueDate))
            $('#descricaoPlano').text(res.descricaoPlano)
            $('#acessoMsg').text(res.text)
            $('.user-status').text(res.text)

            document.getElementById("bloqueado").play();
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

        $("#matricula").val('');
        $("#matricula").focus();
        $('#buscar_aluno').focus()
        $('#buscar_aluno').val('')
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
    }
