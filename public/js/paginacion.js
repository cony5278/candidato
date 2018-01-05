


$(document).on('click','.pagination-combo a',function(e){
    e.preventDefault();

    var pagina=$(this).attr('href').split('page=')[1];
    var ruta=$(this).attr('href').split('page=')[1];

    $.ajax({
        url:"htt"+ruta.substring(0,ruta.lastIndexOf("?")),
        data:{
            page:pagina,
            buscar:$(".entrada-combo").val(),
            departamento:$("#entrada-departamento").val(),
            iddepartamento:$("#entrada-departamento-id").val(),
            ciudad:$("#entrada-ciudad").val(),
        },
        type:'GET',
        dataType:'json',
        success:function(data){
           // console.log(data);
            $('.contenedor-combo').html(data);
        }

    });

});


$(document).on('click','.pagination-table a',function(e){
    e.preventDefault();

    var pagina=$(this).attr('href').split('page=')[1];
    var ruta=$(this).attr('href').split('home')[0];

      $.ajax({
          url:ruta+$("#url-listar").val(),
          data:{
              page:pagina,
              type:$("#usuario-type").val(),
          },
          type:'GET',
          dataType:'json',
          success:function(data){

              $('.contenedor').html(data);
          }

      });
});



$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    var pagina=$(this).attr('href').split('page=')[1];
      $.ajax({
          url:$("#url-general").val()+"/"+$("#url-listar").val(),
          data:{
              page:pagina
          },
          type:'GET',
          dataType:'json',
          success:function(data){

              $('.contenedor').html(data);
          }

      });
});

function paginacion(evento,url){
    if($(evento).val()!='' || $(evento).val()!=null) {
        $.ajax({
            url: url,
            data: {
                buscar: $(evento).val(),
                departamento: $("#entrada-departamento").val(),
                iddepartamento: $("#entrada-departamento-id").val(),
                ciudad: $("#entrada-ciudad").val(),
            },
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $(evento).siblings("div").css("display", "block");
                $(evento).siblings("div").html();
                $(evento).siblings("div").html(data);
            }

        });
    }
}

function buscarEnTabla(evento,url,clase){

          $.ajax({
              url: url,
              data: {buscar: $(evento).val()},
              type: 'GET',
              dataType: 'json',
              success: function (data) {
                  $("."+clase).html();
                  $("."+clase).html(data);
              }
          });
}

function despliegueComboClass(evento,url,clase,id){
    // console.log(url);
          $.ajax({
              url: url,
              data: {buscar: $(evento).val(),id:id},
              type: 'GET',
              dataType: 'json',
              success: function (data) {
                  $("."+clase).html();
                  $("."+clase).html(data);
              }
          });
}

function despliegueCombo(evento,url){
    // console.log(url);
          $.ajax({
              url: url,
              data: {buscar: $(evento).val()},
              type: 'GET',
              dataType: 'json',
              success: function (data) {
                  $(".despliegue").html();
                  $(".despliegue").html(data);
              }
          });
}

function despliegueComboFinal(evento,url,elementoInicial,elementoFinal){
    // console.log($(".despliegue").val());
          $.ajax({
              url: url,
              data: {buscar: $(evento).val(),id:$("."+elementoInicial).val()},
              type: 'GET',
              dataType: 'json',
              success: function (data) {
                  $("."+elementoFinal).html();
                  $("."+elementoFinal).html(data);
              }
          });

}

function limpiar(dato){

  for (i in dato) {
     $("."+dato[i]+" option:selected").text("");
     $("."+dato[i]+" option:selected").val("");
    }


}

function registraduria(event,evento,url,acme,type){
    if(acme!='A'){
      var keycode = (event.keyCode ? event.keyCode : event.which);
      if(keycode == 13) {
            $(".cargando").show();
          $.ajax({
              url: url,
              data: {cedula: $(evento).val(),acme:acme,type:type},
              type: 'GET',
              dataType: 'json',
              success: function (data) {
                  $(".cargando").hide();
                  $(".contenedor").html();
                  $(".contenedor").html(data);
              },
             error: function(error){

               $(".cargando").hide();
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
             },
          });
        }
    }
}


/**
*formulario persona estandar
*/

function acordionFormularioPE(numero){
  // $(event.target).parent().next().show();
  if($(".acordion-personae").eq(numero).css("display")=="none"){
      $(".acordion-personae").eq(numero).show(400);
  }else{
      // $(".acordion-personae").eq(1==3?numero:numero+1).hide(400);
      // $(".acordion-personae").eq(numero).hide(400);
      switch (numero) {
        case 1:
          $('.acordion-personae').each(function (index, value) {
              if(index!=0){
                $(".acordion-personae").eq(index).hide(400);
              }
          });
          break;
          case 2:
              $('.acordion-personae').each(function (index, value) {
                  if(index!=1 && index!=0){
                    $(".acordion-personae").eq(index).hide(400);
                  }
              });
            break;
        default:
          $(".acordion-personae").eq(numero).hide(400);
      }
  }


}

function fueraFoco(){
  $(".contenedor-combo").hide();
}
