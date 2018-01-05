<div class="form-group">
    <label for="exampleInputEmail1">Buscar Año:</label>
    <input type="number" onkeyup="despliegueCombo(this,'{{$urldespliegue}}')" class="form-control"  value="{{empty($ano)?'':$ano->numero}}" placeholder="ano">
    <small id="emailHelp" class="form-text text-muted">Señor usuario seleccione un año.</small>
</div>

<div class="form-group">
    <div class="col-md-12 ">
       <select style="height: 35px;" name="{{$idano}}" class="form-control despliegue">
         @if (!empty($ano))
            @include('combos.despliegueano');
         @endif
       </select>
    </div>
</div>
