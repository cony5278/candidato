<div class="container-fluid">
	<div class="row">
		<div class="col-md-0">
      <button type="submit" onclick="mostrarSeccionMenu('I','{{$urllistar.'/'.'create'}}','')" class="btn btn-primary">
          Nuevo
      </button>
		</div>
		<div class="col-md-2">
      <input id="nombreempresa" type="text" onkeyup="buscarEnTabla(this,'{{$urllistar.'/refrescar'}}','grilla-tabla')"  placeholder="Buscar" class="form-control" name="buscarentabla"  value="" >

		</div>
	</div>
</div>
<div class="grilla-tabla">
	@include('lugar.departamento.tabla')
</div>
