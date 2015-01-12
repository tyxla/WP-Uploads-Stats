<?php
global $wp_locale;
$data = $wp_uploads_module->get_data();
$module_name = $wp_uploads_module->get_name();
?>
<div class="wp-uploads-stats-module wp-uploads-stats-module-<?php echo $module_name; ?>" id="wpus-module-<?php echo $module_name; ?>">
	<?php $wp_uploads_module->render_head(); ?>
	
	<div class="module-inner <?php echo $wp_uploads_module->is_hidden() ? 'hidden' : ''; ?>">
		<table>
			<tbody>
				<?php foreach ($data as $year => $months): ?>
					<tr>
						<th colspan="2" class="tc heading"><?php echo $year; ?></th>
					</tr>
					<?php foreach ($months as $month => $count): ?>
						<tr>
							<td class="tl"><?php echo $wp_locale->get_month($month); ?></th>
							<td class="tr"><?php echo $count; ?></th>
						</tr>
					<?php endforeach ?>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>