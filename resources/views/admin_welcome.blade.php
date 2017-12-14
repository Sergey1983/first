@extends('layouts.master')

@section('content')

<div class="container-fluid margin-top-25">

  <div class="list-group">
    <a href="admin/user/all" class="list-group-item">Список менеджеров</a>
    <a href="admin/templates" class="list-group-item">Список шаблонов документов</a>
    <a href="{{route('airports.index')}}" class="list-group-item">Список аэропортов</a>
    <a href="{{route('operators.index')}}" class="list-group-item">Список туроператоров</a>
  </div>


</div>

@endsection