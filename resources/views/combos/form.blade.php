
        <table class="table combo-grande">

            <thead>
            <tr >
                <th>Nombre</th>
            </tr>
            </thead>
            <tbody>

            @foreach($departamentos as $general)
                <tr>
                    <input type="hidden" value="{{$general->id}}"/>
                    <td>{{$general->nombre}}</td>
                </tr>

            @endforeach
            </tbody>
        </table>

        {{$departamentos->render(null,[],true) }}
