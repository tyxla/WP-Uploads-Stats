<?php
$data = $wp_uploads_module->get_data();
$data_labels = $wp_uploads_module->get_data_labels();
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-overview">
	<h3>Overview</h3>
	<a href="#" class="wpus-icon dashicons dashicons-minus toggle"></a>
	<a href="#" class="wpus-icon dashicons dashicons-screenoptions drag-handle"></a>
	<div class="module-inner">
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