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
			<div class="form-group">
				<label for="authType">授权类型 </label>
				{!! Form::select(
						'controllerVersion', 
						array(
							'/site/detail/'.$site_id.'/nopassword'=>'无需密码', 
							'/site/detail/'.$site_id.'/password'=>'密码', 
							'/site/detail/'.$site_id.'/sms'=>'短信'), 
							'/site/detail/'.$site_id.'/'.$auth_type, 
							array('onchange'=>'window.location=this.value'
							)
						) 
				!!}
			</div>
			{!! Form::open() !!}
				<div class="form-group">
					<label for="authTime">授权时间(秒)</label>
					<input value="<?php if (is_array($config) && count($config) > 0) echo $config['authTime']; ?>" type="text" class="form-control" id="authTime" name="authTime" placeholder="3000">
				</div>
				<div class="form-group">
					<label for="redirectUrl">跳转页面</label>
					<input value="<?php if (is_array($config) && count($config) > 0) echo $config['redirectUrl']; ?>" type="text" class="form-control" id="redirectUrl" name="redirectUrl" placeholder="www.baidu.com">
				</div>
				<div class="form-group">
					<label for="waitTime">广告等待时间(秒)</label>
					<input value="<?php if (is_array($config) && count($config) > 0) echo $config['waitTime']; ?>" type="text" class="form-control" id="waitTime" name="waitTime" placeholder="5">
				</div>
				<div class="form-group">
					<label for="waitPic">广告图片</label>
					<input value="<?php if (is_array($config) && count($config) > 0) echo $config['waitPic']; ?>" type="file" class="" id="waitPic" name="waitPic" placeholder="www.baidu.com">
				</div>
				@include('site.authType.'.$auth_type)
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<button type="submit" class="btn btn-default">提交</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection