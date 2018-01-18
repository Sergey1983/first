	<a id='payment_tourist_button' class = 'btn btn-success'

	href = "{{route('payment_tourist.create', ['tour'=>$tour->id])}}"
{{-- 	 href="/tours_2/{{$tour->id}}/pay_tourist" --}}

	 >
			Внести оплату от туриста
	</a>