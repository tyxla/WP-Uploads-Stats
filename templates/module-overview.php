<?php
$data = $wp_uploads_module->get_data();
$data_labels = $wp_uploads_module->get_data_labels();
$module_name = $wp_uploads_module->get_name();
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-<?php echo $module_name; ?>" id="wpus-module-<?php echo $module_name; ?>">
	<?php $wp_uploads_module->render_head(); ?>
	
	<div class="module-inner <?php echo $wp_uploads_module->is_hidden() ? 'hidden' : ''; ?>">
		<table>
			<tbody>
				<?php foreach ($data as $key => $value): ?>
					<tr>
						<th><?php echo $data_labels[$key]; ?></th>
						<td><?php echo $value; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>