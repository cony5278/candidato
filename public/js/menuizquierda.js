function cargando(){

}
function menuizquierda(opcion){
  switch (opcion) {
    case 1:
      mostrarseccion('L','');
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
        $(".contenedor").html(resul);
    }) .done(function( data ) {
      $(".cargando").remove();
    }).fail(function(error) {
          //alert(error); // or whatever
    });
}
