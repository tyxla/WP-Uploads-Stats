<?php
/**
 * Plugin Name: WP Uploads Stats
 * Description: Provides you with detailed statistics about your WordPress uploads.
 * Version: 1.0
 * Author: tyxla
 * Author URI: https://github.com/tyxla
 * License: GPL2
 */

/**
 * Main plugin class.
 */
class WP_Uploads_Stats {

	/**
	 * Path to the plugin.
	 *
	 * @access protected
	 *
	 * @var string
	 */
	protected $plugin_path;

	/**
	 * Plugin assets base URL.
	 *
	 * @access protected
	 *
	 * @var string
	 */
	protected $assets_url;

	/**
	 * The module manager.
	 *
	 * @access protected
	 *
	 * @var WP_Uploads_Stats_Module_Manager
	 */
	protected $module_manager;

	/**
	 * Constructor.
	 *	
	 * Initializes and hooks the plugin functionality.
	 *
	 * @access public
	 */
	public function __construct() {

		// set the path to the plugin main directory
		$this->set_plugin_path(dirname(__FILE__));

		// set assets URL
		$this->set_assets_url(plugins_url('/', __FILE__));

		// include all plugin files
		$this->include_files();

		// initialize module manager
		$this->set_module_manager(new WP_Uploads_Stats_Module_Manager());

		// register modules
		add_filter('wp_uploads_stats_modules', array($this, 'get_modules'));

		// hook the rendering of all modules
		add_action('wp_uploads_stats_render', array($this->module_manager, 'render_modules'));

		// enqueue scripts
		add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));

		// enqueue styles
		add_action('admin_enqueue_scripts', array($this, 'enqueue_styles'));

	}

	/**
	 * Retrieve the module manager.
	 *
	 * @access public
	 *
	 * @return WP_Uploads_Stats_Module_Manager $module_manager The module manager.
	 */
	public function get_module_manager() {
		return $this->module_manager;
	}

	/**
	 * Modify the module manager.
	 *
	 * @access public
	 *
	 * @param WP_Uploads_Stats_Module_Manager $module_manager The new module manager.
	 */
	public function set_module_manager($module_manager) {
		$this->module_manager = $module_manager;
	}

	/**
	 * Retrieve the path to the main plugin directory.
	 *
	 * @access public
	 *
	 * @return string $plugin_path The path to the main plugin directory.
	 */
	public function get_plugin_path() {
		return $this->plugin_path;
	}

	/**
	 * Modify the path to the main plugin directory.
	 *
	 * @access protected
	 *
	 * @param string $plugin_path The new path to the main plugin directory.
	 */
	protected function set_plugin_path($plugin_path) {
		$this->plugin_path = $plugin_path;
	}

	/**
	 * The default modules to register.
	 *
	 * @access protected
	 */
	public function get_modules() {
		return array(
			'overview' => 'WP_Uploads_Stats_Module_Overview',
			'file-type' => 'WP_Uploads_Stats_Module_File_Type',
			'file-type-chart' => 'WP_Uploads_Stats_Module_File_Type_Chart',
			'size-by-year' => 'WP_Uploads_Stats_Module_Size_By_Year',
			'size-by-year-chart' => 'WP_Uploads_Stats_Module_Size_By_Year_Chart',
			'attachment-type' => 'WP_Uploads_Stats_Module_Attachment_Type',
			'attachment-type-chart' => 'WP_Uploads_Stats_Module_Attachment_Type_Chart',
			'attachment-author' => 'WP_Uploads_Stats_Module_Attachment_Author',
			'attachment-author-chart' => 'WP_Uploads_Stats_Module_Attachment_Author_Chart',
		);
	}

	/**
	 * Load the plugin classes and libraries.
	 *
	 * @access protected
	 */
	protected function include_files() {
		require_once($this->get_plugin_path() . '/core/class-module-manager.php');
		require_once($this->get_plugin_path() . '/core/class-module-base.php');

		require_once($this->get_plugin_path() . '/core/class-directory-file-iterator.php');

		$modules = $this->get_modules();
		foreach ($modules as $module_name => $class_name) {
			require_once($this->get_plugin_path() . '/modules/' . $module_name . '/module.php');
		}
		
	}

	/**
	 * Retrieve the plugin assets base URL.
	 *
	 * @access public
	 *
	 * @return string $assets_url The plugin assets base URL.
	 */
	public function get_assets_url() {
		return $this->assets_url;
	}

	/**
	 * Modify the plugin assets base URL.
	 *
	 * @access protected
	 *
	 * @param string $assets_url The new plugin assets base URL.
	 */
	protected function set_assets_url($assets_url) {
		$this->assets_url = $assets_url;
	}

	/**
	 * Enqueue main plugin scripts.
	 *
	 * @access public
	 */
	public function enqueue_scripts() {
		wp_enqueue_script('jquery-ui-draggable');
		wp_enqueue_script('jquery-ui-droppable');
		wp_enqueue_script('chart-js', $this->get_assets_url() . 'js/Chart.min.js');
		wp_enqueue_script('jquery-shapeshift', $this->get_assets_url() . 'js/jquery.shapeshift.min.js', array('jquery'));
		wp_enqueue_script('wp-uploads-stats', $this->get_assets_url() . 'js/main.js', array('jquery', 'jquery-shapeshift'));
	}

	/**
	 * Enqueue main plugin styles.
	 *
	 * @access public
	 */
	public function enqueue_styles() {
		// registering dashicons if they don't exist (for WP < 3.8 compatibility)
		if (!wp_style_is('dashicons', 'registered')) {
			wp_register_style('dashicons', $this->get_assets_url() . 'css/dashicons.min.css');
		}

		wp_enqueue_style('dashicons');
		wp_enqueue_style('wp-uploads-stats-main', $this->get_assets_url() . 'css/main.css');
	}

}

// initialize WP Uploads Stats
global $wp_uploads_stats;
$wp_uploads_stats = new WP_Uploads_Stats();