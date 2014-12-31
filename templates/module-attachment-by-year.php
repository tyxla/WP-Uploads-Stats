<?php
$data = $wp_uploads_module->get_data();
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-attachment-by-year" id="wpus-module-<?php echo $wp_uploads_module->get_name(); ?>">
	<?php 
	$title = 'Attachments by Year';
	$wp_uploads_module->render_head($title); 
	?>
	
	<div class="module-inner <?php echo $wp_uploads_module->is_hidden() ? 'hidden' : ''; ?>">
		<table>
			<thead>
				<tr>
					<th class="tl sortable">Year</th>
					<th class="tr sortable sortable-desc sortable-active">Count</th>
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