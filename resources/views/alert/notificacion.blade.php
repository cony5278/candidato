@if(Session::has("msj"))
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
@if(Session::has("seccion"))
    @if(Session::get("seccion")=='II')
      <script>
            mostrarseccion('II','');
      </script>
    @endif
    @if(Session::get("seccion")=='A')
      <script>
            // mostrarseccion('A',{{Session::get("seccionid")}});
          mostrarSeccionMenu("A","{{Session::get('urllistar').'/'}}","{{Session::get('seccionid')}}");
      </script>
    @endif
    @if(Session::get("seccion")=='I')
      <script>
        mostrarSeccionMenu("I","{{Session::get('urllistar').'/'.'create'}}","");
      </script>
    @endif

@endif
<div class="notificacion"></div>
