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
			{!! Form::open() !!}
				<h3>数据库</h3>
				<div class="form-group">
					<label for="dbHost">服务器地址</label>
					<input value="<?php if (is_array($config) && count($config) > 0) echo $config['dbHost']; ?>" type="text" class="form-control" id="dbHost" name="dbHost" placeholder="127.0.0.1">
				</div>
				<div class="form-group">
					<label for="dbPort">端口</label>
					<input value="<?php if (is_array($config) && count($config) > 0) echo $config['dbPort']; ?>" type="text" class="form-control" id="dbPort" name="dbPort" placeholder="3306">
				</div>
				<div class="form-group">
					<label for="dbUsername">用户名</label>
					<input value="<?php if (is_array($config) && count($config) > 0) echo $config['dbUsername']; ?>" type="text" class="form-control" id="dbUsername" name="dbUsername" placeholder="root">
				</div>
				<div class="form-group">
					<label for="dbPassword">密码</label>
					<input value="<?php if (is_array($config) && count($config) > 0) echo $config['dbPassword']; ?>" type="text" class="form-control" id="dbPassword" name="dbPassword" placeholder="">
				</div>
				<h3>Controller</h3>
				<div class="form-group">
					<label for="controllerHost">服务器地址</label>
					<input value="<?php if (is_array($config) && count($config) > 0) echo $config['controllerHost']; ?>" type="text" class="form-control" id="controllerHost" name="controllerHost" placeholder="https://127.0.0.1:8443">
				</div>
				<div class="form-group">
					<label for="controllerUsername">用户名</label>
					<input value="<?php if (is_array($config) && count($config) > 0) echo $config['controllerUsername']; ?>" type="text" class="form-control" id="controllerUsername" name="controllerUsername" placeholder="ubnt">
				</div>
				<div class="form-group">
					<label for="controllerPassword">密码</label>
					<input value="<?php if (is_array($config) && count($config) > 0) echo $config['controllerPassword']; ?>" type="text" class="form-control" id="controllerPassword" name="controllerPassword" placeholder="">
				</div>
				<div class="form-group">
					<label for="controllerVersion">版本</label>
					@if (is_array($config) && count($config) > 0) 
						{!! Form::select('controllerVersion', array(0=>'3.2.1', 1=>'3.2.5', 2=>'3.2.7', 3=>'3.2.10'), $config['controllerVersion'], array('class'=>'form-control')) !!}
					@else
						{!! Form::select('controllerVersion', array(0=>'3.2.1', 1=>'3.2.5', 2=>'3.2.7', 3=>'3.2.10'), '', array('class'=>'form-control')) !!}
					@endif
				</div>
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<button type="submit" class="btn btn-default">提交</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection