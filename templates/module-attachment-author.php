<?php
$data = $wp_uploads_module->get_data();
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-attachment-author">
	<h3>Attachments by Author</h3>
	<a href="#" class="wpus-icon dashicons dashicons-minus toggle"></a>
	<a href="#" class="wpus-icon dashicons dashicons-screenoptions drag-handle"></a>
	<div class="module-inner">
		<table>
			<thead>
				<tr>
					<th class="tl sortable">Author</th>
					<th class="tr sortable sortable-desc sortable-active">Count</th>
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