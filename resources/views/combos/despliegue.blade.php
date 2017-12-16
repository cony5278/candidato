@if (!empty($lista))
    @foreach($lista as $objeto)
        @if (!empty($objeto))
           <option value="{{$objeto->id}}">{{$objeto->nombre}}</option>
        @endif
    @endforeach
@else
 <option value="{{$objeto->id}}">{{$objeto->nombre}}</option>
@endif
