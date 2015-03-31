@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
            {!! Notification::showAll() !!}
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			{!! Form::open() !!}
				<h3>Controller</h3>
				<div class="form-group">
					<label for="controllerHost">服务器地址</label>
					<input value="<?php if (is_array($config) && count($config) > 0 && isset($config['controllerHost'])) echo $config['controllerHost']; ?>" type="text" class="form-control" id="controllerHost" name="controllerHost" placeholder="https://127.0.0.1:8443">
				</div>
				<div class="form-group">
					<label for="controllerUsername">用户名</label>
					<input value="<?php if (is_array($config) && count($config) > 0 && isset($config['controllerUsername'])) echo $config['controllerUsername']; ?>" type="text" class="form-control" id="controllerUsername" name="controllerUsername" placeholder="ubnt">
				</div>
				<div class="form-group">
					<label for="controllerPassword">密码</label>
					<input value="<?php if (is_array($config) && count($config) > 0 && isset($config['controllerPassword'])) echo $config['controllerPassword']; ?>" type="text" class="form-control" id="controllerPassword" name="controllerPassword" placeholder="">
				</div>
				<div class="form-group">
					<label for="controllerVersion">版本</label>
					@if (is_array($config) && count($config) > 0) 
						{!! Form::select('controllerVersion', array('3.2.1'=>'3.2.1', '3.2.5'=>'3.2.5', '3.2.7'=>'3.2.7', '3.2.10'=>'3.2.10', '4.6.0'=>'4.6.0'), $config['controllerVersion'], array('class'=>'form-control')) !!}
					@else
						{!! Form::select('controllerVersion', array('3.2.1'=>'3.2.1', '3.2.5'=>'3.2.5', '3.2.7'=>'3.2.7', '3.2.10'=>'3.2.10', '4.6.0'=>'4.6.0'), '', array('class'=>'form-control')) !!}
					@endif
				</div>
				<button type="submit" class="btn btn-default">提交</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection