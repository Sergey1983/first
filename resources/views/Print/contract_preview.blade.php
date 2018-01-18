
@extends('layouts.master')

@section ('content')

@if ($errors->any())
        {!! implode('', $errors->all('<div class="container-fluid"><p style="color:red">:message</p></div>')) !!}
@endif

<div class="container-fluid margin-top-25">
	
	<a id='button_print_contract' class = 'btn btn-primary'	href = "{{route('contract.print', ['tour' => $tour->id, 'doc_type' => $doc_type])}}">
		Печатать {{$doc_type_rus}}

	</a>

</div>

<div class="container-fluid">

{!!$template!!}

</div>






@endsection