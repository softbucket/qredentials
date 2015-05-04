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
				"current_route_label" => ""];
			$breadcrumbs_links = ["breadcrumb_routes" => 
				["home" => "Home"],
				"current_route_label" => "Home"];
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
			<h1>Home</h1>
		</div>
	</div>
@endsection
