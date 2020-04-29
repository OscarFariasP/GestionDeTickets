@extends('layouts.app')

@section('content')
<input type="hidden" id="user" value="{{ $id }}">
@csrf
<div id="UserComponent"> 
                         

</div>
@endsection