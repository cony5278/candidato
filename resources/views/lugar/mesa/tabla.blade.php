@if (!empty($listadesplieguemesa))
<table class="table">
    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="url-listar" value="{{$urllistar}}">
    <input type="hidden" id="url-general" value="{{$urlgeneral}}">

    <thead >

    <tr>
        <th>Código</th>
        <th>Número</th>
        <th>Dirección</th>
        <th>Ciudad</th>
        <th>Departamento</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>

    @foreach($listadesplieguemesa as $mesa)

        <tr>
            <td>{{$mesa->id}}</td>
            <td>{{$mesa->numero}}</td>
            <td>{{$mesa->direccion}}</td>
            <td>{{$mesa->ciudad}}</td>
            <td>{{$mesa->departamento}}</td>
            <td>{{$mesa->name.' '.$mesa->name2.' '.$mesa->lastname.' '.$mesa->lastname2}}</td>
            <td><input class="btn btn-primary" onclick="mostrarSeccionMenu('A','{{$urllistar}}','{{$mesa->id}}')" type="submit" value="Editar"> <input class="btn btn-primary" type="submit" onclick="mostrarSeccionMenu('D','{{$urllistar}}','{{$mesa->id}}')" value="Eliminar"></td>

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
        Registre una Mesa de votación
    </div>
@endif
{{$listadesplieguemesa->render() }}
