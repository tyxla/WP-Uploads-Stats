<?php
$data = $wp_uploads_module->get_data();
$module_name = $wp_uploads_module->get_name();
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-<?php echo $module_name; ?>" id="wpus-module-<?php echo $module_name; ?>">
	<?php $wp_uploads_module->render_head(); ?>
	
	<div class="module-inner <?php echo $wp_uploads_module->is_hidden() ? 'hidden' : ''; ?>">
		<table>
			<thead>
				<tr>
					<th class="tl sortable"><?php _e('Author', 'wp-uploads-stats'); ?></th>
					<th class="tr sortable sortable-desc sortable-active"><?php _e('Count', 'wp-uploads-stats'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $id => $count): ?>
					<tr>
						<th><?php echo get_the_author_meta('display_name', $id); ?></th>
						<td><?php echo $count; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>