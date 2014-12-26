// sort two number values
Number.prototype.sortCompare = function(y) {
	var x = this;
	
	if (x > y) {
		return 1;
	} else if(x < y) {
		return -1;
	}
	return 0;
}

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
		var table = $(this).closest('table'),
			tbody = table.find('tbody');
			order = $(this).hasClass('sortable-desc') ? 'asc' : 'desc',
			idx = table.find('thead th').index($(this));

		// handle main current sortable column class
		table.find('.sortable-active').removeClass('sortable-active');
		$(this).addClass('sortable-active');

		// sort rows by selected value in selected order
		tbody.find('tr').sort(function(a, b) {
			var x, y;

			// determine sorting criteria
			if (order == 'desc') {
				x = $(':eq(' + idx + ')', b).text();
				y = $(':eq(' + idx + ')', a).text();
			} else {
				x = $(':eq(' + idx + ')', a).text();
				y = $(':eq(' + idx + ')', b).text();
			}

			// if the values are numbers, apply number sort 
			var x_num = parseFloat(x),
				y_num = parseFloat(y);
			if (x_num > 0 && y_num > 0) {
				return x_num.sortCompare(y_num);
			}

			// if the values are non-number, sort as strings
			return x.localeCompare(y);
		}).appendTo(tbody);

		// add sort order class
		$(this).removeClass('sortable-asc sortable-desc').addClass('sortable-' + order);
	});

	// this is where we store the charts
	window.WPUS_Charts = {};

	// charts - pie
	$(window).on('load', function() {

		$('.chart-pie').each(function() {
			var id = $(this).attr('id'),
				context = document.getElementById(id).getContext("2d"),
				data = $(this).data('data');
			Object.defineProperty(window.WPUS_Charts, id, new Chart(context).Pie(data));
		});
	});

});