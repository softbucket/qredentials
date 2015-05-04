<?php
	$nav_links = [];

	if (Auth::check())
	{
		$nav_links = [
			"logout" => "Logout " ,
			"contact" => "Contact" ,
			"about" => "About" ,
			"/" => "Home"
		];
	}
	else
	{
		$nav_links = [
			"login" => "Login" ,
			"contact" => "Contact" ,
			"about" => "About" ,
			"/" => "Home"
		];
	}
	?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="qr code manager website">
	<meta name="keywords" content="qr,qredentials">
	<meta name="author" content="Ed Mak">
	<title>qredentials - {{Route::currentRouteName()}}</title>

	<link href="{{ asset('/css/qr_code_app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/navigation.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/content.css') }}" rel="stylesheet">
	{!! HTML::script('js/jquery.js') !!}
	{!! HTML::script('js/navigation.js') !!}
</head>
<body>
<form>
	<input type="hidden" id="UserInfoSessionsShow" value="{{URL::action('UserInfoSessionsController@show')}}" />
	<input type="hidden" id="UserInfoSessionsCreate" value="{{URL::action('UserInfoSessionsController@create')}}" />
	<input type="hidden" id="UserInfoSessionsDestroy" value="{{ URL::route('UserInfoSessions.destroy', array('id' => '')) }}" />
	<input type="hidden" id="csrf_token" value="{{ csrf_token() }}" />
</form>
<div id="div_front_page">
	<div id="div_title">
	{!! HTML::image('images/qrcode.png', $alt="qrcode", $attributes = array("id" => "qrcodelogo")) !!}
	<p id="qr">qr</p><p id="edentials">edentials</p>
	<p class="login_greeting">{{ Auth::check() ? "Hi, " . Auth::user()->name . "!" : "" }}</p>
	@include('_search_bar')
	</div>
</div>
<div id="div_navigation_container">
	<p id="menulinkspan"><a href="" id="menulink">{!! HTML::image('images/icon-menu.png', $alt="menulogo", $attributes = array("id" => "menulogo")) !!}</a></p>
	@foreach ($nav_links as $route => $route_label)	
		<p>{!! HTML::linkRoute($route, $route_label, array(), array('class' => 'navlink')) !!}</p>
	@endforeach
</div>
@yield('content')
@include('_qr_app_footer')
@if(isset($_GET["android"]))
	<link href="{{ asset('/css/android.css') }}" rel="stylesheet">
@endif
</body>
</html>