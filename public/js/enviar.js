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

function cerrarFormacion (event){
  $(event.target).parents().parents().parents()[0].remove();
}
formacion=[];
function agregarSeleccionFormacion(elemento)
{
  var texto=$(elemento).find("option:selected").text();
  var estado=false;

  $.each(formacion, function( index, value ) {
      if(value==$(elemento).val()){
        estado=true;
        return estado;
      }
  });
  if(!estado){
      formacion.push($(elemento).val());
      var html='<div class="modal-dialog" role="document">'+
          '<div class="modal-content">'+
          '<div class="modal-header">'+
            '<h5 class="modal-title">Selección</h5>'+
            '<button type="button" class="close" onclick="cerrarFormacion(event);" data-dismiss="modal" aria-label="Close">'+
              '<span aria-hidden="true">&times;</span>'+
            '</button>'+
          '</div>'+
          '<div class="modal-body">'+
            '<div class="form-group">'+
                '<div class="col-md-10">'+
                    '<input id="name" type="hidden" onfocus="foco()" value="'+$(elemento).val()+'"  name="idforomacionacademica[]" >'+
                    '<input id="name" type="text" onfocus="foco()" value="'+texto+'"  placeholder="Nivel academico" class="form-control" name="foromacionacademica[]" disabled>'+
                '</div>'+
            '</div>'+
            '<div class="form-group">'+
                '<div class="col-md-10">'+
                    '<input id="name" type="text" onfocus="foco()" placeholder="Descripcion" class="form-control" name="descripcionacademica[]">'+
                '</div>'+
            '</div>'+
          '</div>'+
          '<div class="modal-footer">'+
            '<button type="button" class="btn btn-secondary" onclick="cerrarFormacion(event);" data-dismiss="modal">Cerrar</button>'+
          '</div>'+
        '</div>'+
      '</div>';

      $(".agregar-formacion").append(html);
  }
}
