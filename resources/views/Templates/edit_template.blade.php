@extends('layouts.master')

@section('content')

{{-- <div class="row text-center">

	<h3>{{$doc_type}} {{$tour_type}} тур шаблон</h3>

</div> --}}

<div class="containter-fluid margin-top-25">

@include('Templates.wysiwyg', ['doc_type' => $doc_type_rus, 'tour_type' => $tour_type_rus])

</div>

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

<script type="text/javascript"> 
	var url_admin_templates = "{{ URL::asset('admin/templates/') }}"; 
	var url_gethtml = "{{URL::asset('admin/templates/gethtml')}}";
</script>
<script type="text/javascript" src="{{ URL::asset('js/templates/summernote.js') }}"></script>

@endsection