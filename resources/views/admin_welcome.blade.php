@extends('layouts.master')

@section('content')

<div class="container-fluid margin-top-25">


  <div class="list-group">

    <a href="{{route('accounting.index')}}" class="list-group-item">Бухгалтерия</a>
    <a href="{{route('statistics.index')}}" class="list-group-item">Статистика</a>    
    <a href="{{route('tourist_payments.index')}}" class="list-group-item">Оплаты туристов</a> 


  </div>

  <div class="list-group">
    
    <a href="admin/user/all" class="list-group-item">Менеджеры</a>
    <a href="admin/templates" class="list-group-item">Шаблоны документов</a>
    <a href="{{route('airports.index')}}" class="list-group-item">Аэропорты</a>
    <a href="{{route('operators.index')}}" class="list-group-item">Туроператоры</a>
    <a href="{{route('branches.index')}}" class="list-group-item">Филиалы</a>
    <a href="{{route('pay_methods.index')}}" class="list-group-item">Методы оплаты</a>

  </div>


</div>

@endsection