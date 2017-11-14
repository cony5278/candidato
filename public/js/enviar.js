/**
 * Created by Juan Camilo on 11/11/2017.
 */
function mostrarseccion(acme,id){

switch (acme){
    case "I":
        var url = "form_crear_usuario/";
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