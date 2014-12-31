<?php
$data = $wp_uploads_module->get_data();
$settings = array(
	'tooltipTemplate' => '<%if (label){%><%=label%><%}%>'
);
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-chart wp-uploads-stats-module-attachment-by-year-chart" id="wpus-module-<?php echo $wp_uploads_module->get_name(); ?>">
	<?php 
	$title = 'Attachment by Year - Chart';
	$wp_uploads_module->render_head($title); 
	?>
	
	<div class="module-inner <?php echo $wp_uploads_module->is_hidden() ? 'hidden' : ''; ?>">
		<canvas class="chart chart-pie" id="module-attachment-by-year-chart" data-data='<?php echo json_encode($data); ?>' data-settings='<?php echo json_encode($settings); ?>' width="280" height="280" />
	</div>
</div>