<?php
$data = $wp_uploads_module->get_data();
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-file-type">
	<h3>Attachments by Type</h3>
	<table>
		<thead>
			<tr>
				<th class="tl sortable">Type</th>
				<th class="tr sortable sortable-desc sortable-active">Count</th>
			</tr>
		</thead>
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