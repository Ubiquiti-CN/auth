@extends('client/global/app')
@section('content')
	
<style>
	.adImgContainer{
		text-align: center;
	}
	.adImg {
		width: 100%;
		max-width: 500px;
	}
</style>

<script>
	function link() {
		var timeContiner = document.getElementById('timeContiner');
		var time = {{ $site_config['waitTime'] }};
		setInterval(function() {
			time --;
			if (time == 0) {
				window.location.href = '{{ $site_config['redirectUrl'] }}';
			}
			timeContiner.innerHTML = time + '秒后连接网络';
		}, 1000);
	}
</script>

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 adImgContainer">
			<p id="timeContiner">{{ $site_config['waitTime'] }}秒后连接网络</p>
			<img class="adImg"  src="/images/sites/{{ $site_config['waitPic'] }}" onload="link()">
		</div>
	</div>
</div>
	
@endsection

