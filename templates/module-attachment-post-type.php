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
					<th class="tl sortable">Post type attached to</th>
					<th class="tr sortable sortable-desc sortable-active">Count</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $key => $value): 
					$post_type = get_post_type_object($key);
					?>
					<tr>
						<th><?php echo $post_type ? $post_type->labels->name: $key; ?></th>
						<td><?php echo $value; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>