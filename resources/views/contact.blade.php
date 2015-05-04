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
				"current_route_label" => "Contact"];
			$breadcrumbs_links = ["breadcrumb_routes" => 
				["home" => "Home", "contact" => "Contact"],
				"current_route_label" => "Contact"];
		}
		else
		{
			$context_links = ["context_routes" => 
				[],
				"current_route_label" => ""];
			$breadcrumbs_links = ["breadcrumb_routes" => 
				["home" => "Home", "contact" => "Contact"],
				"current_route_label" => "Contact"];
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
			<h1>Contact us</h1>
				<p>{{ $response }}</p>
					<form class="form-horizontal" role="form" method="POST" action="{{ route('contact') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Feedback:</label>
							<div class="col-md-6">
								<textarea name="feedback" cols="40" rows="10" ></textarea>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</form>
		</div>
	</div>
@endsection
