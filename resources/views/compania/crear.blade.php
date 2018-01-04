
<form class="formulario-ge" onsubmit="onCargandoSubmit()"  enctype="multipart/form-data" id="form-persona" method="POST" action="{{ route('compania.update',$compania->id) }}">
<input name="_method" type="hidden" value="PUT">
  <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

{{ csrf_field() }}
    <button type="submit"  class="btn btn-primary">
        Guardar
    </button>

<p></p>
<div class="container">
    <div class="row">

        <div class="col-xs-10 col-sm-10 col-lg-10">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Ingresar los datos generales:</h1></div>
                <div class="panel-body">
                      @include("compania.formulario.formulario")
                </div>
            </div>
        </div>
    </div>
</div>
</form>
