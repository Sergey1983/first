
@extends('layouts.master')

@section ('content')

@if ($errors->any())
        {!! implode('', $errors->all('<div class="container-fluid"><p style="color:red">:message</p></div>')) !!}
@endif

<div class="container-fluid">
	
	@include('layouts.button_print_contract')

</div>

<div class="container-fluid">

{!!$template!!}

</div>






@endsection