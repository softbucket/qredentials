@extends('qr_code_app')

@section('content')

	<?php
		$context_links = null;
		$breadcrumbs_links = null;
		if (Auth::check()) //logged in
		{
			$context_links = ["context_routes" => 
				["about" => "About", 
				"contact" => "Contact"],
				"current_route_label" => "About"];
			$breadcrumbs_links = ["breadcrumb_routes" => 
				["home" => "Home", "about" => "About"],
				"current_route_label" => "About"];
			}
		else
		{
			$context_links = ["context_routes" => 
				[],
				"current_route_label" => ""];
			$breadcrumbs_links = ["breadcrumb_routes" => 
				["home" => "Home", "about" => "About"],
				"current_route_label" => "About"];
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
			<h1>About</h1>
			<p>A QR company that cares about your privacy and convenience.</p>
		</div>
	</div>
@endsection
