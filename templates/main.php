<div class="wp-uploads-stats">
	<div class="wrap">
		<h2><?php echo WP_Uploads_Stats_Admin_Menu::get_menu_title(); ?></h2>

		<div class="wp-uploads-stats-modules">
			<?php 
			// this is where the modules should hook to
			do_action('wp_uploads_stats_render');
			?>
		</div>
	</div>
</div>