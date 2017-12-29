@if (!empty($listaano))
<table class="table">
    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" id="url-listar" value="{{$urllistar}}">
    <input type="hidden" id="url-general" value="{{$urlgeneral}}">

    <thead >

    <tr>
        <th>Codigo</th>
        <th>Numero</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>

    @foreach($listaano as $ano)

        <tr>
            <td>{{$ano->id}}</td>
            <td>{{$ano->numero}}</td>
            <td><input class="btn btn-primary" onclick="mostrarSeccionMenu('A','{{$urllistar}}','{{$ano->id}}')" type="submit" value="Editar"> <input class="btn btn-primary" type="submit" onclick="mostrarSeccionMenu('D','{{$urllistar}}','{{$ano->id}}')" value="Eliminar"></td>

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
{{$listaano->render() }}
