
@extends('layouts.master')

@section ('content')

<div class="col-md-12 margin-top-25">
  <div class="list-group col-md-4">
    <a href="#" class="list-group-item">Продукт: <strong>{{$template->tour_type}}</strong></a>
    <a href="#" class="list-group-item">Тип документа: <strong>{{$template->doc_type}}</strong></a>
    <a href="#" class="list-group-item">Создан: <strong>{{$template->created_at}}</strong></a>
  </div>
</div>

<div class="container-fluid">

{!!$template->template_text!!}


</div>


@endsection