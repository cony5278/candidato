<div class="container-fluid">
	<div class="row">
		<div class="col-md-0">
      <button type="submit" onclick="mostrarSeccionMenu('I','{{$urllistar.'/'.'create'}}','')" class="btn btn-primary">
          Nuevo
      </button>
		</div>
		<div class="col-md-2">
      <input id="nombreempresa" onkeyup="buscarEnTabla(this,'{{$urllistar.'/refrescar'}}','grilla-tabla')" type="text" onkeyup=""   placeholder="Buscar por dirección" class="form-control" name="buscarentabla"  value="" >
		</div>
		<div class="col-md-2">
			<a href="#"><img src="archivos/pdf.jpg"  width="50" height="50" /></a>
			<a href="#"><img src="archivos/excel.png"  width="50" height="50" /></a>
		</div>

	</div>
</div>
<div class="grilla-tabla">
  @include('periodo.ano.tabla')
</div>
