<div class="form-group">
    <label for="exampleInputEmail1">Nombre Departamento</label>
    <input type="text" class="form-control" name="nombre" value="{{empty($departamento)?'':$departamento->nombre}}" placeholder="departamento">
    <small id="emailHelp" class="form-text text-muted">Señor usuario ingrese un nombre para el departamento.</small>
</div>
