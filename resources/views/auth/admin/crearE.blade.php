@if ($formulario ==='I')
<form class="formulario-persona" onsubmit="onCargandoSubmit()" enctype="multipart/form-data" id="form-persona" method="POST" action="{{ route('registrare') }}">
@elseif ($formulario ==='A')
<form class="formulario-persona" onsubmit="onCargandoSubmit()" enctype="multipart/form-data" id="form-persona" method="POST" action="{{ route('usuarioe.update',$usuario->id) }}">
<input name="_method" type="hidden" value="PUT">
@endif

    {{ csrf_field() }}
    <input type="hidden" name="type" value="{{$type}}"/>
    <button type="submit"  class="btn btn-primary">
        Guardar
    </button>
    <input class="btn btn-primary" onclick="mostrarseccion('{{$type=='A'?'L':'LL'}}','')"  type="button" value="Cerrar">
<div class="row">
        <div class="col-md-3 acordion-personae" >
            @include("auth.admin.form.formheader");
        </div>
        <div class="col-md-3 acordion-personae" style="display:none;">
            <div class="semi-circulo" onclick="acordionFormularioPE(2)"><p class="h1">2</p></div>
            {{--CONDICION SOCIOECONOMICA ETIQUETAS--}}
            <h1>Información <span class="small">Detalles del personaje</span></h1>
            <div class="form-group">
                <div class="col-md-12">
                    <select style="height: 35px;" name="condicionsocial" class="form-control">
                        <option value="0">Condición socioeconomica</option>
                        @foreach($condicionsocioeconomicas as $condicion)
                          @if (!empty($opcion))
                              @if ($condicion->id === $opcion->id_socioeconomica)
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
                            @if (!empty($opcion))
                                @if ($poblacion->id===$opcion->id_poblacions)
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
                            @if (!empty($opcion))
                                @if ($area->id===$opcion->id_areaconocimientos)
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
                              @if (!empty($opcion))
                                  @if ($otro->id===$opcion->id_otros))
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
        <div class="col-md-3 acordion-personae" style="display:none;">
                <div class="semi-circulo" onclick="acordionFormularioPE(3)"><p class="h1">3</p></div>
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
                                              agregarSeleccionSinEvento('{{App\Nivelacademico::find($formacion->id_nivelacademicos)->id}}','{{App\Nivelacademico::find($formacion->id_nivelacademicos)->nombre}}','{{$formacion->id}}','{{$formacion->descripcion}}');
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
                                            <input type="hidden" name="id_empresa" value="{{empty($empresa->id)?null:$empresa->id}}">
                                            <input id="nombreempresa" type="text"  placeholder="Nombre Empresa" class="form-control" name="empresa"  value="{{ empty($empresa->nombre)?old('nombreempresa'):$empresa->nombre}}" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <input id="cargoempresa" type="text"  placeholder="Cargo Empresa" class="form-control" name="cargo"  value="{{ empty($empresa->cargo)? old('cargoempresa'):$empresa->cargo}}" >
                                        </div>
                                    </div>

                        </div>
                    </div>
                </div>

            </div>


        </div>

        <div class="col-md-3 acordion-personae" style="display:none;">
          <div class="semi-circulo" onclick="acordionFormularioPE(-1)"><p class="h1">1</p></div>
            <h1>Información Electoral <span class="small">Datos electorales</span></h1>
            <div class="form-group" >

                <div class="col-md-10" style="position: relative !important;">
                    <div class="col-md-14 contenedor-combo"  id="contenedor-combo-departamento" style="z-index:10;background:#fff; display: none; position: absolute; right:100%; top:0%;">

                    </div>
                    <input type="hidden" name="id_departamento" id="entrada-departamento-id" value="{{empty($iddepartamento)?empty($mesavotacion->id_departamento)?null:$mesavotacion->id_departamento:$iddepartamento}}"/>
                    <input  id="entrada-departamento"  onclick="fueraFoco()"   onkeyup="paginacion(this,'{{$urldepartamento}}')" type="text"   placeholder="Departamento" class="form-control entrada-combo" name="departamento" value="{{ empty($departamento)?empty($mesavotacion->departamento)?old('departamento'):$mesavotacion->departamento:$departamento }}" required autofocus>
                </div>
            </div>

            <div class="form-group" >

                <div class="col-md-10" style="position: relative !important;">
                    <div class="col-md-14 contenedor-combo" id="contenedor-combo-ciudad" style="z-index:10;background:#fff; display: none; position: absolute; right:100%; top:0%;">

                    </div>
                    <input type="hidden" name="id_ciudad" id="entrada-ciudad-id" value="{{empty($idciudad)?empty($mesavotacion->id_ciudad)?null:$mesavotacion->id_ciudad:$idciudad}}"/>
                    <input id="entrada-ciudad" onclick="fueraFoco()"    onkeyup="paginacion(this,'{{$urlciudades}}')" type="text"   placeholder="Ciudad" class="form-control entrada-combo" name="ciudad" value="{{empty($ciudad)?empty($mesavotacion->ciudad)?old('ciudad'):$mesavotacion->ciudad:$ciudad }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-10">
                    <input id="name" type="text"  placeholder="Direccion" class="form-control" name="direccionvotacion" value="{{ empty($direccion)?empty($mesavotacion->direccion)?old('direccion'):$mesavotacion->direccion:$direccion }}" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10">
                  <input type="hidden" name="id_mesa" id="entrada-ciudad-id" value="{{empty($mesavotacion->id_mesa)?null:$mesavotacion->id_mesa}}"/>
                  <input id="name" type="text"  placeholder="Mesa de votación" class="form-control" name="mesavotacion" value="{{empty($mesa)?empty($mesavotacion->numero)?old('fijo'):$mesavotacion->numero:$mesa }}" required autofocus>
                </div>
            </div>
        </div>
    </div>

    </div>
</form>
