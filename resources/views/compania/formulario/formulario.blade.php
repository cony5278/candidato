<div class="form-group">
      <div class="col-lg-10 col-sm-10 col-10">
        <div class="input-group">
            <label class="input-group-btn">
            <span class="btn btn-primary" >
                Subir Imagen&hellip; <input id="imageUpload" type="file" name="photo" style="display: none;" multiple>
            </span>
            </label>
            <input id="valor-img" type="text"  align="rigth" value="{{empty($compania)?'':$compania->imagen}}" style="position: relative;
                                         left: 79px;max-width:55% !important; height: 25px !important;" class="form-control" disabled>

        </div>
        <script>
            $('#imageUpload').change(function(){
                readImgUrlAndPreview(this);
                function readImgUrlAndPreview(input){
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = (function(theFile) {
                            return function(e) {
                                  photo[0]=theFile;
                                $('#imagePreview').attr('src', e.target.result);
                                $('#valor-img').attr('value', theFile.name);
                            };
                        })(input.files[0]);

                    };
                    reader.readAsDataURL(input.files[0]);
                }
            });
        </script>
    </div>
</div>
<div class="form-group">
  <img id="imagePreview" width="200" height="200" src="{{$compania->imagen=='default.png'?'archivos/\\default.png':'archivos/'.Auth::user()->type.'/'.Auth::user()->id.'/'.$compania->imagen}}" class="img-thumbnail" />
</div>
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


<div class="form-group">
    <label for="exampleInputEmail1">Buscar Mes:</label>
    <input type="text" onkeyup="despliegueComboClass(this,'{{$urldesplieguefinal}}','desplieguemes','')" class="form-control"  value="{{empty($mes)?'':$mes->nombre}}" placeholder="mes">
    <small id="emailHelp" class="form-text text-muted">Señor usuario seleccione un mes.</small>
</div>

<div class="form-group">
    <div class="col-md-12 ">
       <select style="height: 35px;" name="{{$idmes}}" class="form-control desplieguemes">
         @if (!empty($mes))
            @include('combos.desplieguemes');
         @endif
       </select>
    </div>
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Día:</label>
    <input type="number" name="dia" class="form-control"  value="{{empty($compania)?'':$compania->dia}}" placeholder="dia">
    <small id="emailHelp" class="form-text text-muted">Señor usuario digite un dia.</small>
</div>