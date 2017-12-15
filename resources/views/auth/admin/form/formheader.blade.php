  @if ($type =='E')
  <div class="semi-circulo" onclick="acordionFormularioPE(1)"><p class="h1">1</p></div>
  @endif
    {{--PERSONAJE--}}
    <h1>Información <span class="small">Personaje</span></h1>
  <img id="imagePreview" width="100" height="100" src="{{empty($usuario)?'archivos/\\default.png':$usuario->photo=='default.png'?'archivos/\\default.png':'archivos/'.$usuario->type.'/'.$usuario->id.'/'.$usuario->photo}}" class="img-circle" />
    <div class="col-lg-10 col-sm-10 col-10">
        <div class="input-group">
            <label class="input-group-btn">
            <span class="btn btn-primary" >
                Subir Imagen&hellip; <input id="imageUpload" type="file" name="photo" style="display: none;" multiple>
            </span>
            </label>
            <input id="valor-img" type="text"  align="rigth" value="{{empty($usuario->photo)?null:$usuario->photo}}" style="position: relative;
                                         left: 79px;max-width:55% !important; height: 25px !important;" class="form-control" disabled>

        </div>
        <span class="help-block">

    </span>
        <script>
            $('#imageUpload').change(function(){
                readImgUrlAndPreview(this);
                function readImgUrlAndPreview(input){
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = (function(theFile) {
                            return function(e) {
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

    <div  class="form-group grupos">
        <div class="col-md-10">
            <input id="name" onkeypress="registraduria(event,this,'{{$urldatosregistraduria}}','{{$formulario}}','{{$type}}')" type="text"  placeholder="Cedula" class="form-control" name="nit" value="{{ empty($nit)?empty($usuario->nit)?old('nit'):$usuario->nit:$nit }}" required autofocus>
        </div>
    </div>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <div class="col-md-10">
            <input id="name" type="text"  placeholder="Primer Nombre" class="form-control" name="nombre" value="{{ empty($nombre1)?empty($usuario->name)?old('name'):$usuario->name:$nombre1 }}" required autofocus>
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-10">
            <input id="name" type="text"  placeholder="Segundo Nombre" class="form-control" name="nombre2" value="{{ empty($nombre2)?empty($usuario->name2)?old('name2'):$usuario->name2:$nombre2 }}">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-10">
            <input id="name" type="text"  placeholder="Primer Apellido" class="form-control" name="apellido" value="{{ empty($apellido1)?empty($usuario->lastname)?old('lastname'):$usuario->lastname:$apellido1 }}" required autofocus>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-10">
            <input id="name" type="text"  placeholder="Segundo Apellido" class="form-control" name="apellido2" value="{{ empty($apellido2)?empty($usuario->lastname2)?old('lastname2'):$usuario->lastname2:$apellido2 }}">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-10">
            <input id="email" type="email" placeholder="Correo electronico" class="form-control" name="email" value="{{empty($usuario->email)? old('email') :$usuario->email}}" required>

        </div>
    </div>

    <div class="form-group" >
        <div class="bootstrap-iso">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="input-group">
                    <div class="input-group-addon" style="z-index:1000; width: 25px">
                        <i class="fa fa-calendar"  style="z-index:1000;">
                        </i>
                    </div>
                    <input class="form-control" id="date" name="fechanacimiento" placeholder="MM/DD/YYYY" value="{{empty($usuario->birthdate)?old('birthdate'):Carbon\Carbon::parse($usuario->birthdate)->format('d/m/Y')  }}" type="text">
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                var date_input=$('input[name="fechanacimiento"]'); //our date input has the name "date"
                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                var options={
                    format: 'mm/dd/yyyy',
                    container: container,
                    todayHighlight: true,
                    autoclose: true,
                };
                date_input.datepicker(options);
            })
        </script>
    </div>


    <div class="form-group">
        <div class="col-md-10">
            <input id="name" type="number"  placeholder="Telefono movil" class="form-control" name="movil" value="{{empty($usuario->telefonomovil)? old('movil'):$usuario->telefonomovil }}" >
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-10">
            <input id="name" type="number"  placeholder="Telefono Fijo" class="form-control" name="fijo" value="{{empty($usuario->telefonofijo)? old('fijo'):$usuario->telefonofijo }}" >
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-10">
          {{Form::select('sexo', array('O'=> 'Sexo', 'F' => 'Femenino','M'=>'Maculino','O'=>'Otro'), empty($usuario->sex)?'D':$usuario->sex,array('class'=>'form-control','style'=>'height:35px'))}}

        </div>
    </div>

    <div class="form-group">
        <div class="col-md-10">
            <input  id="name"  type="text"  placeholder="Direccion Residencia" class="form-control" name="direccionusuario" value="{{ empty($usuario->address)?old('address'):$usuario->address }}">
        </div>
    </div>
