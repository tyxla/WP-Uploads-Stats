jQuery(function($) {

	// initialize main page masonry
	$masonry_wrapper = $('.wp-uploads-stats-modules');
	if ($masonry_wrapper.length) {
		$masonry_wrapper.masonry({
			itemSelector: '.wp-uploads-stats-module'
		});
	}

	// sortable tables
	$('.wp-uploads-stats-module thead th.sortable').on('click', function() {

		// handle main current sortable column class
		$('.sortable-active').removeClass('sortable-active');
		$(this).addClass('sortable-active');

		var tbody = $(this).closest('table').find('tbody');
			order = $(this).hasClass('sortable-desc') ? 'asc' : 'desc',
			idx = $('.wp-uploads-stats-module thead th').index($(this));

		// sort rows by selected value in selected order
		tbody.find('tr').sort(function(a, b) {
			var x, y;
			if (order == 'desc') {
				x = $(':eq(' + idx + ')', b).text();
				y = $(':eq(' + idx + ')', a).text();
			} else {
				x = $(':eq(' + idx + ')', a).text();
				y = $(':eq(' + idx + ')', b).text();
			}

			return x.localeCompare(y);
		}).appendTo(tbody);

		// add sort order class
		$(this).removeClass('sortable-asc sortable-desc').addClass('sortable-' + order);
	});

});