@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
		</div>
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Sites 设置</div>

				<div class="panel-body">
					<ul>
						@foreach ($sites as $site)
						@if (isset($site['desc']))
						<li><a href="{{ url('/site/detail') }}/{{$site['name']}}">{{ $site['desc'] }}</a></li>
						@endif
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection