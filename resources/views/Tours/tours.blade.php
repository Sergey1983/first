@extends('layouts.master')

@section('content')

<table>
	
<tr>
	<td>@include('layouts.tours_create_button')</td>
	<td>@include('layouts.tours_sort_date')</td>
	<td>@include('layouts.tours_sort_name')</td>





</tr>

</table>



	


	<br><br>


	@include('layouts.tours_table')



@endsection