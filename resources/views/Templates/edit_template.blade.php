@extends('layouts.master')

@section('content')

<div class="row text-center">

	<h3>{{$doc_type}} {{$tour_type}} тур шаблон</h3>

</div>

@include('Templates.wysiwyg', ['doc_type' => $doc_type, 'tour_type' => $tour_type])

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

<script type="text/javascript"> 
	var url_admin_templates = "{{ URL::asset('admin/templates/') }}"; 
	var url_gethtml = "{{URL::asset('admin/templates/gethtml')}}";
</script>
<script type="text/javascript" src="{{ URL::asset('js/templates/summernote.js') }}"></script>

@endsection