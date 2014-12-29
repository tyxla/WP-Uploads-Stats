<?php
$data = $wp_uploads_module->get_data();
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-chart wp-uploads-stats-module-attachments-author-chart">
	<?php 
	$title = 'Attachments by Author - Chart';
	$wp_uploads_module->render_head($title); 
	?>
	
	<div class="module-inner">
		<canvas class="chart chart-pie" id="module-attachments-author-chart" data-data='<?php echo json_encode($data); ?>' width="280" height="280" />
	</div>
</div>