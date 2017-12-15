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
          //alert(error); // or whatever
          $(".cargando").remove();
    });
}
