//array utilizado para iniciar el despliegu de cajas para la formacion academica en el formulario registrar y editar
formacion=[];


window.onclick = function(event) {
        $(".contenedor-combo").hide();
}

//html del gis cargando
function htmlCargado(){
  var src="archivos/carga.apng";
  return '<div class="cargando">'+
    '<div class="contenedor-cargando">'+
      '<div class="container-fluid">'+
    	'<div class="row contenedor-cargando-body">'+
    		'<div class="col-md-12">'+
          'Evssa'+
    		'</div>'+
        '<div class="col-md-12">'+
          '<img src="'+src+'" class="img-fluid" alt="Responsive image">'+
        '</div>'+
    	'</div>'+
    '</div>'+
    '</div>'+
  '</div>';

}
function onCargandoSubmit(){
    $("body").append(htmlCargado());
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
