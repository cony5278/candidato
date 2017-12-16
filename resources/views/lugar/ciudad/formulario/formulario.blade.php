<div class="form-group">
    <label for="exampleInputEmail1">Nombre Ciudad:</label>
    <input type="text" class="form-control" name="nombre" value="{{empty($ciudad)?'':$ciudad->nombre}}" placeholder="ciudad">
    <small id="emailHelp" class="form-text text-muted">Señor usuario ingrese un nombre para la ciudad.</small>
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Buscar departamento:</label>
    <input type="text" onkeyup="despliegueCombo(this,'{{$urldespliegue}}')" class="form-control"  value="{{empty($objeto)?'':$objeto->nombre}}" placeholder="departamento">
    <small id="emailHelp" class="form-text text-muted">Señor seleccione un Departamento.</small>
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
