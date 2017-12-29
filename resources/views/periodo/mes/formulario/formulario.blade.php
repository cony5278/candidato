<div class="form-group">
    <label for="exampleInputEmail1">Nombre del mes:</label>
    <input type="text" class="form-control" name="nombre"   value="{{empty($mes)?'':$mes->nombre}}" placeholder="nombre">
    <small id="emailHelp" class="form-text text-muted">Señor usuario ingrese el mes.</small>
</div>
