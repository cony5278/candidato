


$(document).on('click','.pagination a',function(e){
    e.preventDefault();

    var pagina=$(this).attr('href').split('page=')[1];
    var ruta=$(this).attr('href').split('htt')[1];
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


function registraduria(event,evento,url,acme){
    if(acme!='A'){
      var keycode = (event.keyCode ? event.keyCode : event.which);
      if(keycode == 13) {
          $.ajax({
              url: url,
              data: {cedula: $(evento).val(),acme:acme},
              type: 'GET',
              dataType: 'json',
              success: function (data) {
                  $(".contenedor-persona").html();
                  $(".contenedor-persona").html(data);
              }
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
