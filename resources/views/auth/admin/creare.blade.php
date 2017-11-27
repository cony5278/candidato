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
          <img id="imagePreview" width="100" height="100" src="{{empty($usuario)?'archivos/\\default.png':'archivos/'.$usuario->type.'/'.$usuario->id.'/'.$usuario->photo}}" class="img-circle" />
            <div class="col-lg-10 col-sm-10 col-10">
                <div class="input-group">
                    <label class="input-group-btn">
                    <span class="btn btn-primary" >
                        Subir Imagen&hellip; <input id="imageUpload" type="file" name="photo" style="display: none;" multiple>
                    </span>
                    </label>
                    <input id="valor-img" type="text" onfocus="foco()" align="rigth" value="{{empty($usuario->photo)?null:$usuario->photo}}" style="position: relative;
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
                    <input id="name" onkeypress="registraduria(event,this,'{{$urldatosregistraduria}}')" type="text" onfocus="foco()" placeholder="Cedula" class="form-control" name="nit" value="{{ empty($nit)?empty($usuario->nit)?old('nit'):$usuario->nit:$nit }}" required autofocus>
                </div>
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="col-md-10">
                    <input id="name" type="text" onfocus="foco()" placeholder="Primer Nombre" class="form-control" name="nombre" value="{{ empty($nombre1)?empty($usuario->name)?old('name'):$usuario->name:$nombre1 }}" required autofocus>
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-10">
                    <input id="name" type="text" onfocus="foco()" placeholder="Segundo Nombre" class="form-control" name="nombre2" value="{{ empty($nombre2)?empty($usuario->name2)?old('name2'):$usuario->name2:$nombre2 }}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-10">
                    <input id="name" type="text" onfocus="foco()" placeholder="Primer Apellido" class="form-control" name="apellido" value="{{ empty($apellido1)?empty($usuario->lastname)?old('lastname'):$usuario->lastname:$apellido1 }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-10">
                    <input id="name" type="text" onfocus="foco()" placeholder="Segundo Apellido" class="form-control" name="apellido2" value="{{ empty($apellido2)?empty($usuario->lastname2)?old('lastname2'):$usuario->lastname2:$apellido2 }}">
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
                    <input id="name" type="text" onfocus="foco()" placeholder="Telefono movil" class="form-control" name="movil" value="{{empty($usuario->telefonomovil)? old('movil'):$usuario->telefonomovil }}" >
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-10">
                    <input id="name" type="text" onfocus="foco()" placeholder="Telefono Fijo" class="form-control" name="fijo" value="{{empty($usuario->telefonofijo)? old('fijo'):$usuario->telefonofijo }}" >
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-10">
                  {{Form::select('sexo', array('D'=> 'Sexo', 'F' => 'Femenino','M'=>'Maculino','O'=>'Otro'), empty($usuario->sex)?'D':$usuario->sex,array('class'=>'form-control','style'=>'height:35px'))}}

                </div>
            </div>

            <div class="form-group">
                <div class="col-md-10">
                    <input  id="name" type="text" onfocus="foco()" placeholder="Direccion Residencia" class="form-control" name="direccionusuario" value="{{ empty($usuario->address)?old('address'):$usuario->address }}" >
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
                          @if (!empty($usuario->id_socioeconomica))
                              @if ($condicion->id === $usuario->id_socioeconomica)
                                  <option value="{{$condicion->id}}" selected>{{$condicion->nivel}}</option>
                              @else
                                 <option value="{{$condicion->id}}">{{$condicion->nivel}}</option>
                              @endif
                          @else
                             <option value="{{$condicion->id}}">{{$condicion->nivel}}</option>
                          @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <select style="height: 35px;" name="poblacion" class="form-control">
                        <option value="0">Poblaciones</option>
                        @foreach($poblaciones as $poblacion)
                            @if (!empty($usuario->id_poblacions))
                                @if ($poblacion->id===$usuario->id_poblacions)
                                   <option value="{{$poblacion->id}}" selected>{{$poblacion->nombre}}</option>
                                @else
                                   <option value="{{$poblacion->id}}">{{$poblacion->nombre}}</option>
                                @endif
                            @else
                               <option value="{{$poblacion->id}}">{{$poblacion->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <select style="height: 35px;" name="area" class="form-control">
                        <option value="0">Areas de conocimiento</option>
                        @foreach($areasconocimiento as $area)
                            @if (!empty($usuario->id_areaconocimientos))
                                @if ($area->id===$usuario->id_areaconocimientos)
                                  <option value="{{$area->id}}" selected>{{$area->nombre}}</option>
                                @else
                                  <option value="{{$area->id}}">{{$area->nombre}}</option>
                                @endif
                            @else
                              <option value="{{$area->id}}">{{$area->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <select style="height: 35px;" name="otro" class="form-control">
                        <option value="0">Otros</option>
                        @foreach($otros as $otro)
                              @if (!empty($usuario->id_areaconocimientos))
                                  @if ($otro->id===$usuario->id_otros))
                                      <option value="{{$otro->id}}" selected>{{$otro->nombre}}</option>
                                  @else
                                      <option value="{{$otro->id}}">{{$otro->nombre}}</option>
                                  @endif
                              @else
                                  <option value="{{$otro->id}}">{{$otro->nombre}}</option>
                              @endif
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


                                    <select onchange="agregarSeleccionFormacion(this);" style="height: 35px;" name="nivelacademico" class="form-control" >
                                        @foreach($nivelacademico as $academico)
                                            <option value="{{$academico->id}}">{{$academico->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                  @if (!empty($formacions))
                                    @foreach($formacions as $formacion)
                                        <script type="text/javascript">
                                              agregarSeleccionSinEvento('{{App\Nivelacademico::find($formacion->id_nivelacademicos)->nombre}}','{{$formacion->id_nivelacademicos}}','{{$formacion->descripcion}}');

                                        </script>
                                      @endforeach
                                  @endif
                                <div class="col-md-12 agregar-formacion">


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
                                            <input id="nombreempresa" type="text" onfocus="foco()" placeholder="Nombre Empresa" class="form-control" name="empresa"  value="{{ empty($usuario->empresa)?old('nombreempresa'):$usuario->empresa}}" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <input id="cargoempresa" type="text" onfocus="foco()" placeholder="Cargo Empresa" class="form-control" name="cargo"  value="{{ empty($usuario->cargo)? old('cargoempresa'):$usuario->cargo}}" >
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
                    <input type="hidden" name="id_departamento" id="entrada-departamento-id" value="{{empty($iddepartamento)?empty($usuario->id_departamento)?null:$usuario->id_departamento:$iddepartamento}}"/>
                    <input  id="entrada-departamento"   onkeyup="paginacion(this,'{{$urldepartamento}}')" type="text" onfocus="foco()"  placeholder="Departamento" class="form-control entrada-combo" name="departamento" value="{{ empty($departamento)?empty($usuario->departamento)?old('departamento'):$usuario->departamento:$departamento }}" required autofocus>
                </div>
            </div>

            <div class="form-group" >

                <div class="col-md-10" style="position: relative !important;">
                    <div class="col-md-10 contenedor-combo" id="contenedor-combo-ciudad" style="display: none; position: absolute; right:100%; top:0%;">

                    </div>
                    <input type="hidden" name="id_ciudad" id="entrada-ciudad-id" value="{{empty($idciudad)?empty($usuario->id_ciudad)?null:$usuario->id_ciudad:$idciudad}}"/>
                    <input id="entrada-ciudad"     onkeyup="paginacion(this,'{{$urlciudades}}')" type="text" onfocus="foco()"  placeholder="Ciudad" class="form-control entrada-combo" name="ciudad" value="{{empty($ciudad)?empty($usuario->ciudad)?old('ciudad'):$usuario->ciudad:$ciudad }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-10">
                    <input id="name" type="text" onfocus="foco()" placeholder="Direccion" class="form-control" name="direccionvotacion" value="{{ empty($direccion)?empty($usuario->direccion)?old('direccion'):$usuario->direccion:$direccion }}" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                    <input id="name" type="text" onfocus="foco()" placeholder="Mesa de votación" class="form-control" name="mesavotacion" value="{{empty($mesa)?empty($usuario->numero)?old('fijo'):$usuario->numero:$mesa }}" required autofocus>
                </div>
            </div>
        </div>
    </div>

    </div>
</form>
