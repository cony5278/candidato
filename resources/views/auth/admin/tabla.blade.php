@if (!empty($listarusuario))
<table class="table">
  <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" id="url-listar" value="{{$urllistar}}">
  <input type="hidden" id="url-general" value="{{$urlgeneral}}">


    <thead >

    <tr>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>

    @foreach($listarusuario as $usuario)

        <tr>
            <td>{{$usuario->id}}</td>
            <td>{{$usuario->name}}</td>
            <td>{{$usuario->email}}</td>
            <td><input class="btn btn-primary" onclick="mostrarSeccionMenu('A','{{$urllistar}}','{{$usuario->id}}')" type="submit" value="Editar"> <input class="btn btn-primary" type="submit" onclick="eliminarDatos('1',{{$usuario->id}})" value="Eliminar"></td>

        </tr>

    @endforeach
    </tbody>
</table>
@else
    <div  style="
                font-size: 84px;  margin-bottom: 30px;   text-align: center;
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
    ">
        Registre una Persona
    </div>
@endif
{{$listarusuario->render() }}
