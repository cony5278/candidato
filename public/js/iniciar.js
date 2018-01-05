//array utilizado para iniciar el despliegu de cajas para la formacion academica en el formulario registrar y editar
formacion=[];
photo = new Array();




//html del gis cargando
function htmlCargado(){

  return '<div class="cargando">'+
    '<div class="contenedor-cargando">'+
      '<div class="container-fluid">'+
      	'<div class="row titulo-cargando">'+
      		'<div class="col-md-12 ">'+
            'Cargando'+
      		'</div>'+
      	'</div>'+
      	'<div class="row logo-empresa-cargando">'+
      		'<div class="col-md-12 ">'+
            '<img src="archivos/logo.png" width="100" height="100" class="img-fluid" alt="Responsive image">'+
      		'</div>'+
      	'</div>'+
      	'<div class="row gif-cargando">'+
      		'<div class="col-md-12">'+
            '<img src="archivos/loader.gif" width="150" height="100" class="img-fluid" alt="Responsive image">'+
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

function getAjaxContenedor(url,elemento,id_referido){
    $("."+elemento).html();
    $("body").append(htmlCargado());
    $.get(url,{id_referido:id_referido},function(resul){
        $("."+elemento).html(resul);
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
function getAjaxModal(url,elemento,dato){
    $("."+elemento).html();
    $("body").append(htmlCargado());
    $.get(url,{dato:dato},function(resul){
      $("body").append(resul);
      $('#'+elemento).modal('show');
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
         $(".modal").modal("hide");
			},
			error: function (error) {
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

              $(".contenedor").html(resul.html.original);

         }).done(function( data ) {
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

$(document).on('submit','.formulario-persona',function(e){
    e.preventDefault();
    envioDatos("formulario-persona");
});

$(document).on('submit','.formulario-general',function(e){
    e.preventDefault();
    envioDatos("formulario-general");
});
$(document).on('submit','.formulario',function(e){
    e.preventDefault();
    postAjaxSend();
});

$(document).on('submit','.formulario-observation',function(e){
    e.preventDefault();
    postAjaxObservation();
});

function oprimirHref(url,elemento){

  var valor=$("#"+elemento).val()==""?".c*":$("#"+elemento).val();
  window.location = url+"/"+valor;
}

function tipoCampo(elemento,tipo,decimales,caracteres,digitos){
    var campo=$(elemento);

    var dato=null;
    switch (tipo) {
    case "double":

      break;
    case "entero":
          dato=campo.val();
            console.log(dato);
          if(campo.val().length>=digitos){
            campo.val(dato.slice(0,digitos));
          }
      break;
    case "porcentaje":

      break;
    case "double":

      break;


      default:

    }
}
