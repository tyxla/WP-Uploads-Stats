<?php
$data = $wp_uploads_module->get_data();
$module_name = $wp_uploads_module->get_name();
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-chart wp-uploads-stats-module-<?php echo $module_name; ?>" id="wpus-module-<?php echo $module_name; ?>">
	<?php 
	$title = 'Files by Type - Chart';
	$wp_uploads_module->render_head($title); 
	?>
	
	<div class="module-inner <?php echo $wp_uploads_module->is_hidden() ? 'hidden' : ''; ?>">
		<canvas class="chart chart-pie" id="module-<?php echo $module_name; ?>" data-data='<?php echo json_encode($data); ?>' width="280" height="280" />
	</div>		
</div>