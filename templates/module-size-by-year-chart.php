<?php
$data = $wp_uploads_module->get_data();
$settings = array(
	'tooltipTemplate' => '<%if (label){%><%=label%><%}%>'
);
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-chart wp-uploads-stats-module-size-by-year-chart">
	<h3>Size by Year - Chart</h3>
	<a href="#" class="wpus-icon dashicons dashicons-minus toggle"></a>
	<a href="#" class="wpus-icon dashicons dashicons-screenoptions drag-handle"></a>
	<div class="module-inner">
		<canvas class="chart chart-pie" id="module-size-by-year-chart" data-data='<?php echo json_encode($data); ?>' data-settings='<?php echo json_encode($settings); ?>' width="280" height="280" />
	</div>
</div>