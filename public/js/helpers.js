function execultarApp()
{
      $.ajax({
            type: "GET",
            dataType: "json",
            url: '/executar-comando',
            success: function (data) {
                console.log(data);
            }
        });
}


function formatarDataBr(data)
{
    let partes = data.split('-');
    let dataBr = [partes[2], partes[1], partes[0]].join('/');
    return dataBr;
}


function showNotification()
{
    $(".notification-box").slideDown(500, function () {
        setTimeout(function () {
            $(".notification-box").slideUp(500);
        }, 3000); // A notificação desaparece após 3 segundos
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
