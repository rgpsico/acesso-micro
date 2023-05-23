$(document).ready(function(){




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

      const clock = document.getElementById("clock");

      // Atualiza o relógio a cada segundo

     try {
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
     } catch (error) {

     }


      $('#floating-ligar').hide();
      $('#floating-whatsapp').hide();
      $('#floating-emergencia').hide();
      $('#floating-home').hide();

      $('#floating-icon').click(function(){
          $('#floating-ligar').toggle();
          $('#floating-whatsapp').toggle();
          $('#floating-emergencia').toggle();
          $('#floating-home').toggle();
          menuFlutuante(getUrlVendas() , empresaId )
       });


});
