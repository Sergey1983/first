	<a id='button_print_contract' class = 'btn btn-primary' 

	href = "{{route('contract.print', ['tour' => $tour->id, 'doc_type' => $doc_type])}}"

{{-- 	href="/tours_2/print_contract/{{$tour->id}}/print/{{$doc_type}}" --}}

	>
		Печатать {{$doc_type_rus}}

	</a>