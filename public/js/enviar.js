/**
 * Created by Juan Camilo on 11/11/2017.
 */
function mostrarseccion(acme,id){

switch (acme){
    case "I"://para mostrar el formulario del usuario administrador
        var url = "form_crear_usuario/";
        getAjax(url);
        break;
    case "II"://para mostrar el formulario del usuario estandar
        var url = "form_crear_usuarioe/";
        getAjax(url);
        break;
    case "A":
        var url = "form_editar_usuario/"+id+"";
        getAjax(url);
        break;
    case "E":
        var url = "form_eliminar_usuario/"+id+"";
        getAjax(url);
        break;
    case "L":
        var url = "form_listar_usuario";
        getAjax(url);
        break;
}

}

function getAjax(url){
    $(".contenedor-persona").html();
    $.get(url,function(resul){
        $(".contenedor-persona").html(resul);
    })

}

function postAjax(url,evento){
    $(".contenedor-persona").html();
    var formulario = $(evento).parents("form:first");
    $.post(url,$(formulario).serializeArray(),function(resul){
        //$(".contenedor-persona").html(resul);
    })

}
function formulario(url,nombreFormulario){
    postAjax(url,nombreFormulario);
}

function eliminarDatos(opcion,id){
    switch (opcion)
    {
        case "1":
           var  data = {  _method:"delete",_token : $("#usuario-token").attr("value")};
            $.post("usuario/"+id, data,function(resul){
                $(".contenedor-persona").html(resul);
            })
            break;
        case "2":
            getAjax();
            break;
        case "3":
            getAjax();
            break;
    }

}