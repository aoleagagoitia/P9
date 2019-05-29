$(function () {

    $(".aprobarValoracion").click(function () {
        var id = $(this).attr('id');
        id = id.replace("idAprobar", "");
        var user_id = $('.userIdValoration').attr('id');
        
        user_id = user_id.replace("userId", "");
        
        $.post("http://localhost/p9a/producto/aprobarValoracion", {id: id, user_id: user_id}, function (respuesta) {
            console.log(respuesta);
            if (respuesta) {
                $('#idRechazo' + id).remove();
                $('#idAprobar' + id).remove();
                var aprobadas = '<div class="alert alert-success" role="alert">Aprobada<span class="float-right glyphicon glyphicon-ok alert-success" aria-hidden="true"></span></div>';
                $('#aprobadas' + id).append(aprobadas);
            }else{
                var aprobadas = '<div class="alert alert-danger" role="alert">Algo falló!<span class="float-right glyphicon glyphicon-warning-sign" aria-hidden="true"></span></div>';
                $('#aprobadas' + id).append(aprobadas);
            }
        });

    });
    
    $(".rechazarValoracion").click(function () {
        var id = $(this).attr('id');
        id = id.replace("idRechazo", "");

       
        $.post("http://localhost/p9a/producto/rechazarValoracion", {id: id}, function (respuesta) {
            if (respuesta) {
                $('#carta' + id).remove();
            } else {
                var aprobadas = '<div class="alert alert-danger" role="alert">Algo falló!<span class="float-right glyphicon glyphicon-warning-sign" aria-hidden="true"></span></div>';
                $('#aprobadas' + id).append(aprobadas);
            }
        });

    });
    
    
});