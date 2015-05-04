<style>
	.search_form
	{
		float:right;
		clear:both;
	}
</style>
<form class="search_form" method="POST" action="{{ route('search') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="text">
		<label>
			<input type="text" name="search_term">
			<button type="submit" class="btn btn-primary">Search</button>
		</label>
	</div>
</form>	