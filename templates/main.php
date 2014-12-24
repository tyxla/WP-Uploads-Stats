<div class="wp-uploads-stats">
	<div class="wrap">
		<h2>Uploads Stats</h2>

		<div class="wp-uploads-stats-modules">
			<?php 
			// this is where the modules should hook to
			do_action('wp_uploads_stats_render');
			?>
		</div>
	</div>
</div>