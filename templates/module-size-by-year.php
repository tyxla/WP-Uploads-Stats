<?php
$data = $wp_uploads_module->get_data();
$module_name = $wp_uploads_module->get_name();
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-<?php echo $module_name; ?>" id="wpus-module-<?php echo $module_name; ?>">
	<?php 
	$title = 'Size by Year';
	$wp_uploads_module->render_head($title); 
	?>
	
	<div class="module-inner <?php echo $wp_uploads_module->is_hidden() ? 'hidden' : ''; ?>">
		<table>
			<thead>
				<tr>
					<th class="tl sortable">Year</th>
					<th class="tr sortable sortable-desc sortable-active">Total Size</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $key => $value): ?>
					<tr>
						<th><?php echo $key; ?></th>
						<td><?php echo $value; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>