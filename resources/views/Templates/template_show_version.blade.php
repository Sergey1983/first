
@extends('layouts.master')

@section ('content')

<div class="col-md-12">
  <div class="list-group col-md-4">
    <a href="#" class="list-group-item">Продукт: {{$template->tour_type}}</a>
    <a href="#" class="list-group-item">Тип документа: {{$template->doc_type}}</a>
    <a href="#" class="list-group-item">Создан: {{$template->created_at}}</a>
  </div>
</div>

<div class="container-fluid">

{!!$template->template_text!!}


</div>


@endsection