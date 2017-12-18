@if (!empty($listafinal))
    @foreach($listafinal as $objetofinal)
        @if (!empty($objetofinal))
           <option value="{{$objetofinal->id}}">{{$objetofinal->nombre}}</option>
        @endif
    @endforeach
@else
 <option value="{{$objetofinal->id}}">{{$objetofinal->nombre}}</option>
@endif
