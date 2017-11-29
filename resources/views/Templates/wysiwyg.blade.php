<div class="container-fluid">
	
	<div id='wysiwig'>
	</div>

	<div class="row">

		<div class="col-md-8">	
			<button id = 'store_draft' class="btn btn-default">Сохранить черновик</button>
			<button id = 'store' class="btn btn-success">Сохранить шаблон</button>
		</div>
		<div class="col-md-4 text-right">	
			<button class="btn btn-info" data-toggle="modal" data-target="#myModal">Словарь</button>
		</div>	

	</div>

</div>

@include('Templates.dictionary')

<input hidden name='doc_type' value={{$doc_type}}>
<input hidden name='tour_type' value={{$tour_type}}>




