<div class="container">
	@if(count($errors->all()) > 0)
	<div class="alert alert-danger">
		<ol>
			@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ol>
	</div>
	@endif
	@if(session()->has('error'))
	<div class="alert alert-danger">
		<button class="close" data-close="alert"></button>
		<span> {{ session('error') }} </span>
	</div>
	@endif
	@if(session()->has('success'))
	<div class="alert alert-success">
		<button class="close" data-close="alert"></button>
		@if(session()->has('success'))
		<span> {{ session('success') }} </span>
		@endif
	</div>
	@endif
	@if (session('status'))
	<div class="alert alert-success" role="alert">
		{{ session('status') }}
	</div>
	@endif
</div>
<div class="container-fluid">
