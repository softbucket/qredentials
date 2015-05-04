@extends('qr_code_app')

@section('content')

<link href="{{ asset('/css/splash.css') }}" rel="stylesheet">
<div class="top_splash_section">
	<div class="div_splash_text"><p class="splash_text">Let <span class='qr_color'>qr</span>edentials handle your sign ups.</p></div>
	{!! HTML::image('images/qr_in_hand.jpg', $alt="qr_code_phone", $attributes = array("id" => "qr_code_phone")) !!}
</div>

<div class="splash_section">
	<div class="div_splash_text_section"><p><span class="emphasize strikethrough">NFC? <br/>Bluetooth? <br/>Wireless Chip?</span><br/><br/><span class="emphasize">Unlock your phone.</span><br/><br/><br/>
		No confusing technologies. Simply punch in your secret pin and experience SECURE and FAST payment with your connected credit card.</div>
	<div class="div_splash_img">{!! HTML::image('images/Mobile_Payment.png', $alt="mobile_payment", $attributes = array("id" => "mobile_payment")) !!}</div>
</div>

<div class="splash_section">
	<div class="splash_text_section"><p class="splash_title">Payment that makes sense.</p></div>
	<div class="qr_images_div">
		<span class="qr_images">
		{!! HTML::image('images/qr1.png', $alt="qr1", $attributes = array("id" => "qr1", "class" => "qrimage")) !!}
		{!! HTML::image('images/qr2.png', $alt="qr2", $attributes = array("id" => "qr2", "class" => "qrimage")) !!}
		{!! HTML::image('images/qr3.png', $alt="qr3", $attributes = array("id" => "qr3", "class" => "qrimage")) !!}
		{!! HTML::image('images/qr4.png', $alt="qr4", $attributes = array("id" => "qr4", "class" => "qrimage")) !!}
		{!! HTML::image('images/qr5.png', $alt="qr5", $attributes = array("id" => "qr5", "class" => "qrimage")) !!}
		</span>
	</div>
	<div class="splash_text_section"><p class="splash_title">With unique codes.</p></div>
	<div class="splash_text_section"><p class="description_splash">Each time you use <span class='qr_color'>qr</span>edentials, your QR-code will change. With one-time codes for each transaction, it's like having a different credit card number everytime. Thus thwarting hackers from using your information.</p></div>

</div>

@endsection
