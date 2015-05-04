$( document ).ready(navigation_ready);

function navigation_ready()
{
	function hide_show_menulinks()
	{
		$(".navlink").each(function()
		{
			if (window.matchMedia('(max-width: 767px)').matches)
				$(this).hide();
			else
				$(this).show();
		});
	}


	$( window ).resize(hide_show_menulinks);
	hide_show_menulinks();

	$("#menulink").click(function(event)
	{
		$(".navlink").each(function()
		{
			$(this).toggle();
		});
		event.preventDefault();
	});
}