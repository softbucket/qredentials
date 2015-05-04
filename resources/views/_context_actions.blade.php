
<link href="{{ asset('/css/context_menu.css') }}" rel="stylesheet">
<div id="context_side_menu">

@foreach ($context_routes as $route => $route_label)
	<p {{ $route_label === $current_route_label ? "class=current_route" : "class=regular_route" }}>{!! HTML::linkRoute($route, $route_label) !!}</p>
@endforeach

</div>
<div id="context_side_menu_background"></div>