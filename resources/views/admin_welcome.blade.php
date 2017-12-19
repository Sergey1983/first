@extends('layouts.master')

@section('content')

<div class="container-fluid margin-top-25">

  <div class="list-group">
    <a href="admin/user/all" class="list-group-item">Менеджеры</a>
    <a href="admin/templates" class="list-group-item">Шаблоны документов</a>
    <a href="{{route('airports.index')}}" class="list-group-item">Аэропорты</a>
    <a href="{{route('operators.index')}}" class="list-group-item">Туроператоры</a>
    <a href="{{route('branches.index')}}" class="list-group-item">Филиалы</a>

  </div>


</div>

@endsection