
<button type="submit" onclick="mostrarSeccionMenu('I','{{$urllistar.'/'.'create'}}','')" class="btn btn-primary">
    Nuevo
</button>
@if (!empty($listapuntovotacion))
<table class="table">
    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="url-listar" value="{{$urllistar}}">
    <input type="hidden" id="url-general" value="{{$urlgeneral}}">

    <thead >

    <tr>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>

    @foreach($listapuntovotacion as $punto)

        <tr>
            <td>{{$punto->id}}</td>
            <td>{{$punto->nombre}}</td>
            <td>{{$punto->direccion}}</td>
            <td><input class="btn btn-primary" onclick="mostrarSeccionMenu('A','{{$urllistar}}','{{$punto->id}}')" type="submit" value="Editar"> <input class="btn btn-primary" type="submit" onclick="mostrarSeccionMenu('D','{{$urllistar}}','{{$punto->id}}')" value="Eliminar"></td>

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
        Registre un Punto de Votación
    </div>
@endif
{{$listapuntovotacion->renderGeneral() }}