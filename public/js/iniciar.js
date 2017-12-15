//array utilizado para iniciar el despliegu de cajas para la formacion academica en el formulario registrar y editar
formacion=[];




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
        $(".cargando").remove();
    });
}

function postAjax(url,id){
  $(".contenedor").html();
  $("body").append(htmlCargado());
        var  data = {  _method:"delete",_token : $("#token").attr("value")};
         $.post(url+"/"+id, data,function(resul){
           if(resul.notificacion==undefined){
             $(".contenedor").html(resul);
           }else{
             var notificacion = new Notificacion();
             notificacion.crearContenedor();
             notificacion.crearNotificacion(resul.msj,resul.notificacion);
              $(".contenedor").html(resul.html);
           }
         }).done(function( data ) {
           $(".cargando").remove();
         }).fail(function(error) {
            $(".cargando").remove();
         });
}

function postAjaxSend(){
  $(".contenedor").html();
  $("body").append(htmlCargado());
  var formData = new FormData();
  // formData.append("photo",  $('#imageUpload')[0].files[0]);
  var data=$('.formulario').serializeArray();
    // data.push({ name: "photo", value: formData});
           $.post($('.formulario').attr('action'), data,function(resul){
           if(resul.notificacion==undefined){
             $(".contenedor").html(resul);
           }else{
             var notificacion = new Notificacion();
             notificacion.crearContenedor();
             notificacion.crearNotificacion(resul.msj,resul.notificacion);
              $(".contenedor").html(resul.html);
           }
         }).done(function( data ) {
           $(".cargando").remove();
         }).fail(function(error) {
                 console.log(error);
            $(".cargando").remove();
            var data = JSON.parse(error.responseText).errors;

               for(var key in data) {

                       var notificacion = new Notificacion();
                       notificacion.crearContenedor();
                       notificacion.crearNotificacion(data[key],"DANGER");
               }

         });
}

$(document).on('submit','.formulario',function(e){
    e.preventDefault();
    postAjaxSend();
});
