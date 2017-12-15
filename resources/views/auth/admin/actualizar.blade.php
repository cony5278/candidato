<form class="formulario-persona" enctype="multipart/form-data" id="form-persona" method="POST" action="{{ route('usuario.update',$usuario->id) }}">

    <input name="_method" type="hidden" value="PUT">

    <button type="submit"  class="btn btn-primary">
        Guardar
    </button>
    <input class="btn btn-primary" onclick="mostrarseccion('L','')"  type="button" value="Cerrar">
    <p></p>
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Persona</div>
                    <div class="panel-body">
                      
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
