function execultarApp()
{
      $.ajax({
            type: "GET",
            dataType: "json",
            url: 'http://127.0.0.1:8000/meu_endpoint',
            success: function (data) {

            }
        });
}


function formatarDataBr(data)
{
    try {
        let partes = data.split('-');
        let dataBr = [partes[2], partes[1], partes[0]].join('/');
        return dataBr;
    } catch (error) {

    }

}


function showNotification() {
    $(".notification-box").slideDown(500, function ()
    {
        if ($(window).width() < 576)
        {
            $(".notification-box").addClass("small-notification");
        }
        setTimeout(function () {
            $(".notification-box").slideUp(500, function ()
            {
                $(".notification-box").removeClass("small-notification");
            });
        }, 3000); // A notificação desaparece após 3 segundos
    });
}



function toggleFullscreen()
{
    if (!document.fullscreenElement)
    {
        document.documentElement.requestFullscreen();
    }
    else
    {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        }
    }
}

function selectRg(route, valueField, textField, selector) {
    fetch(route)
        .then(response => response.json())
        .then(data => {
            // Log the data to see exactly what we are dealing with
            console.log(data);

            // Encontre o elemento dropdown
            const dropdown = document.querySelector(selector);

            // Limpe o dropdown
            dropdown.innerHTML = '';

            // Crie e adicione as opções
            for (const item of data) {
                const option = document.createElement('option');
                option.value = item[valueField];
                option.textContent = item[textField];

                dropdown.appendChild(option);
            }
        })
        .catch(error => {
            // Trate erros
            console.error('Erro ao buscar os dados da API:', error);
        });
}





