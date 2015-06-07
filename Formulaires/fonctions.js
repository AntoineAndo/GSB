$( function()
{
	activerToggle() ;
} )

function activerToggle()
{
	$(".toggleZone").each( function()
	{
		id = $(this).attr("id") ;
		$("#" + id + "Butt").bind("click", function()
		{
			id = $(this).attr("id").replace("Butt", "")
			$("#"+id).slideToggle() ;
			$(".toggleZone:not(#"+id+")").slideUp() ;
		})
	})
}