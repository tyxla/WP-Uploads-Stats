<?php
$data = $wp_uploads_module->get_data();
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-overview">
	<h3>Files by Type</h3>
	<table>
		<thead>
			<tr>
				<th class="tl sortable">File type</th>
				<th class="tr sortable sortable-desc sortable-active">Number of files</th>
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