@extends('app')
@section('content')

		<style>
			.homeTable {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
			}
			.homeContainer {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
				font-family: 'Lato';
			}

			.homeContent {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 96px;
				margin-bottom: 40px;
			}

			.quote {
				font-size: 24px;
			}
		</style>
		<div class="homeTable">
			<div class="homeContainer">
				<div class="homeContent">
					<div class="title">ubnt</div>
					<div class="quote">{{ Inspiring::quote() }}</div>
				</div>
			</div>
		</div>
@endsection

