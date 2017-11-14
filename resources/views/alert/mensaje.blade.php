
@if(Session::has("activar"))
    @if(Session::get("activar"))

        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Alerta!</strong>{{Session::get("msj")}}
        </div>
    @endif
@endif
@if(session("errexito"))
<script>

    var notificacion = new Notificacion();
    notificacion.crearContenedor();
    notificacion.crearNotificacion("dfdsf", "SUCCESS");
</script>


@endif


