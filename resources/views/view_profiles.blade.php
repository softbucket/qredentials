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
				"current_route_label" => "View Profiles"];
			$breadcrumbs_links = ["breadcrumb_routes" => 
				["home" => "Home", "view_profiles" => "View Profiles"],
				"current_route_label" => "View Profiles"];
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
			<h1>Profiles</h1>
			{!! HTML::script('js/get_info_sessions.js') !!}
			<?php $counter = 1; ?>
			@foreach($data as $key => $value)
				<p id="profile{{$value->id}}" db_id="{{$value->id}}">
					Profile {{$counter}}: <br/>@include('_create_info_session', ["id" => $value->id])
					<br/>Show email: {{$value->show_email ? "True" : "False"}}<br/>Show name: {{$value->show_name ? "True" : "False"}} 
				</p>
				<br/>
				<?php $counter++; ?>
			@endforeach

		</div>
	</div>
@endsection
