<?php
$data = $wp_uploads_module->get_data();
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-chart wp-uploads-stats-module-attachments-type-chart" id="wpus-module-<?php echo $wp_uploads_module->get_name(); ?>">
	<?php 
	$title = 'Attachments by Type - Chart';
	$wp_uploads_module->render_head($title); 
	?>

	<div class="module-inner <?php echo $wp_uploads_module->is_hidden() ? 'hidden' : ''; ?>">
		<canvas class="chart chart-pie" id="module-attachments-type-chart" data-data='<?php echo json_encode($data); ?>' width="280" height="280" />
	</div>
</div>