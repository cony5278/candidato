


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

function foco(){
    $(".contenedor-combo").hide();
}
function registraduria(event,evento,url){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == 13) {
        $.ajax({
            url: url,
            data: {cedula: $(evento).val()},
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $(".contenedor-persona").html();
                $(".contenedor-persona").html(data);
            }
        });
    }
}