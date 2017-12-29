@if ($formulario ==='I')
<form class="formulario-persona" onsubmit="onCargandoSubmit()"  enctype="multipart/form-data" id="form-persona" method="POST" action="{{ route('usuario.store') }}">
@elseif ($formulario ==='A')
<form class="formulario-persona" onsubmit="onCargandoSubmit()"  enctype="multipart/form-data" id="form-persona" method="POST" action="{{ route('usuario.update',$usuario->id) }}">
<input name="_method" type="hidden" value="PUT">

@endif
{{ csrf_field() }}
<input type="hidden" name="type" value="{{$type}}"/>
    <button type="submit"  class="btn btn-primary">
        Guardar
    </button>
     <input class="btn btn-primary" onclick="mostrarSeccionMenu('I','usuario','')"  type="button" value="Cerrar">
<p></p>
<div class="container">
    <div class="row">

        <div class="col-xs-10 col-sm-10 col-lg-10">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Ingresar los datos para el usuario administrador:</h1></div>
                <div class="panel-body">
                          @include("auth.admin.form.formheader");
                </div>

            </div>
        </div>
    </div>
  </div>
</form>
