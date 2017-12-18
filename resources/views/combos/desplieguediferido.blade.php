@if (!empty($listausuario))
    @foreach($listausuario as $referido)
        @if (!empty($referido))
           <option value="{{$referido->id}}">{{(empty($referido->name2)?$referido->name:$referido->name.' '.$referido->name2).' '.(empty($referido->lastname)?$referido->lastname2:$referido->lastname.' '.$referido->lastname2)}}</option>
        @endif
    @endforeach
@else
<option value="{{$referido->id}}">{{(empty($referido->name2)?$referido->name:$referido->name.' '.$referido->name2).' '.(empty($referido->lastname)?$referido->lastname2:$referido->lastname.' '.$referido->lastname2)}}</option>

@endif
