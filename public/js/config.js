const vendas_url_local = 'https://vendas.mufitness.com.br/'
const legado_url_local = 'https://app.mufitness.com.br/v2/'

const vendas_url_producao = 'https://vendas.mufitness.com.br/'
const legado_url_producao = 'https://app.mufitness.com.br/v2/'

const contrato = '053'

console.log(getUrlVendas())
menuFlutuante(getUrlVendas(), contrato )






function getUrlVendas() {
    const isHttps = vendas_url_producao.startsWith('httpst'); // Verifica se a URL de produção começa com "https"

    if (isHttps && isProducao) {
      return vendas_url_producao; // Retorna a URL de produção
    } else {
      return vendas_url_local; // Retorna a URL local
    }
  }


  function getUrlLegado() {
    const isHttps = vendas_url_producao.startsWith('httpst'); // Verifica se a URL de produção começa com "https"

    if (isHttps && isProducao) {
      return vendas_url_producao; // Retorna a URL de produção
    } else {
      return vendas_url_local; // Retorna a URL local
    }
  }


function getSfConfig(vendas_url_local, idweb, nomeConfiguracao)
{
    var formattedId = String(idweb).padStart(3, '0');

     $.ajax({
        type: 'GET',
        contentType:'json',
        url: vendas_url_local+'/'+ formattedId+'/configbyname',
        data: {
            configName: nomeConfiguracao
        },

        success: function(data) {
          var res = data;

        }
    });
}



function menuFlutuante(vendas_url_local, idweb )
{

    var formattedId = String(idweb).padStart(3, '0');
    $.ajax({
        type: 'GET',
        contentType:'json',
        url: vendas_url_local+'/'+ formattedId+'/configbyname',
        data: {
            configName: 'liberacao_justificada'
        },
        success: function(data) {
          var res = data;

          switch (res.liberacao_justificada) {
           case null:
           case '0':

           $("#floating-whatsapp").addClass('liberacaoManual')
           $("#floating-whatsapp").removeClass('liberacaoJustificada')
           $("#floating-whatsapp").removeClass('desabilitada')

            return;
            case '1':
              $("#floating-whatsapp").addClass('liberacaoJustificada')
              $("#floating-whatsapp").removeClass('liberacaoManual')
              $("#floating-whatsapp").removeClass('desabilitada')

            return;
            case '2':

              $("#floating-whatsapp").addClass('desabilitada')
              $("#floating-whatsapp").removeClass('liberacaoJustificada')
              $("#floating-whatsapp").removeClass('liberacaoManual')


            return;
            default:

                $("#floating-whatsapp").addClass('desabilitada')
                $("#floating-whatsapp").removeClass('liberacaoJustificada')
                $("#floating-whatsapp").removeClass('liberacaoManual')

            return;
          }
        }
    });

}






