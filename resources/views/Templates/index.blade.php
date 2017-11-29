	<div class="row col-md-12 text-center">
		<a href="{{URL::asset('admin/templates/'.$tour_type.'/contract/edit')}}" role="button" class="btn btn-info">Шаблон ДОГОВОРА: создать/редактировать</a>
		<a href="{{URL::asset('admin/templates/'.$tour_type.'/agreement/edit')}}" role="button" class="btn btn-info">Шаблон ДОПСОГЛАШЕНИЯ: создать/редактировать</a>
	</div>	

<div class="row col-md-12">

	<table class="table table-responsive">

		<thead>
		
			<tr> 
				<td><strong>Дата создания/изменения</strong></td>
				<td><strong>Id-шаблона</strong></td>
				<td><strong>Тип документа</strong></td>
				<td><strong>Тип тура</strong></td>
				<td><strong>Посмотреть</strong></td>
			</tr>
		
		</thead>
		
		<tbody>

			@if(isset($doc_templates)) 



				@foreach($doc_templates as $template)
				<tr>
					<td>{{$template->created_at}}</td>
					<td>{{$template->id}}</td>
					<td>{{$template->doc_type}}</td>
					<td>{{$template->tour_type}}</td>
					<td><a class="btn btn-sm btn-info" href={{URL::asset('admin/templates/view/'.$template->id.'')}}>Посмотреть</a></td>
				</tr>

				@endforeach

			@endif
		</tbody>

	</table>

</div>	