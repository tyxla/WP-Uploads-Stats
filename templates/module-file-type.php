<?php
$data = $wp_uploads_module->get_data();
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-overview">
	<h3>Files by Type</h3>
	<table>
		<tbody>
			<?php foreach ($data as $key => $value): ?>
				<tr>
					<th>.<?php echo $key; ?></th>
					<td><?php echo $value; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>