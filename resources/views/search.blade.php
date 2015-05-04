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
				"current_route_label" => ""];
		}
		else
		{
			$context_links = ["context_routes" => 
				[],
				"current_route_label" => ""];
			$breadcrumbs_links = ["breadcrumb_routes" => 
				["home" => "Home"],
				"current_route_label" => ""];
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
			<h1>Search results for: {{ $search_term }}</h1>
			<?php $routeCollection = Route::getRoutes(); $counter=0; ?>

				@foreach ($routeCollection as $value)
					<?php $good_name = strpos($value->getName(), ".") === false && strlen($value->getName()) > 1 && strpos($value->getName(), "logout") === false;
					$good_type = strpos(implode($value->methods(),","), "GET") !== false; ?>
					@if ($good_name && $good_type)
						<?php $counter++; ?>
						<p id="search{{$value->getUri()}}">
						<a href='{{ URL::route('/') }}/{{ $value->getUri() }}'>{{ $value->getUri() }}</a>
						<script>
							var url = '{{ URL::route('/') }}/{{ $value->getUri() }}';
							$("#search{{$value->getUri()}}").hide();
							$.get(url).success(function (evt) {
								var search_term = '{{$search_term}}';
								search_counter--;
								if (search_counter == 0)
									$("#searching").hide();

								if (evt.toLowerCase().indexOf(search_term.toLowerCase()) > 0)
								{
									$("#search{{$value->getUri()}}").show();
								}
							})
							.fail(function (evt) {
								search_counter--;
								if (search_counter == 0)
									$("#searching").hide();
							});
						</script>
						</p>
					@endif
				@endforeach
				<p style="color:red" id="searching">Searching...</p>
			<script>
				search_counter = {{ $counter }};
			</script>
		</div>
	</div>
@endsection
