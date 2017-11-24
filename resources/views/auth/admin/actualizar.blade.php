<form class="formulario-persona" enctype="multipart/form-data" id="form-persona" method="POST" action="{{ route('usuario.update',$usuario->id) }}">

    <input name="_method" type="hidden" value="PUT">

    <button type="submit"  class="btn btn-primary">
        Guardar
    </button>
    <input class="btn btn-primary" onclick="mostrarseccion('L','')"  type="button" value="Cerrar">
    <p></p>
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Persona</div>
                    <div class="panel-body">
                        <div class="col-xs-3 col-sm-3 col-lg-3" >

                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-lg btn-primary">
                                        Archivo <input id="imageUpload" type="file" name="photo" style="display: none;" multiple>
                                    </span>
                                </label>
                            </div>
                            <script>
                                $('#imageUpload').change(function(){
                                    readImgUrlAndPreview(this);
                                    function readImgUrlAndPreview(input){
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();
                                            reader.onload = function (e) {
                                                $('#imagePreview').attr('src', e.target.result);
                                            }
                                        };
                                        reader.readAsDataURL(input.files[0]);
                                    }
                                });
                            </script>
                            <img id="imagePreview"  alt="Bootstrap Image Preview" src="{{$usuario->photo=='default.png'?'archivos/\\default.png':'archivos/'.$usuario->type.'/'.$usuario->id.'/'.$usuario->photo}}" class="img-circle" style="width:120px;height: 120px;"/>


                        </div>
                        <div class=" col-xs-9 col-sm-9 col-lg-9">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre:</label>

                                <div class="col-md-6">

                                    <input type="hidden" name="type" value="{{$usuario->type}}"/>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $usuario->name }}" >


                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Correo electronico:</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $usuario->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>