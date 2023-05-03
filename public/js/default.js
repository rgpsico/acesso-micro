
$(document).ready(function(){
    //acesso nao encontrado 1232
    //Cliente Vencido 104
    //Liberado 186

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



        $(document).on('click', '#buscar', function(event) {
          showNotification()
            var matricula = $('#matricula').val();
             buscarByMatricula(matricula)

                  // Exemplo de dados a serem enviados
        var data = {
            id_fornecedores_despesas: 1,
            id_web: 2,
            nativa: true
        };

        sendData(data);
        });



        $(document).keypress(function(event) {
            var matricula = $('#matricula').val();
            if(event.which == 13){
                buscarByMatricula(matricula)
            }

        });
    });



    async function sendData(data) {
        try {
          const response = await fetch("http://localhost:8001/306/redes/store", {
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



    function getLogo(contrato)
    {
        let logo = `http://127.0.0.1/projetos/mu.fitness.gestao/Pessoas/${contrato}/Empresa/logo_001.png?rd=`+1235;
        $('#logo').attr('src', logo)
    }

    function buscarByMatricula(matricula)
    {
        $('#foto_avatar').fadeOut();;
        $.ajax({
            url: 'http://localhost:8001/'+306+'/aluno/'+matricula+'/byid',
            statusCode: {
            404: function() {
          $('#foto_avatar').attr('src', 'https://photografos.com.br/wp-content/uploads/2020/09/fotografia-para-perfil.jpg')
          $('#nomeAluno').text('')
          $("#matricula-aluno").text('')
          $('#motivo-status').text('')
          $('#status').text('BLOQUEADO');
          $('#motivo-status').text('Aluno não encontrado');
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
          $('#nomeAluno').text(res.nome)
          $("#matricula-aluno").text(res.id)
          $('#status').text('LIBERADO')
          $(".message").removeClass('text-danger')
          $(".message").addClass('text-success')
          $("#motivo-status").removeClass('bg-danger')
          $("#motivo-status").removeClass('bg-info')
          $('#motivo-status').addClass('bg-success')
          $('#motivo-status').text(res.text)
          $('.user-status').text(res.text)
          $('#descricaoPlano').text(res.descricaoPlano)
          $('#acessoMsg').text(res.acessoMsg)
          document.getElementById("liberado").play();
        } else {
          $('#nomeAluno').text(res.nome)
          $("#matricula-aluno").text(res.id)
          $('#status').text('BLOQUEADO')
          $(".message").removeClass('text-success')
          $(".message").addClass('text-danger')
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
            $.get('/executar-comando', function(data){

        })

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



