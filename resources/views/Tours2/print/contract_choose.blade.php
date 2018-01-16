@extends('layouts.master')

@section ('content')





<div class="container-fluid text-center margin-top-25">
	
<a
	href = "{{route( 'contract.show', ['tour' => $tour->id, 'doc_type'=> 'contract'])}}"

 {{-- href="/tours_2/print_contract/{{$tour->id}}/contract" role="button"  --}}

 class="btn btn-primary active" style="text-decoration: none">Печатать ДОГОВОР</a>

@unless($tour->contracts->count() == 0)

<a 
	href = "{{route( 'contract.show', ['tour' => $tour->id, 'doc_type'=> 'agreement'])}}"

{{-- href="/tours_2/print_contract/{{$tour->id}}/agreement" role="button"  --}}

class="btn btn-primary active" style="text-decoration: none">Печатать ДОПСОГЛАШЕНИЕ</a>

@endunless

</div>

@endsection