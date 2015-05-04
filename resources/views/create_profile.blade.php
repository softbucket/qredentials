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
				"current_route_label" => "Create Profile"];
			$breadcrumbs_links = ["breadcrumb_routes" => 
				["home" => "Home", "create_profile" => "Create Profile"],
				"current_route_label" => "Create Profile"];
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
	
	<div id="qr_code_content">
		<div id="qr_code_contentholder">
			<h1>Create a Profile</h1>
			<link href="{{ asset('/css/content_login.css') }}" rel="stylesheet">
			<div class="panel panel-default">
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ route('submit_profile') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="show_name"> Show Name
								</label>
							</div>
						</div>
						<div class="form-group">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="show_email"> Show Email
								</label>
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary">Create Profile</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
