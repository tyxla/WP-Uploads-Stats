<?php
$data = $wp_uploads_module->get_data();
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-size-by-year">
	<h3>Size by Year</h3>
	<a href="#" class="wpus-icon dashicons dashicons-minus toggle"></a>
	<a href="#" class="wpus-icon dashicons dashicons-screenoptions drag-handle"></a>
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