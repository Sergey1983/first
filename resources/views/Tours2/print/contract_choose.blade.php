@extends('layouts.master')

@section ('content')


<div class="container-fluid">
	
<a href="/tours_2/print_contract/{{$id}}/contract" role="button" class="btn btn-primary active">Печатать договор</a>
<a href="#" role="button" class="btn btn-primary disabled">Печатать допсоглашение</a>

</div>

@endsection