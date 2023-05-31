
const vendas_url_local = 'http://localhost:8001/'
const vendas_url_producao = 'https://vendas.mufitness.com.br/'


const legado_url_local = 'http://127.0.0.1/projetos/mu.fitness.gestao/'
const legado_url_producao = 'https://app.mufitness.com.br/v2/'

const urlExe = 'http://127.0.0.1:8000/meu_endpoint'


const empresaId = localStorage.getItem('loginEmpresa')


menuFlutuante(getUrlVendas(), empresaId )


pegarValorDaConfiguracaoPeloNome(getUrlVendas(), empresaId, 'tempo_reload_acesso', 'tempoReloadCard')

pegarValorDaConfigGympassPeloNome(getUrlVendas(), empresaId, 'gym_number', 'X-Gym-Id')

function getUrlVendas() {
    const isHttps = window.location.href.startsWith('https');

    if (isHttps) {
      return vendas_url_producao;
    } else {
      return vendas_url_local;
    }
  }



  function getUrlLegado() {
    const isHttps = window.location.href.startsWith('https');

    if (isHttps) {
      return legado_url_producao;
    } else {
      return legado_url_local;
    }
  }





function pegarValorDaConfiguracaoPeloNome(vendas_url_local, idweb, nomeConfiguracao, elemento)
{
    var formattedId = String(idweb).padStart(3, '0');

    try {
        $.ajax({
            type: 'GET',
            url: vendas_url_local+''+ formattedId+'/configbyname',
            data: {
                configName:nomeConfiguracao
            },

            success: function(data)
            {
              var res = data;
              $('#'+elemento).val(res[nomeConfiguracao])
            }
        });

    } catch (error) {

    }

}

function marcarCheckboxConfiguracaoById(vendas_url_local, idweb, nomeConfiguracao, elemento)
{
    var formattedId = String(idweb).padStart(3, '0');

    try {
        $.ajax({
            type: 'GET',
            url: vendas_url_local+''+ formattedId+'/configbyname',
            data: {
                configName:nomeConfiguracao
            },
            success: function(data)
            {
                if(data[nomeConfiguracao] == 1){
                    $('#'+elemento).prop('checked', true);
                }else {
                    $('#'+elemento).prop('checked', false);
                }
            }
        });

    } catch (error) {

    }

}

function pegarValorDaConfigGympassPeloNome(vendas_url_local, idweb, nomeConfiguracao, elemento)
{
    var formattedId = String(idweb).padStart(3, '0');

    try {
        $.ajax({
            type: 'GET',
            url: vendas_url_local+''+ formattedId+'/gympass/config/byname',
            data: {
                configName:nomeConfiguracao
            },

            success: function(data)
            {
              var res = data;
              $('#'+elemento).val(res[nomeConfiguracao])
            }
        });

    } catch (error) {

    }

}

function aConfiguracaoEstaAtiva(vendas_url_local, idweb, nomeConfiguracao) {
    var formattedId = String(idweb).padStart(3, '0');
    var result = false; // default value

    $.ajax({
        type: 'GET',
        async: false, // make the request synchronous
        url: vendas_url_local + '' + formattedId + '/configbyname',
        data: {
            configName: nomeConfiguracao
        },
        success: function(data) {
            result = data[nomeConfiguracao] == 1;
        },
        error: function() {
            console.log("Error while trying to get the configuration value");
        }
    });

    return result;
}



function menuFlutuante(vendas_url_local, idweb )
{

    var formattedId = String(idweb).padStart(3, '0');

    $.ajax({
        type: 'GET',

        url: vendas_url_local+''+ formattedId+'/configbyname',
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

function storeEmpresaId() {
    const empresaId = inputEmpresaId.value;
    localStorage.setItem('empresaId', empresaId);
  }



function generateToken(user, permissions) {
    const payload = {
      user: user,
      permissions: permissions,
      createdAt: new Date()
    };

    const encodedPayload = btoa(JSON.stringify(payload));
     return encodedPayload;
  }








