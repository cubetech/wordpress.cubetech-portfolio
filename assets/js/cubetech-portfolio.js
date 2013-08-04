jQuery(function() {

	jQuery("#cubetech-portfolio-filter-select").change(function () {
		if ( jQuery("#cubetech-portfolio-filter-select").val() == 'all' ) {
			jQuery(".cubetech-portfolio").fadeIn(500);
		} else {
			jQuery(".cubetech-portfolio").filter(":not(.cubetech-portfolio-group-" + jQuery("#cubetech-portfolio-filter-select").val() + ")").hide();
			jQuery(".cubetech-portfolio").filter(".cubetech-portfolio-group-" + jQuery("#cubetech-portfolio-filter-select").val()).fadeIn(500);
		}
	})
	.change();
	
});