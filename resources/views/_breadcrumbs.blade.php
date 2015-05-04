
<link href="{{ asset('/css/breadcrumbs.css') }}" rel="stylesheet">
<div class="breadcrumb">
<p>
<?php $first=true; ?>
@foreach ($breadcrumb_routes as $route => $route_label)
	@if ($first)
		<?php $first=false; ?>
	@else
		>
	@endif
	<?php $route_class=""; if ($current_route_label === $route_label) $route_class = "breadcrumb_bold"; ?>
	{!! HTML::linkRoute($route, $route_label, array(), array('class' => $route_class)) !!}
	
@endforeach
</p>
</div>
	