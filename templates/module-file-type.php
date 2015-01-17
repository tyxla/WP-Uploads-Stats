<?php
$data = $wp_uploads_module->get_data();
$module_name = $wp_uploads_module->get_name();
$max_chars = 20;
$more = '...';
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-<?php echo $module_name; ?>" id="wpus-module-<?php echo $module_name; ?>">
	<?php $wp_uploads_module->render_head(); ?>
	
	<div class="module-inner <?php echo $wp_uploads_module->is_hidden() ? 'hidden' : ''; ?>">
		<table>
			<thead>
				<tr>
					<th class="tl sortable"><?php _e('File type', 'wp-uploads-stats'); ?></th>
					<th class="tr sortable sortable-desc sortable-active"><?php _e('Number of files', 'wp-uploads-stats'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $file_type => $value): ?>
					<tr>
						<th>.<?php echo strlen($file_type) > $max_chars ? substr($file_type, 0, $max_chars) . $more : $file_type; ?></th>
						<td><?php echo $value; ?></td> 
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>