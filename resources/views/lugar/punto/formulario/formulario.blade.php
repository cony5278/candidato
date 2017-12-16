
<div class="form-group">
    <label for="exampleInputEmail1">Buscar Ciudad:</label>
    <input type="text" onkeyup="despliegueCombo(this,'{{$urldespliegue}}')" class="form-control"  value="{{empty($objeto)?'':$objeto->nombre}}" placeholder="ciudad">
    <small id="emailHelp" class="form-text text-muted">Señor seleccione una Ciudad.</small>
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
    <label for="exampleInputEmail1">Nombre del punto de votación (Barrio o localidad):</label>
    <input type="text" class="form-control" name="nombre" value="{{empty($punto)?'':$punto->nombre}}" placeholder="punto de votacion">
    <small id="emailHelp" class="form-text text-muted">Señor usuario ingrese el punto de votación.</small>
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Direccion del punto de votación:</label>
    <input type="text" class="form-control" name="direccion" value="{{empty($punto)?'':$punto->direccion}}" placeholder="dirección">
    <small id="emailHelp" class="form-text text-muted">Señor usuario ingrese la direccion del punto de votación.</small>
</div>
