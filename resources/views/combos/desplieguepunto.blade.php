@if (!empty($listapunto))
    @foreach($listapunto as $punto)
        @if (!empty($punto))
           <option value="{{$punto->id}}">{{$punto->direccion}}</option>
        @endif
    @endforeach
@else
 <option value="{{$punto->id}}">{{$punto->direccion}}</option>
@endif
