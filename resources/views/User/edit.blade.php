
@extends('layouts.master')

@section('content')


		<h2>Редактировать менеджера</h2>

{!! Form::open(['id'=>'register_user', 'class'=>'inline', 'route'=>array('user.update', $user->id)])!!}

{!! Form::text('name', $user->name, ['Placeholder'=>'имя девачки']) !!}
<br><br>


{!! Form::text('email', $user->email, ['Placeholder'=>'email', 'readonly'=>'readonly']) !!}
<br><br>

{!! Form::password('password', ['Placeholder'=>'password']) !!}
<br><br>

{!! Form::password('password_confirmation', ['Placeholder'=>'password confirmation']) !!}
<br><br>

{!! Form::submit('Обновить!') !!}

{!! Form::close() !!}
<br><br>

<h2>Может видеть все заявки?</h2>
{!! Form::open(['id'=>'permission_user', 'class'=>'inline', 'route'=>array('user.update_permission', $user->id)])!!}

{!! Form::select('permission', ['0' => 'Нет', '1' => 'Да'], $user->permission,

$user->id == '1' ? ['disabled' => 'true'] : [] 

) !!}

{!! Form::submit('Изменить права') !!}


{!! Form::close() !!}

<br><br>

<h2>Может, удалить?</h2>

{!! Form::open(['id'=>'delete_user', 'class'=>'inline', 'route'=>array('user.destroy', $user->id)])!!}

{!! Form::submit('Удалить?') !!}

{!! Form::close() !!}


@include('layouts.errors')

@endsection


