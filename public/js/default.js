
$(document).ready(function(){


    const vendas_url = 'http://localhost:8001'
    const contrato = $('#cliente_id').val()


    getMultiFiliais(empresaId)
    getNativa(empresaId)
    getEmpresasByIdweb(vendas_url, empresaId)
    getLogo(contrato)


    $(".liberacaoManual").click(function() {
        execultarApp()
     });



    $(document).on('change', '#id_filial', function(event) {
        $('#buscar_aluno').val('');
        var idweb = $(this).val();
        var formattedId = String(idweb).padStart(3, '0');

        if(formattedId == '000'){
            formattedId = $('#nativaId').val()
        }

        getEmpresasByIdweb(vendas_url, formattedId)
    });



        $('#buscar_aluno').on('keyup', function() {
            var searchText = $(this).val().toLowerCase();
            $('#alunos_multifilai').show();

            $('#alunos_multifilai option').each(function() {
                var currentOption = $(this);
                var currentOptionText = currentOption.text().toLowerCase();

                if (currentOptionText.indexOf(searchText) !== -1) {
                    currentOption.show();
                } else {
                    currentOption.hide();
                }
            });
        });


        $('#alunos_multifilai').on('change', function() {
            var selectedOption = $(this).find(':selected');
            $('#buscar_aluno').val(selectedOption.text());
            $('#matricula').val(selectedOption.val());
            $('#alunos_multifilai').hide();
        });



        $(document).on('click', function(e) {
            if (!$(e.target).is('#alunos_multifilai, #buscar_aluno')) {
                $('#alunos_multifilai').hide();
            }
        });



        $('#buscar_aluno').on('focus', function() {
            $('#alunos_multifilai').show();
        });



        $(document).on('click', '#buscar', function(event)
        {
            var matricula = $('#matricula').val();

            var empresa = $('#id_filial').val();

            if(empresa == '')
            {
               empresa = $('#nativaId').val()

            }

            var empresaFormate = String(empresa).padStart(3, '0');

            if(matricula == '')
            {
                alert('Matricula não encontrada')
            }

            buscarByMatricula(vendas_url,empresaFormate, matricula)

                  // Exemplo de dados a serem enviados
                var data = {
                    id_fornecedores_despesas: 1,
                    id_web: 2,
                    nativa: true
                };

             //cadastrarRedesQuandoForPrimeiroAcesso(vendas_url, data);
        });



        $(document).keypress(function(event) {
            var matricula = $('#matricula').val();
            if(event.which == 13){
                buscarByMatricula(matricula)
            }

        });
    });



    async function cadastrarRedesQuandoForPrimeiroAcesso(vendas_url, data) {
        try {
          const response = await fetch(vendas_url+"/"+empresaId+"/redes/store", {
            method: "POST",
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
          });

          if (response.ok) {
            const responseData = await response.json();
            console.log("Requisição bem-sucedida:", responseData);

          } else {
            console.error("Erro na requisição:", response.status, response.statusText);

          }
        } catch (error) {
          console.error("Erro na requisição:", error);

        }
      }


      function formatarDataBr(data)
      {
        let partes = data.split('-');
        let dataBr = [partes[2], partes[1], partes[0]].join('/');
        return dataBr;
      }



    function getLogo(contrato)
    {
        let logo = `http://127.0.0.1/projetos/mu.fitness.gestao/Pessoas/${contrato}/Empresa/logo_001.png?rd=`+1235;
        $('#logo').attr('src', logo)
    }


    function buscarByMatricula(vendas_url,empresaId, matricula)
    {
        $('#foto_avatar').fadeOut();;

        $.ajax({
            url: vendas_url+'/'+empresaId+'/aluno/'+matricula+'/byid',
            statusCode: {
            404: function(data) {
                erro_004()

        },
        403: function(data) {
            erro_403()

          }

      },
      success: function(data) {
        var res = data.data;
        success_response(res)

      }
    });


        }


        function toggleFullscreen()
        {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        }


        function showNotification()
        {
            $(".notification-box").slideDown(500, function () {
                setTimeout(function () {
                    $(".notification-box").slideUp(500);
                }, 3000); // A notificação desaparece após 3 segundos
            });
        }


        function execultarApp()
        {
            $.get('/executar-comando', function(data){ })
        }

        function getEmpresasByIdweb(vendas_url, idweb)
        {
            var formattedId = String(idweb).padStart(3, '0');

            $.get(vendas_url+'/'+ formattedId+'/alunosmf', function(data){

                $('#alunos_multifilai').empty();

                // Preencher o select com os dados recebidos
                data.forEach(function(item){
                    $('#alunos_multifilai').append('<option value="' + item.id + '">' +item.id + '-' +item.name + '</option>');
                });
            });

        }



        function getMultiFiliais(idweb) {
            $.get('api/legado/' + idweb + '/multifilial', function (data) {

                // Filtrar data para excluir as filiais com nativa igual a 1
                const filteredData = data.filter(filial => filial.nativa !== "1");

                // Limpar opções existentes
                $('#id_filial').empty();

                // Adicionar opção "Selecione"
                let selectOption = new Option('Nativa', '');
                $('#id_filial').append(selectOption);

                for (let i = 0; i < filteredData.length; i++) {
                    let option = new Option(filteredData[i].id_web + '/' + filteredData[i].nome_empresa, filteredData[i].id_web);
                    $('#id_filial').append(option);
                }

            });


        }


        function getNativa(idweb)
        {
            $.get('api/legado/' + idweb + '/multifilial', function (data) {

                // Filtrar data para excluir as filiais com nativa igual a 1
                const nativa = data.filter(filial => filial.nativa == "1");

               var idWebNativa = nativa[0].id_web
                $('#nativaId').val(idWebNativa)

            });
        }


        function erro_004()
        {
            $('#foto_avatar').attr('src', 'https://photografos.com.br/wp-content/uploads/2020/09/fotografia-para-perfil.jpg')
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
                $('#foto_avatar').attr('src', 'https://photografos.com.br/wp-content/uploads/2020/09/fotografia-para-perfil.jpg')
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
                    $(this).attr('src', 'https://photografos.com.br/wp-content/uploads/2020/09/fotografia-para-perfil.jpg');
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







