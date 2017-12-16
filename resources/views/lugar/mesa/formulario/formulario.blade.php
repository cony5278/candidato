
<div class="form-group">
    <label for="exampleInputEmail1">Buscar Punto de votacion:</label>
    <input type="text" onkeyup="despliegueCombo(this,'{{$urldespliegue}}')" class="form-control"  value="{{empty($objeto)?'':$objeto->nombre}}" placeholder="punto de votación">
    <small id="emailHelp" class="form-text text-muted">Señor seleccione el Punto de Votación.</small>
</div>

<div class="form-group">
    <div class="col-md-12 ">
       <select style="height: 35px;" name="{{$idname}}" class="form-control despliegue">
         @if (!empty($objeto))
            @include('combos.despliegue');
         @endif
       </select>
    </div>
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Mesa:</label>
    <input type="text" class="form-control" name="numero" value="{{empty($mesa)?'':$mesa->numero}}" placeholder="numero">
    <small id="emailHelp" class="form-text text-muted">Señor usuario ingrese el numero de la mesa de votación.</small>
</div>
