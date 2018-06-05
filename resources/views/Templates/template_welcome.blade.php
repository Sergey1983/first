@extends('layouts.master')

@section('content')


<div class="container-fluid margin-top-25">




{{-- <h2>Текущие версии шаблонов</h2>
 --}}  <div class="list-group">
    <a href="{{URL::asset('admin/templates/packet_tour/')}}" class="list-group-item">Шаблон пакетного тура</a>
    <a href="{{URL::asset('admin/templates/hotel/')}}" class="list-group-item">Шаблон отельного тура</a>
    <a href="{{URL::asset('admin/templates/avia/')}}" class="list-group-item">Шаблон авиабилета</a>
  </div>


</div>

@endsection