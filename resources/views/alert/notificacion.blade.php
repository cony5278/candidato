@if(Session::has("msj"))
    <script>
      $(document).ready(function(){
            var notificacion = new Notificacion();
            notificacion.crearContenedor();
            notificacion.crearNotificacion("{{Session::get('msj')}}","{{Session::get('notificacion')}}");

    });
    </script>
@endif
@if(!empty($msj))
    <script>
      $(document).ready(function(){
            var notificacion = new Notificacion();
            notificacion.crearContenedor();
            notificacion.crearNotificacion("{{Session::get('msj')}}","{{Session::get('notificacion')}}");

    });
    </script>
@endif

@foreach($errors->all() as $error)
    <script>
        $(document).ready(function(){
            var notificacion = new Notificacion();
            notificacion.crearContenedor();
            notificacion.crearNotificacion("{{$error}}","DANGER");
        });

    </script>

@endforeach
<div class="notificacion"></div>
