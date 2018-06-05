@if ($errors->any())

<div class = "col-md-12 margin-top-10">
	
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

</div>

@endif