@if ($formulario ==='I')
<form class="formulario"  enctype="multipart/form-data" id="form-persona" method="POST" action=" {{route('ciudad.store')}}">
@elseif ($formulario ==='A')
<form class="formulario"  enctype="multipart/form-data" id="form-persona" method="POST" action="{{ route('ciudad.update',$ciudad->id) }}">
<input name="_method" type="hidden" value="PUT">

@endif
{{ csrf_field() }}
    <button type="submit"  class="btn btn-primary">
        Guardar
    </button>
     <input class="btn btn-primary" onclick="mostrarSeccionMenu('I','ciudad','')"  type="button" value="Cerrar">
<p></p>
<div class="container">
    <div class="row">

        <div class="col-xs-10 col-sm-10 col-lg-10">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Ingresar los datos Generales:</h1></div>
                <div class="panel-body">
                      @include("lugar.ciudad.formulario.formulario")
                </div>
            </div>
        </div>
    </div>
</form>
