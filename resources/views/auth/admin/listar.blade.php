
<button type="submit" onclick="mostrarseccion('I','')" class="btn btn-primary">
    Nuevo
</button>

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
{{$usuarioAdmin->render() }}