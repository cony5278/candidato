function cargando(){

}
function menuizquierda(opcion){
  switch (opcion) {
    case 1:
      mostrarseccion('L','');
      break;
    case 2:
      mostrarseccion('LL','');
      break;
    case opcion:
      mostrarSeccionMenu(opcion,"");
      break;
    default:

  }
}

function getAjax(url){
    $(".contenedor").html();
    $("body").append(htmlCargado());
    $.get(url,function(resul){
        if(resul.notificacion==undefined){
          $(".contenedor").html(resul);
        }else{
          var notificacion = new Notificacion();
          notificacion.crearContenedor();
          notificacion.crearNotificacion(resul.msj,resul.notificacion);
        }
    }) .done(function( data ) {
      $(".cargando").remove();
    }).fail(function(error) {
      $(".cargando").remove();
      var data = JSON.parse(error.responseText).errors;
      if(data!=undefined){
         for(var key in data) {

                 var notificacion = new Notificacion();
                 notificacion.crearContenedor();
                 notificacion.crearNotificacion(data[key],"DANGER");
         }

       }else{
         data = JSON.parse(error.responseText);
         var notificacion = new Notificacion();
         notificacion.crearContenedor();
         notificacion.crearNotificacion(data.msj,data.notificacion);
       }
    });
}
