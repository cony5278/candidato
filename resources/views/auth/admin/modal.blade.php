@if ($formulario ==='I')
<form class="formulario-modal" onsubmit="onCargandoSubmit()"  enctype="multipart/form-data" id="form-persona" method="POST" action="{{ route('usuario.store') }}">
@elseif ($formulario ==='A')
<form class="formulario-modal" onsubmit="onCargandoSubmit()"  enctype="multipart/form-data" id="form-persona" method="POST" action="{{ route('usuario.update',$usuario->id) }}">
<input name="_method" type="hidden" value="PUT">

@endif
{{ csrf_field() }}
<input type="hidden" name="type" value="{{Auth::user()->type=='S'?'S':$type}}"/>
<div class="modal fade" style="height:700px;   overflow-y:hidden;" id="modal-edicion">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edición</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-edicion-usuario" style="height:566px; overflow-y:scroll;">

              @include('auth.admin.form.formheader')

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

</form>
