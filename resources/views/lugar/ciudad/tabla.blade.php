@if (!empty($listaciudades))
<table class="table">
    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="url-listar" value="{{$urllistar}}">
    <input type="hidden" id="url-general" value="{{$urlgeneral}}">

    <thead >

    <tr>
        <th>Código</th>
        <th>Ciudad</th>
        <th>Departamento</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>

    @foreach($listaciudades as $ciudad)

        <tr>
            <td>{{$ciudad->id}}</td>
            <td>{{$ciudad->ciudad}}</td>
            <td>{{$ciudad->departamento}}</td>
            <td><input class="btn btn-primary" onclick="mostrarSeccionMenu('A','{{$urllistar}}','{{$ciudad->id}}')" type="submit" value="Editar"> <input class="btn btn-primary" type="submit" onclick="mostrarSeccionMenu('D','{{$urllistar}}','{{$ciudad->id}}')" value="Eliminar"></td>

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
        Registre una Ciudad
    </div>
@endif
{{$listaciudades->render()}}
