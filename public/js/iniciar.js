//array utilizado para iniciar el despliegu de cajas para la formacion academica en el formulario registrar y editar
formacion=[];
photo = new Array();




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

/**
	 * funcion que envia los archivos al controlador
	 * @param formulario
	 */
	function envioDatos(formulario){

		var dato=addDatos(formulario);
		$.ajax({
			headers: {'X-CSRF-TOKEN': $("#token").val()},
			url: $("."+formulario).attr("action"),
			method: $("."+formulario).attr("method"),
			data: dato,
			contentType: false,
			processData: false,
			dataType: 'json',
			success: function (resul) {
        $(".cargando").remove();
        var notificacion = new Notificacion();
        notificacion.crearContenedor();
        notificacion.crearNotificacion(resul.msj,resul.notificacion);
         $(".contenedor").html(resul.html.original);
			},
			error: function (error) {
        $(".cargando").remove();
        var data = JSON.parse(error.responseText).errors;

           for(var key in data) {

                   var notificacion = new Notificacion();
                   notificacion.crearContenedor();
                   notificacion.crearNotificacion(data[key],"DANGER");
           }
			}
		});
	}
/**
*adicona los datos de cualquier formulario para su posterior envio
*/

function addDatos(formulario){
		var formData = new FormData();
		$.each($("."+formulario).serializeArray(), function(i, json) {
			formData.append(json.name, json.value);
		});
    formData.append("photo",photo[0]);
		return formData;
	}
function postAjax(url,id){
  $(".contenedor").html();
  $("body").append(htmlCargado());
        var  data = {  _method:"delete",_token : $("#token").attr("value")};
         $.post(url+"/"+id, data,function(resul){

             var notificacion = new Notificacion();
             notificacion.crearContenedor();
             notificacion.crearNotificacion(resul.msj,resul.notificacion);
              $(".contenedor").html(resul.html.original);

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

             var notificacion = new Notificacion();
             notificacion.crearContenedor();
             notificacion.crearNotificacion(resul.msj,resul.notificacion);
             console.log(resul.html)
              $(".contenedor").html(resul.html.original);

         }).done(function( data ) {
           $(".cargando").remove();
         }).fail(function(error) {

            $(".cargando").remove();
            var data = JSON.parse(error.responseText).errors;

               for(var key in data) {

                       var notificacion = new Notificacion();
                       notificacion.crearContenedor();
                       notificacion.crearNotificacion(data[key],"DANGER");
               }

         });
}

function postAjaxObservation(){
  $(".contenedor").html();
  $("body").append(htmlCargado());

  var data=$('.formulario-observation').serializeArray();
           $.post($('.formulario-observation').attr('action'), data,function(resul){

             var notificacion = new Notificacion();
             notificacion.crearContenedor();
             notificacion.crearNotificacion(resul.msj,resul.notificacion);
              $(".contenedor").html(resul.html.original);

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

$(document).on('submit','.formulario-persona',function(e){
    e.preventDefault();
    envioDatos("formulario-persona");
});

$(document).on('submit','.formulario',function(e){
    e.preventDefault();
    postAjaxSend();
});

$(document).on('submit','.formulario-observation',function(e){
    e.preventDefault();
    postAjaxObservation();
});
