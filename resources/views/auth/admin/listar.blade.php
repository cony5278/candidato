
<button type="submit" onclick="mostrarseccion('.{{Auth::user()->type=='A'?'I':'II'}}.','')" class="btn btn-primary">
    Nuevo
</button>
@if (!$usuarioAdmin->isEmpty())
<table class="table">
    <input type="hidden" id="usuario-token" name="_token" value="{{ csrf_token() }}">
    <thead >

    <tr>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>

    @foreach($usuarioAdmin as $usuario)

        <tr>
            <td>{{$usuario->id}}</td>
            <td>{{$usuario->name}}</td>
            <td>{{$usuario->email}}</td>
            <td><input class="btn btn-primary" onclick="mostrarseccion('A',{{$usuario->id}})" type="submit" value="Editar"> <input class="btn btn-primary" type="submit" onclick="eliminarDatos('1',{{$usuario->id}})" value="Eliminar"></td>

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
{{$usuarioAdmin->render() }}