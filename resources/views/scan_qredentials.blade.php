@extends('qr_code_app')

@section('content')

	<?php
		$context_links = null;
		$breadcrumbs_links = null;
		if (Auth::check()) //logged in
		{
			$context_links = ["context_routes" => 
				["create_profile" => "Create Profile", 
				"view_profiles" => "View Profiles",
				"view_qredentials" => "qredentials",
				"scan_qredentials" => "Scan"],
				"current_route_label" => "Scan"];
			$breadcrumbs_links = ["breadcrumb_routes" => 
				["home" => "Home", "scan_qredentials" => "Scan"],
				"current_route_label" => "Scan"];
		}
		else
		{
			$context_links = ["context_routes" => 
				[],
				"current_route_label" => ""];
			$breadcrumbs_links = ["breadcrumb_routes" => 
				["home" => "Home", "create_profile" => "Create Profile"],
				"current_route_label" => "Create Profile"];
		}
	?>
	
	@if(!is_null($context_links))
		@include('_context_actions', $context_links)
	@endif
	@if(!is_null($breadcrumbs_links))
		@include('_breadcrumbs', $breadcrumbs_links)
	@endif
	@include('_qr_code_individual')
	<div id="qr_code_content">
		<div id="qr_code_contentholder">
			<h1>Input a QR code</h1>
			<link href="{{ asset('/css/content_login.css') }}" rel="stylesheet">
			@if (!is_null($error))
				<p>{{$error}}</p>
			@endif
			<div class="panel panel-default">
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ route('submit_unique_key') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<div class="text">
								<label>
									Unique Key: <input type="text" name="unique_key">
								</label>
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary">Scan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
