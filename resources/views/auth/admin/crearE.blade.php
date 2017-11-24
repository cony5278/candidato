<form class="formulario-persona" enctype="multipart/form-data" id="form-persona" method="POST" action="{{ route('registrare') }}">
    {{ csrf_field() }}
    <input type="hidden" name="type" value="{{Auth::user()->type}}"/>
    <button type="submit"  class="btn btn-primary">
        Guardar
    </button>
    <input class="btn btn-primary" onclick="mostrarseccion('L','')"  type="button" value="Cerrar">
<div class="row">
        <div align="center" class="col-md-3">
            {{--PERSONAJE--}}
            <h1>Información <span class="small">Personaje</span></h1>
            <img id="imagePreview" width="100" height="100" src="http://placehold.it/150X150" class="img-circle" />
            <div class="col-lg-10 col-sm-10 col-10">
                <div class="input-group">
                    <label class="input-group-btn">
                    <span class="btn btn-primary" >
                        Subir Imagen&hellip; <input id="imageUpload" type="file" name="photo" style="display: none;" multiple>
                    </span>
                    </label>
                    <input id="valor-img" type="text" onfocus="foco()" align="rigth" value="" style="position: relative;
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
                    <input id="name" onkeypress="registraduria(event,this,'{{$urldatosregistraduria}}')" type="text" onfocus="foco()" placeholder="Cedula" class="form-control" name="nit" value="{{ empty($nit)?old('nit'):$nit }}" required autofocus>
                </div>
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="col-md-10">
                    <input id="name" type="text" onfocus="foco()" placeholder="Primer Nombre" class="form-control" name="nombre" value="{{ empty($nombre1)?old('name'):$nombre1 }}" required autofocus>
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-10">
                    <input id="name" type="text" onfocus="foco()" placeholder="Segundo Nombre" class="form-control" name="nombre2" value="{{ empty($nombre2)?old('name2'):$nombre2 }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-10">
                    <input id="name" type="text" onfocus="foco()" placeholder="Primer Apellido" class="form-control" name="apellido" value="{{ empty($apellido1)?old('lastname'):$apellido1 }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-10">
                    <input id="name" type="text" onfocus="foco()" placeholder="Segundo Apellido" class="form-control" name="apellido2" value="{{ empty($apellido2)?old('lastname2'):$apellido2 }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-10">
                    <input id="email" type="email" placeholder="Correo electronico" class="form-control" name="email" value="{{ old('email') }}" required>

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
                            <input class="form-control" id="date" name="fechanacimiento" placeholder="MM/DD/YYYY" type="text">
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
                    <input id="name" type="text" onfocus="foco()" placeholder="Telefono movil" class="form-control" name="movil" value="{{ old('movil') }}" >
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-10">
                    <input id="name" type="text" onfocus="foco()" placeholder="Telefono Fijo" class="form-control" name="fijo" value="{{ old('fijo') }}" >
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-10">
                    <select style="height: 35px;" name="sexo" class="form-control">
                        <option value="D">Sexo</option>
                        <option value="F">Femenino</option>
                        <option value="M">Masculino</option>
                        <option value="O">Otro</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-10">
                    <input  id="name" type="text" onfocus="foco()" placeholder="Direccion Residencia" class="form-control" name="direccionusuario" value="{{ old('address') }}" >
                </div>
            </div>

        </div>
        <div class="col-md-3">
            {{--CONDICION SOCIOECONOMICA ETIQUETAS--}}
            <h1>Información <span class="small">Detalles del personaje</span></h1>
            <div class="form-group">
                <div class="col-md-12">
                    <select style="height: 35px;" name="condicionsocial" class="form-control">
                        <option value="0">Condición socioeconomica</option>
                        @foreach($condicionsocioeconomicas as $condicion)
                            <option value="{{$condicion->id}}">{{$condicion->nivel}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <select style="height: 35px;" name="poblacion" class="form-control">
                        <option value="0">Poblaciones</option>
                        @foreach($poblaciones as $poblacion)
                            <option value="{{$poblacion->id}}">{{$poblacion->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <select style="height: 35px;" name="area" class="form-control">
                        <option value="0">Areas de conocimiento</option>
                        @foreach($areasconocimiento as $area)
                            <option value="{{$area->id}}">{{$area->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <select style="height: 35px;" name="otro" class="form-control">
                        <option value="0">Otros</option>
                        @foreach($otros as $otro)
                            <option value="{{$otro->id}}">{{$otro->nombre}}</option>
                        @endforeach
                    </select>
                 </div>
            </div>
        </div>
        <div class="col-md-3">
            {{--INFORMACION ELECTORAL--}}
            <h1>Formación <span class="small">Información académica y laboral</span></h1>
            <div id="accordion" role="tablist">
                <div class="card">
                    <div class="card-header" role="tab" id="headingOne">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Académica
                            </a>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="col-md-12">


                                    <select style="height: 35px;" name="nivelacademico" class="form-control" multiple >
                                        @foreach($nivelacademico as $academico)
                                            <option value="{{$academico->id}}">{{$academico->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingTwo">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Laboral
                            </a>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">

                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <input id="nombreempresa" type="text" onfocus="foco()" placeholder="Nombre Empresa" class="form-control" name="empresa"  value="{{ old('nombreempresa')}}" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <input id="cargoempresa" type="text" onfocus="foco()" placeholder="Cargo Empresa" class="form-control" name="cargo"  value="{{ old('cargoempresa')}}" >
                                        </div>
                                    </div>

                        </div>
                    </div>
                </div>

            </div>


        </div>

        <div class="col-md-3">
            <h1>Información Electoral <span class="small">Datos electorales</span></h1>
            <div class="form-group" >

                <div class="col-md-10" style="position: relative !important;">
                    <div class="col-md-10 contenedor-combo" id="contenedor-combo-departamento" style="display: none; position: absolute; right:100%; top:0%;">

                    </div>
                    <input type="hidden" name="id_departamento" id="entrada-departamento-id" value="{{empty($iddepartamento)?'':$iddepartamento}}"/>
                    <input  id="entrada-departamento"   onkeyup="paginacion(this,'{{$urldepartamento}}')" type="text" onfocus="foco()"  placeholder="Departamento" class="form-control entrada-combo" name="departamento" value="{{ empty($departamento)?old('departamento'):$departamento }}" required autofocus>
                </div>
            </div>

            <div class="form-group" >

                <div class="col-md-10" style="position: relative !important;">
                    <div class="col-md-10 contenedor-combo" id="contenedor-combo-ciudad" style="display: none; position: absolute; right:100%; top:0%;">

                    </div>
                    <input type="hidden" name="id_ciudad" id="entrada-ciudad-id" value="{{empty($idciudad)?'':$idciudad}}"/>
                    <input id="entrada-ciudad"     onkeyup="paginacion(this,'{{$urlciudades}}')" type="text" onfocus="foco()"  placeholder="Ciudad" class="form-control entrada-combo" name="ciudad" value="{{empty($ciudad)?old('ciudad'):$ciudad }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-10">
                    <input id="name" type="text" onfocus="foco()" placeholder="Direccion" class="form-control" name="direccionvotacion" value="{{ empty($direccion)?old('direccion'):$direccion }}" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input id="name" type="text" onfocus="foco()" placeholder="Mesa de votación" class="form-control" name="mesavotacion" value="{{empty($mesa)?old('fijo'):$mesa }}" required autofocus>
                </div>
            </div>
        </div>
    </div>

    </div>
</form>