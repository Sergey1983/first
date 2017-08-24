@extends('layouts.master')

@section('content')


<h2>Создать пользователя:</h2>


{!! Form::open(['id'=>'register_user', 'class'=>'inline', 'method'=>'post'])!!}

{!! Form::text('name', null, ['Placeholder'=>'имя девачки']) !!}
<br><br>


{!! Form::text('email', null, ['Placeholder'=>'email']) !!}
<br><br>

{!! Form::password('password', ['Placeholder'=>'password']) !!}
<br><br>

{!! Form::password('password_confirmation', ['Placeholder'=>'password confirmation']) !!}
<br><br>

{!! Form::submit('Создать!') !!}

{!! Form::close() !!}


@include('layouts.errors')

@endsection
