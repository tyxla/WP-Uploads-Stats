jQuery(function($) {

	$masonry_wrapper = $('.wp-uploads-stats-modules');

	if ($masonry_wrapper.length) {
		$masonry_wrapper.masonry({
			itemSelector: '.wp-uploads-stats-module'
		});
	}

});