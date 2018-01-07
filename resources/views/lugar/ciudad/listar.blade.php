<div class="container-fluid">
	<div class="row">
		<div class="col-md-0">
      <button type="submit" onclick="mostrarSeccionMenu('I','{{$urllistar.'/'.'create'}}','')" class="btn btn-primary">
          Nuevo
      </button>
		</div>
		<div class="col-md-2">
      <input id="nombreempresa" onkeyup="buscarEnTabla(this,'{{$urllistar.'/refrescar'}}','grilla-tabla')" type="text"  placeholder="Buscar ciudad" class="form-control" name="buscarentabla"  value="" >

		</div>
		<div class="col-md-0">
			<a style="cursor:pointer;" class="btn btn-default" onclick="oprimirHref('{{url('oprimirciudadgeneralpdf')}}','nombreempresa')"><img src="archivos/pdf.jpg"  width="50" height="50" /></a>
		</div>
		<div class="col-md-0">
			<a style="cursor:pointer;" class="btn btn-default" onclick="oprimirHref('{{url('oprimirciudadgeneralexcel')}}','nombreempresa')"><img src="archivos/excel.png"  width="50" height="50" /></a>
		</div>
	</div>
</div>
<div class="grilla-tabla">
    @include('lugar.ciudad.tabla')
</div>
