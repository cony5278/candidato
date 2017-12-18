
  <div class="modal-dialog" role="document" style="position:relative;">
     <div class="triandulo-observacion"></div>
    <div class="modal-content">
      <div class="modal-body">
          <div class="col-md-2">
            <img id="imagePreview" width="40" height="40" src="{{$observacion->photo=='default.png'?'archivos/\\default.png':'archivos/'.$observacion->type.'/'.$observacion->id_observador.'/'.$observacion->photo}}" class="img-circle" />
            
       		</div>
       		<div class="col-md-6">

            <h5 style="color:#007bff;">{{$observacion->nombreobservador.' '.$observacion->nombre2observador.' '.$observacion->apellidoobservador.' '.$observacion->apellido2observador}}&nbsp;</h5>
            <label for="exampleInputEmail1">{{$observacion->observacion}}</label>
          </div>
      </div>
      <div class="modal-footer">
          <label for="exampleInputEmail1">{{ $observacion->updated_at->format('d/m/Y H:i A')}}</label>
      </div>
    </div>
  </div>
