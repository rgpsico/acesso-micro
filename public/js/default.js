
$(document).ready(function(){
const vendas_url = 'http://localhost:8001'
    getMultiFiliais(empresaId)

    // Função para abrir o modal
    $(".liberacaoJustificada").click(function() {

      $("#modal_micro").fadeIn();
    });

    $(".liberacaoManual").click(function() {
        execultarApp()
      });

    // Função para fechar o modal
    $("#fecharModal").click(function() {
      $("#modal_micro").fadeOut();
    });

    // Função para fechar o modal ao clicar fora da área de conteúdo
    $(window).click(function(event) {
      if ($(event.target).is("#modal")) {
        $("#modal_micro").fadeOut();
      }
    });



    const contrato = $('#cliente_id').val()
    getLogo(contrato)




    $(document).on('change', '#id_filial', function(event) {
        var idweb = $(this).val();
        var formattedId = String(idweb).padStart(3, '0');

        $('#buscar_aluno').val('')
        $('#matricula').val('')
        $.get(vendas_url+'/'+formattedId+'/alunos', function(data){

            $('#alunos_multifilai').empty();

            // Preencher o select com os dados recebidos
            data.forEach(function(item){
                $('#alunos_multifilai').append('<option value="' + item.id + '">' + item.name + '</option>');
            });
        });
    });

    $(document).ready(function() {

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

        // Esconda o select 'alunos_multifilai' quando clicar fora dele
        $(document).on('click', function(e) {
            if (!$(e.target).is('#alunos_multifilai, #buscar_aluno')) {
                $('#alunos_multifilai').hide();
            }
        });

        // Mostrar o select 'alunos_multifilai' quando o input 'buscar_aluno' estiver focado
        $('#buscar_aluno').on('focus', function() {
            $('#alunos_multifilai').show();
        });
    });


        $(document).on('click', '#buscar', function(event) {

            var matricula = $('#matricula').val();
             buscarByMatricula(vendas_url, matricula)

                  // Exemplo de dados a serem enviados
        var data = {
            id_fornecedores_despesas: 1,
            id_web: 2,
            nativa: true
        };

        //sendData(vendas_url, data);
        });



        $(document).keypress(function(event) {
            var matricula = $('#matricula').val();
            if(event.which == 13){
                buscarByMatricula(matricula)
            }

        });
    });



    async function sendData(vendas_url, data) {
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
            // Insira o código para manipular a resposta bem-sucedida
          } else {
            console.error("Erro na requisição:", response.status, response.statusText);
            // Insira o código para manipular o erro
          }
        } catch (error) {
          console.error("Erro na requisição:", error);
          // Insira o código para manipular o erro
        }
      }


      function formatarDataBr(data) {
        // separa a string da data em ano, mês e dia
        let partes = data.split('-');

        // rearranja as partes da data na ordem DD/MM/YYYY
        let dataBr = [partes[2], partes[1], partes[0]].join('/');

        return dataBr;
      }



    function getLogo(contrato)
    {
        let logo = `http://127.0.0.1/projetos/mu.fitness.gestao/Pessoas/${contrato}/Empresa/logo_001.png?rd=`+1235;
        $('#logo').attr('src', logo)
    }

    function buscarByMatricula(vendas_url, matricula)
    {
        $('#foto_avatar').fadeOut();;
        $.ajax({
            url: vendas_url+'/'+empresaId+'/aluno/'+matricula+'/byid',
            statusCode: {
            404: function(data) {
          $('#foto_avatar').attr('src', 'https://photografos.com.br/wp-content/uploads/2020/09/fotografia-para-perfil.jpg')
          $('#nomeAluno').text('')
          $("#matricula-aluno").text('')
          $('#motivo-status').text('')
          $('#status').text('BLOQUEADO');
          $('#motivo-status').text('Aluno não encontrado');
          $('#motivo-status').removeClass('bg-success');
          $('#motivo-status').addClass('bg-danger');

        },
        403: function(data) {
            var res = data.content;

            $('#foto_avatar').attr('src', 'https://photografos.com.br/wp-content/uploads/2020/09/fotografia-para-perfil.jpg')
            $('#nomeAluno').text('')
            $("#matricula-aluno").text('Bloqueio Manual')
            $('#motivo-status').text('Bloqueio Manual')
            $('#status').text("Bloqueio Manual");
            $('#motivo-status').text("Bloqueio Manual");
            $('#motivo-status').removeClass('bg-success');
            $('#motivo-status').addClass('bg-danger');

          }

      },
      success: function(data) {
        var res = data.data;

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


        function getMultiFiliais(idweb)
        {
            $.get('api/legado/' + idweb + '/multifilial', function(data) {
                // Limpar opções existentes
                $('#id_filial').empty();

                // Adicionar opção "Selecione"
                let selectOption = new Option('Selecione', '');
                $('#id_filial').append(selectOption);

                for (let i = 0; i < data.length; i++) {
                    let option = new Option(data[i].nome_empresa, data[i].id_web);
                    $('#id_filial').append(option);
                }
            });
        }




        const clock = document.getElementById("clock");

            // Atualiza o relógio a cada segundo
            setInterval(() => {
            // Cria um objeto Date com a hora atual
            const now = new Date();

            // Formata a hora e o minuto como texto
            const hours = now.getHours().toString().padStart(2, "0");
            const minutes = now.getMinutes().toString().padStart(2, "0");
            const seconds = now.getSeconds().toString().padStart(2, "0");

            // Define o conteúdo do span com a hora e o minuto
            clock.textContent = `${hours}:${minutes}:${seconds}`;
            }, 1000);

            $('#floating-ligar').hide();
            $('#floating-whatsapp').hide();
            $('#floating-emergencia').hide();
            $('#floating-home').hide();

            $('#floating-icon').click(function(){
                $('#floating-ligar').toggle();
                $('#floating-whatsapp').toggle();
                $('#floating-emergencia').toggle();
                $('#floating-home').toggle();
              });


