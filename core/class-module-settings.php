<?php
/**
 * Class for handling per-user module settings.
 */
class WP_Uploads_Stats_Module_Settings {

	/**
	 * Constructor.
	 *	
	 * Initializes the module settings manager.
	 *
	 * @access public
	 */
	public function __construct() {
		// hook the module settings save action
		add_action('wp_ajax_wpus_save_module_settings', array($this, 'handle_save'));

		// auto sort the modules based on the user's settings
		add_filter('wp_uploads_stats_modules', array($this, 'sort_modules'), 20);
	}

	/**
	 * Save the module settings.
	 *
	 * @access public
	 */
	public function handle_save() {
		// get current user ID
		$user_ID = get_current_user_id();

		// handle saved module settings
		$settings = !empty($_POST['settings']) ? $_POST['settings'] : array();

		// sort modules by order
		$settings = $this->sort($settings);

		// save settings
		update_user_meta($user_ID, '_wpus_module_settings', $settings);
	}

	/**
	 * Sort the modules by order.
	 *
	 * @access protected
	 *
	 * @param array $settings The unsorted settings.
	 * @return array $settings The sorted settings.
	 */
	protected function sort($settings) {
		uasort($settings, array($this, 'sort_criteria'));
		return $settings;
	}

	/**
	 * Sort criteria for the sort() method.
	 *
	 * @access public
	 *
	 * @param array $a The first module settings in the comparison.
	 * @param array $b The second module settings in the comparison.
	 * @return int -1|0|1 An integer depending on the comparison result.
	 */
	public function sort_criteria($a, $b) {
		return strcmp($a['order'], $b['order']);
	}

	/**
	 * Get the module settings for the current user.
	 *
	 * @access public
	 *
	 * @return array $settings The module settings for the current user.
	 */
	public function get() {
		$user_ID = get_current_user_id();
		$settings = get_user_meta($user_ID, '_wpus_module_settings', 1);
		$settings = $this->sort($settings);
		return $settings;
	}

	/**
	 * Change the module order based on the user's settings.
	 *
	 * @access public
	 *
	 * @return array $modules The sorted modules for the current user.
	 */
	public function sort_modules($modules) {
		// get user's settings
		$user_settings = $this->get();

		// start empty
		$sorted_modules = array();

		// go through user's modules and fetch them in correct order
		foreach ($user_settings as $module_name => $module_settings) {
			if (!array_key_exists($module_name, $modules)) {
				continue;
			}
			$sorted_modules[$module_name] = $modules[$module_name];
		}

		// add the remaining modules (if any)
		foreach ($modules as $module_name => $class_name) {
			if (!array_key_exists($module_name, $sorted_modules)) {
				$sorted_modules[$module_name] = $class_name;
			}
		}

		return $sorted_modules;
	}

}