<?php
/**
 * Class for handling module screen options.
 */
class WP_Uploads_Stats_Module_Screen_Options {

	/**
	 * Constructor.
	 *	
	 * Hook and initialize the screen options functionality.
	 *
	 * @access public
	 */
	public function __construct() {
		add_action('screen_settings', array($this, 'screen_settings'), 10, 2);
	}

	/**
	 * Setup the screen options.
	 *
	 * @access public
	 */
	public function screen_settings($settings, $current_screen) {
		global $wp_uploads_stats;

		$module_settings = $wp_uploads_stats->get_module_settings_manager()->get();

		$settings .= '<h5>' . __('Toggle Modules', 'wp-uploads-stats') . '</h5>';
		$settings .= '<p>' . __('Uncheck a box to hide a certain statistics module and check it again to show it.', 'wp-uploads-stats') . '</p>';

		$modules = $wp_uploads_stats->get_module_manager()->get_modules();
		foreach ($modules as $module) {
			$id = $module->get_name();
			$field_id = 'toggle-module-' . $id;
			$title = $module->get_title();
			$enabled = !( isset($module_settings[$id]['enabled']) && !$module_settings[$id]['enabled'] );
			$settings .= '<label for="' . $field_id . '">';
			$settings .= '<input class="hide-wpus-module-tog" name="' . $field_id . '" type="checkbox" id="' . $field_id . '" value="' . $id . '" ' . checked($enabled, 1, false) . ' />';
			$settings .= "$title</label>\n";
		}

		return $settings;
	}

}