	<a id='payment_operator_button' class = 'btn btn-success' 

	href = "{{route('payment_operator.create', ['tour'=>$tour->id])}}"
{{-- 	href="/tours_2/{{$tour->id}}/pay_operator" --}}

	>
			Внести оплату оператору
	</a>