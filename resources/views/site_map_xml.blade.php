<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"> 
<?php $routeCollection = Route::getRoutes(); ?>

	@foreach ($routeCollection as $value)
		<?php $good_name = strpos($value->getName(), ".") === false && strlen($value->getName()) > 1 && strpos($value->getName(), "logout") === false && strpos($value->getName(), "quick_scan_unique_key") === false;
		$good_type = strpos(implode($value->methods(),","), "GET") !== false; ?>
		@if ($good_name && $good_type)
		<url>
			<loc>{{ URL::route('/') }}/{{ $value->getUri() }}</loc>
		</url>
		@endif
	@endforeach
</urlset>