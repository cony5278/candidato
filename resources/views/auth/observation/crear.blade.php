
<form class="formulario-observation" onsubmit="onCargandoSubmit()"  enctype="multipart/form-data" id="form-persona" method="POST" action="{{ route('observation.store') }}">
{{ csrf_field() }}
<button type="submit"  class="btn btn-primary">
        Guardar
</button>
   <input class="btn btn-primary" onclick="mostrarSeccionMenu('A','{{$urllistar}}','{{$usuario->id}}')"  type="button" value="Cerrar">
   <input type="hidden" name="id_user"; value="{{$usuario->id}}">
<p></p>
<div class="container">
    <div class="row">

        <div class="col-xs-10 col-sm-10 col-lg-10">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Ingresar una observación:</h1></div>
                <div class="panel-body">
                  <label for="exampleInputEmail1">Observación:</label>
                  <input type="text" name="observacion"  class="form-control"  value="" placeholder="observación">

                </div>

            </div>
        </div>
    </div>
  </div>
</form>
