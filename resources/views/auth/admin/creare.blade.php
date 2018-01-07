@if ($formulario ==='I')
<form class="formulario-persona" onsubmit="onCargandoSubmit()" enctype="multipart/form-data" id="form-persona" method="POST" action="{{ route('usuarioe.store') }}">
@elseif ($formulario ==='A')
<form class="formulario-persona" onsubmit="onCargandoSubmit()" enctype="multipart/form-data" id="form-persona" method="POST" action="{{ route('usuarioe.update',$usuario->id) }}">
<input name="_method" type="hidden" value="PUT">
@endif

    {{ csrf_field() }}
    <input type="hidden" name="type" value="{{$type}}"/>
    <button type="submit"  class="btn btn-primary">
        Guardar
    </button>
    <input class="btn btn-primary" onclick="mostrarSeccionMenu('I','usuarioe','')"  type="button" value="Cerrar">
    <input class="btn btn-primary" onclick="mostrarSeccionMenu('O','observation','{{empty($usuario)?'':$usuario->id}}')"  type="button" value="Observación">
<div class="row">
        <div class="col-md-3 acordion-personae" >
            @include("auth.admin.form.formheader");
        </div>
        <div class="col-md-3 acordion-personae" style="display:none;">
            <div class="semi-circulo" onclick="acordionFormularioPE(2)"><p class="h1">2</p></div>
            {{--CONDICION SOCIOECONOMICA ETIQUETAS--}}
            <h1>Información <span class="small">Detalles del personaje</span></h1>
            <div class="form-group">
              <label for="exampleInputEmail1">Condición socioeconomica:</label>

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
            <div class="form-group">
              <label for="exampleInputEmail1">Poblaciones:</label>
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
            <div class="form-group">
              <label for="exampleInputEmail1">Areas de Conocimiento:</label>
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
            <div class="form-group">
              <label for="exampleInputEmail1">Otros:</label>

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
            <div class="form-group">
                <label for="exampleInputEmail1">Buscar departamento:</label>
                <input type="text" onkeyup="despliegueCombo(this,'{{$urldesplieguedepartamento}}');limpiar(['desplieguefinal','desplieguepunto','desplieguemesa'])" class="form-control"  value="{{empty($objeto)?'':$objeto->nombre}}" placeholder="departamento">
                <small id="emailHelp" class="form-text text-muted">Señor seleccione un Departamento.</small>
            </div>

            <div class="form-group">
                <div class="col-md-12 ">
                   <select style="height: 35px;" name="{{$idname}}" class="form-control despliegue">
                     @if (!empty($objeto))
                        @include('combos.despliegue');
                     @elseif (!empty($departamento))
                        <option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
                     @endif
                   </select>
                </div>
            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">Buscar Ciudad:</label>
                <input type="text" onkeyup="despliegueComboFinal(this,'{{$urldesplieguefinal}}','despliegue','desplieguefinal');limpiar(['desplieguepunto','desplieguemesa'])" class="form-control"  value="{{empty($objetofinal)?'':$objetofinal->nombre}}" placeholder="ciudad">
                <small id="emailHelp" class="form-text text-muted">Señor seleccione una Ciudad.</small>
            </div>

            <div class="form-group">
                <div class="col-md-12 ">
                   <select style="height: 35px;" name="{{$idnamefinal}}" class="form-control desplieguefinal">
                     @if (!empty($objetofinal))
                        @include('combos.desplieguefinal');
                     @elseif (!empty($ciudad))
                        <option value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
                     @endif
                   </select>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Buscar Punto de votación:</label>
                <input type="text" style="text-align:center" onkeyup="despliegueComboFinal(this,'{{$urlpunto}}','desplieguefinal','desplieguepunto');limpiar(['desplieguemesa'])" class="form-control"  value="{{empty($punto)?'':$punto->direccion}}" placeholder="punto">
                <small id="emailHelp" class="form-text text-muted">Señor seleccione un punto de votación.</small>
            </div>

            <div class="form-group">
                <div class="col-md-12 ">
                   <select style="height: 35px;"  name="{{$idnamepunto}}" class="form-control desplieguepunto">
                     @if (!empty($punto))
                      <option value="{{$punto->id}}">{{$punto->direccion}}</option>
                     @endif

                   </select>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Buscar Mesa de votación:</label>
                <input type="number" name="mesa" onkeyup="despliegueComboFinal(this,'{{$urlmesa}}','desplieguepunto','desplieguemesa');" class="form-control"  value="{{empty($mesa)?'':$mesa->numero}}" placeholder="numero">
                <small id="emailHelp" class="form-text text-muted">Señor seleccione la mesa de votación.</small>
            </div>

            <div class="form-group">
                <div class="col-md-12 ">
                   <select style="height: 35px;" name="{{$idnamemesa}}" class="form-control desplieguemesa">

                     @if (!empty($mesa))
                        <option value="{{$mesa->id}}">{{$mesa->numero}}</option>
                     @endif
                   </select>
                </div>
            </div>
            <div class="form-group">
                <label align="center"  for="exampleInputEmail1">Potencial de votos:</label>
                <input style="text-align:center;"  type="number" name="potencial" class="form-control"  value="{{empty($usuario->potencial)?'':$usuario->potencial}}" placeholder="potencial votante">
                <small id="emailHelp" class="form-text text-muted">Potencial electoral. <span for="exampleInputEmail1" data-toggle="modal" data-target="#modal-potencial" style="cursor:pointer;font-weight:bold; color:#f79625 !important;" onclick="calcularPotencial('{{empty($usuario)?'':$usuario->id}}')">Ver.</span></small>

            </div>

            <div class="modal fade" id="modal-potencial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Potencial electoral</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body modal-potencial-cantidad">

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>


</form>
