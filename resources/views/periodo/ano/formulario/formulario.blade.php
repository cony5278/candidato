<div class="form-group">
    <label for="exampleInputEmail1">Numero del Año:</label>
    <input type="number" onkeyup="tipoCampo(this,'entero',null,null,4)" class="form-control" name="numero" min="-9999" max="9999"   value="{{empty($ano)?'':$ano->numero}}" placeholder="numero">
    <small id="emailHelp" class="form-text text-muted">Señor usuario ingrese el numero del año.</small>
</div>
