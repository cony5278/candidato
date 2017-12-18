@if (!empty($listamesa))
    @foreach($listamesa as $mesa)
        @if (!empty($mesa))
           <option value="{{$mesa->id}}">{{$mesa->numero}}</option>
        @endif
    @endforeach
@else
 <option value="{{$mesa->id}}">{{$mesa->numero}}</option>
@endif
