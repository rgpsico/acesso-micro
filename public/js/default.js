
$(document).ready(function(){
    getMultiFiliais(empresaId)
    getNativa(empresaId)
    getEmpresasByIdweb(vendas_url_local, empresaId)
    getLogo(empresaId)





    $(document).on('click', '.liberacaoManual', function(event) {
        execultarApp()
     });



    $(document).on('click', '.liberacaoJustificada', function(event) {
        $('#password').val('')
        $("#modal_micro").fadeIn();
      });



    $(document).on('change', '#id_filial', function(event) {
        $('#buscar_aluno').val('');

        var idweb = $(this).val();
        var formattedId = String(idweb).padStart(3, '0');

        if(formattedId == '000')
        {
            formattedId = $('#nativaId').val()
        }


        getEmpresasByIdweb(vendas_url_local, formattedId)


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

            buscarByMatricula(vendas_url_local,empresaFormate, matricula)

                  // Exemplo de dados a serem enviados
                var data = {
                    id_fornecedores_despesas: 1,
                    id_web: 2,
                    nativa: true
                };

             //cadastrarRedesQuandoForPrimeiroAcesso(vendas_url_local, data);
        });



        $(document).keypress(function(event) {
            var matricula = $('#matricula').val();
            if(event.which == 13){
                buscarByMatricula(matricula)
            }

        });
    });



    async function cadastrarRedesQuandoForPrimeiroAcesso(vendas_url_local, data) {
        try {
          const response = await fetch(vendas_url_local+"/"+empresaId+"/redes/store", {
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





    function getLogo(contrato)
    {
        try {
            let logo = legado_url_local+`/Pessoas/${contrato}/Empresa/logo_001.png`;
            $('#logo').attr('src', logo)

            $('#logo').attr('src', logo).on('error', function() {
                $(this).attr('src', legado_url_local+'/img/logo_mu.png');
            }).fadeIn();

        } catch (error) {

        }

    }


    function buscarByMatricula(vendas_url_local,empresaId, matricula, tipo_liberacao = 'multiflial' )
    {
        $('#foto_avatar').fadeOut();;

        $.ajax({
            url: vendas_url_local+'/'+empresaId+'/primeiroacessototal/'+matricula,
            data:{
                idweb:empresaId,
                empresa_local:empresaId,
                tipo_liberacao: tipo_liberacao
            },
            statusCode: {
            404: function(data) {
                erro_004()

        },
        403: function(data) {
            erro_403()

          }

      },
      success: function(data) {
        var res = data;
        success_response(res)
        showNotification()

      }
    });


        }



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

        }



        function getMultiFiliais(idweb) {
            $.get('api/legado/' + idweb + '/multifilial', function (data) {

                try {

                    const filteredData = data.filter(filial => filial.nativa !== "1");

                    $('#id_filial').empty();

                    // Adicionar opção "Selecione"
                    let selectOption = new Option('Nativa', '');
                    $('#id_filial').append(selectOption);

                    for (let i = 0; i < filteredData.length; i++) {
                        let option = new Option(filteredData[i].id_web + '/' + filteredData[i].nome_empresa, filteredData[i].id_web);
                        $('#id_filial').append(option);
                    }


                } catch (error) {

                }

            });


        }


        function getNativa(idweb)
        {
            try {
                $.get('api/legado/' + idweb + '/multifilial', function (data) {
                    console.log(data)
                    // Filtrar data para excluir as filiais com nativa igual a 1
                    if(data.length  > 0){
                        const nativa = data.filter(filial => filial.nativa == "1");
                        var idWebNativa = nativa[0].id_web
                        $('#nativaId').val(idWebNativa)
                    }
                });

            } catch (error) {

            }

        }







