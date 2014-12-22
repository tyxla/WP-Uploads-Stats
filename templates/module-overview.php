<?php
$data = $wp_uploads_module->get_data();
$data_labels = $wp_uploads_module->get_data_labels();
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-overview">
	<h3>Overview</h3>
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