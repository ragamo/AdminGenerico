jQuery(document).ready(function($) {
	
	$('.linkeable').on('click', function() {
		window.location.href = $(this).attr('data-href');
	});

});