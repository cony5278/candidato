<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/enviar.js')}}"></script>


<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Seleccion</h5>
      <button type="button" class="close" onclick="cerrarFormacion(event);" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="form-group">
          <div class="col-md-10">
              <input id="name" type="text" onfocus="foco()"  placeholder="Nivel academico" class="form-control" name="foromacionacademica[]" disabled>
          </div>
      </div>
      <div class="form-group">
          <div class="col-md-10">
              <input id="name" type="text" onfocus="foco()" placeholder="Descripcion" class="form-control" name="descripcionacademica[]">
          </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="cerrarFormacion(event);" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>
