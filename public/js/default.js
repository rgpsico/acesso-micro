
$(document).ready(function(){
    try {
        eMultifilial(empresaId)
        getMultiFiliais(empresaId)
        $('#nativaId').val(empresaId)
        getEmpresasByIdweb(getUrlVendas(), empresaId)
        getLogo(empresaId)

    } catch (error) {

    }






    $(document).on('click', '.liberacaoManual', function(event) {
        execultarApp()
     });



    $(document).on('click', '.liberacaoJustificada', function(event) {
        $('#password').val('')
        $("#modal_micro").fadeIn();
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

            var matricula = $('#alunos_multifilai').val();

            var empresa = $('#select_id_filial').val();

            if(empresa == '')
            {
               empresa = $('#nativaId').val()

            }

            var empresaFormate = String(empresa).padStart(3, '0');

            if(matricula == '')
            {
                alert('Matricula não encontrada')
            }

            buscarByMatricula(getUrlVendas(),empresaFormate, matricula)

                  // Exemplo de dados a serem enviados
                var data = {
                    id_fornecedores_despesas: 1,
                    id_web: 2,
                    nativa: true
                };

             //cadastrarRedesQuandoForPrimeiroAcesso(vendas_url_local, data);
        });



        $(document).keypress(function(event) {

            if(event.which == 13){
                var matricula = $('#alunos_multifilai-selectized').val();

                var empresa = $('#select_id_filial').val();

                if(empresa == '')
                {
                   empresa = $('#nativaId').val()

                }

                var empresaFormate = String(empresa).padStart(3, '0');

                if(matricula == '')
                {
                    alert('Matricula não encontrada')
                }

                buscarByMatricula(getUrlVendas(),empresaFormate, matricula)
            }

        });
    });



    async function cadastrarRedesQuandoForPrimeiroAcesso(vendas_url_local,empresaId, data) {
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


    function buscarByMatricula(vendas_url_local, empresaId, matricula, tipo_liberacao = 'multiflial')
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
    var control = $select[0].selectize;
    control.clear();
    $('#alunos_multifilai-selectized').focus();
    $('#alunos_multifilai-selectized').val('')
    loadCard()
}




function loadCard()
{
    var segundos = $('#tempoReloadCard').val()

    setTimeout(() => {
        limparCard()
    },  segundos * 1000);
}

    const eMultifilial = (idweb) => {
        $.get('api/legado/' + idweb + '/multifilial', function (data) {
            if(data.length > 0){

                return;
            } else
            {
                getTodosAlunos(getUrlVendas()+idweb+'/alunosnaosaomf');
                $('#select_id_filial').hide()
              return;
            }
        });
    }


        const getMultiFiliais = (idweb) => {
            $.get('api/legado/' + idweb + '/multifilial', function (data) {

                try {

                    const newData = data.map(item => {
                        let newItem = {};

                        for (let key in item) {
                            newItem[key.trim()] = item[key];
                        }

                        return newItem;
                    });

                    const filteredData = newData.filter(filial => filial.nativa !== "1");

                    $('#select_id_filial').empty();


                    let selectOption = new Option('Nativa', '');
                    $('#select_id_filial').append(selectOption);



                    for (let i = 0; i < filteredData.length; i++) {

                        let option = new Option(filteredData[i].id_web + '/' + filteredData[i].nome_empresa, filteredData[i].id_web);
                        $('#select_id_filial').append(option);
                    }
                } catch (error) {
                    console.error(error);
                }
            });
        };






        function getNativa(idweb)
        {

            try {
                $.get('api/legado/' + idweb + '/multifilial', function (data) {

                    if(data.length  > 0){
                        const nativa = data.filter(filial => filial.nativa == "1");
                        var idWebNativa = nativa[0].id_web
                        $('#nativaId').val(idWebNativa)
                    }
                });

            } catch (error) {

            }

        }







