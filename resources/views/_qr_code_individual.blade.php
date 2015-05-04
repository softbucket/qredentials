<style type="text/css">
	#qr_code_invdividual_template
	{
		display: none;
	}
	.close_button_img
	{
		width: 2em;
		height: auto;
		margin: 0em;
		padding: 0em;
	}
	.qr_code_individual
	{	
		display: inline-block;
		padding: 0.5em;
		width: calc(150px + 2em);
	}
	.qr_code_individual button
	{
		background-color: transparent;
		border: none;
		margin: 0px;
		padding: 0px;
		float: right;
	}
	.close_button_div
	{
		width: calc(150px + 1.2em);
		height: 1.5em;
	}
	.qr_code_individual_img
	{
		width: 150px;
		height: auto;
	}
	.p_unique_key
	{
		max-width: calc(150px + 2em);
		word-break: break-all;
		font-size: 4px;
	}
</style>
<div id="qr_code_invdividual_template" class="qr_code_individual">
	<div  class="close_button_div">
		<button onclick="remove_info_click(this)" title="Expire this QR code">{!! HTML::image('images/close.png', $alt="close_button", $attributes = array("class" => "close_button_img")) !!}</button>
	</div>
	<img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Example' alt='unique_key' class="qr_code_individual_img"/>
	<p class="p_unique_key"></p>
</div>