
<form class="formulario-ge" id="formulario-reporte"   enctype="multipart/form-data"  method="POST" action=" {{route('oprimirPdf')}}">
<input type="hidden" id="tiporeporte" name="tiporeporte" value="">
    {{ csrf_field() }}
<p></p>
<div class="container">
    <div class="row">

        <div class="col-xs-8 col-sm-8 col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Informe de Puntos de Votación:</h1></div>
                <div class="panel-body">
                      @include("lugar.mesa.informe.formulario.formulario")
                </div>
            </div>
        </div>
    </div>
</div>
</form>
