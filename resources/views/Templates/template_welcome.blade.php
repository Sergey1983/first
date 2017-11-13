@extends('layouts.master')

@section('content')


<div class="container-fluid">

<a href="templates/create" role="button" class="btn btn-info">Создать шаблон договора</a>
<a href="templates/edit" role="button" class="btn btn-info">Редактировать шаблон договора</a>


<h2>Текущие версии шаблонов</h2>
  <div class="list-group">
    <a href="#" class="list-group-item">Шаблон пакетного тура</a>
    <a href="#" class="list-group-item">Шаблон отельного тура</a>
    <a href="#" class="list-group-item">Шаблон авиабилета</a>
  </div>


</div>

@endsection