@if (!empty($listaano))
    @foreach($listaano as $ano)
        @if (!empty($ano))
           <option value="{{$ano->id}}">{{$ano->numero}}</option>
        @endif
    @endforeach
@else
 <option value="{{$ano->id}}">{{$ano->numero}}</option>
@endif
