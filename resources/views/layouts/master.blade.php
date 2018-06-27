<!DOCTYPE html>
<html lang='ru' >
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link rel="stylesheet" type="text/css" href="/css/app.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="{{ URL::asset('js/ajax_setup.js') }}"></script>


    @if(Session::has('download.in.the.next.request'))
         <meta http-equiv="refresh" content="0;url={{ Session::get('download.in.the.next.request') }}">
    @endif
    
</head>
<body>




@if (Auth::check())

<div class="container-fluid white background-black letter-spacing-035">
	
	@php
			$user = Auth::user();

	@endphp	
	
	<div class="col-md-3 text-left  margin-top-10 margin-bottom-10">
		
		ВИСТА-ТУР ОРЕНБУРГ, {{Illuminate\Support\Str::upper($user->branch->name)}} 

	</div>

	<div class="col-md-2 col-md-offset-6 margin-top-10 margin-bottom-10 text-right">
		
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
		@php	
		
			$user = $user->last_name.' '.substr($user->name, 0, 2).'.'.substr($user->patronymic, 0, 2);

		@endphp

		{{ $user }} 

	</div>


	<div class="col-md-1 text-right margin-top-10 margin-bottom-10">


		<a href="/logout">
			<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
			ВЫХОД
		
		</a>
		
	</div>
</div>



<div class = 'container-fluid margin-bottom-10 background-blue letter-spacing-035'>
	
	<nav class="navbar navbar-default background-transparent border-color-transparent no-border no-margin-bottom">

		<div class="container-fluid">
			

			{!! Breadcrumbs::renderIfExists() !!}

			@if (Route::current()->getName() == 'home')

				<ul class="nav navbar-nav">

                    <li>

                        <a class="color-white" href="{{route('tour.create', ['tour_type'=> 'packet_tour'])}}">

                        	Создать Пакетный Тур
                        </a>

                    </li>
                
            
					<li>

                        <a  class="color-white" href="{{route('tour.create', ['tour_type'=> 'hotel'])}}">

							Создать Отельный Тур

                        </a>

                    </li>

					<li>

                        <a  class="color-white" href="{{route('tour.create', ['tour_type'=> 'avia'])}}">
								
								Создать Авиа Тур
							
                        </a>

                    </li>


	           </ul>

		        @if (auth()->user()->id == 1)

					<ul class="nav navbar-nav navbar-right">

						<li>

	                        <a  class="color-white" href="{{route('admin.start')}}">
									
									Панель Админа
								
	                        </a>

	                    </li>

					</ul>

				@endif
	                    
			@endif
	           
	    </nav>


		</div>

</div>



<div class = 'container-fluid letter-spacing-035 heading-div'>

	<h4>


{{$headings[Route::current()->getName()]}} 



@isset($doc_type_rus) 
	{{ Illuminate\Support\Str::lower($doc_type_rus) }}
@endisset

@isset($tour_type_rus) 
	{{Illuminate\Support\Str::lower($tour_type_rus)}} тур
@endisset


	</h4>



</div>



@endif

@yield('content')


@if (Route::current()->getName() == 'home')

<div align = "center">

	<img src="{{ URL::asset('island.jpg') }}" width="400" height="216"></img>
	<p style="margin-top:5px">"Поиграли и хватит! Поехали домой, ребята, в Исландию!"</p>


</div>

@endif

</body>
</html>