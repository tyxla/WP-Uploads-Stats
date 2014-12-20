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
	 * Load the plugin classes and libraries.
	 *
	 * @access protected
	 */
	protected function include_files() {
		require_once($this->get_plugin_path() . '/core/class-module-manager.php');
		require_once($this->get_plugin_path() . '/core/class-module-base.php');

		require_once($this->get_plugin_path() . '/includes/class-directory-iterator.php');
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
		wp_enqueue_script('wp-uploads-stats', $this->get_assets_url() . 'js/main.js', array('jquery'));
	}

	/**
	 * Enqueue main plugin styles.
	 *
	 * @access public
	 */
	public function enqueue_styles() {
		wp_enqueue_style('wp-uploads-stats-main', $this->get_assets_url() . 'css/main.css');
	}

}

// initialize WP Uploads Stats
global $wp_uploads_stats;
$wp_uploads_stats = new WP_Uploads_Stats();