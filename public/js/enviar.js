/**
 * Created by Juan Camilo on 11/11/2017.
 */

function mostrarseccion(acme,id){
    formacion=[];//se inicializa nuevamente el array global que se encuentra en el script iniciar
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
function mostrarSeccionMenu(opcion){
    switch (opcion) {

        case "L001"://informes de la persona listar
            getAjax("form_informe_usurioe");
        break;

        case "A001"://informes de la persona actualizar

        break;
        case "I001"://informes de la persona insercion

        break;
        case "D001"://informes de la persona dato

        break;


      default:

    }
}



function postAjax(url,evento){
    $(".contenedor").html();
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
                $(".contenedor").html(resul);
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
// formacion=[];
function agregarHtml(idprofesion,profesion,id,descripcion){
  return '<div class="modal-dialog" role="document">'+
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
                '<input id="name" type="hidden" onfocus="foco()" value="'+idprofesion+'"  name="idprofesion[]" >'+
                '<input id="name" type="hidden" onfocus="foco()" value="'+id+'"  name="idforomacionacademica[]" >'+
                '<input id="name" type="text" onfocus="foco()" value="'+profesion+'"  placeholder="Nivel academico" class="form-control" name="foromacionacademica[]" disabled>'+
            '</div>'+
        '</div>'+
        '<div class="form-group">'+
            '<div class="col-md-10">'+
                '<input id="name" type="text" onfocus="foco()" value="'+descripcion+'" placeholder="Descripcion" class="form-control" name="descripcionacademica[]">'+
            '</div>'+
        '</div>'+
      '</div>'+
      '<div class="modal-footer">'+
        '<button type="button" class="btn btn-secondary" onclick="cerrarFormacion(event);" data-dismiss="modal">Cerrar</button>'+
      '</div>'+
    '</div>'+
  '</div>';

}

function agregarSeleccionSinEvento(idprofesion,profesion,id,descripcion){
        formacion.push(idprofesion);
        $(".agregar-formacion").append(agregarHtml(idprofesion,profesion,id,descripcion));
}

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
        $(".agregar-formacion").append(agregarHtml('',texto,$(elemento).val(),""));
  }
}
