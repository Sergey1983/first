@extends('layouts.master')

@section ('content')


<div class="container-fluid text-center">
	
<a href="/tours_2/print_contract/{{$tour->id}}/contract" role="button" class="btn btn-primary active" style="text-decoration: none">Печатать ДОГОВОР</a>
<a href="/tours_2/print_contract/{{$tour->id}}/agreement" role="button" class="btn btn-primary active" style="text-decoration: none">Печатать ДОПСОГЛАШЕНИЕ</a>

</div>

@endsection