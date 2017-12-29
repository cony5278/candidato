@if (!empty($listames))
    @foreach($listames as $mes)
        @if (!empty($mes))
           <option value="{{$mes->id}}">{{$mes->nombre}}</option>
        @endif
    @endforeach
@else
 <option value="{{$mes->id}}">{{$mes->nombre}}</option>
@endif
