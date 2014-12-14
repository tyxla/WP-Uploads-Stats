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
	 * Constructor.
	 *	
	 * Initializes and hooks the plugin functionality.
	 *
	 * @access public
	 */
	public function __construct() {

		// set the path to the plugin main directory
		$this->set_plugin_path(dirname(__FILE__));

		// include all plugin files
		$this->include_files();

		// enqueue scripts
		add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));

		// enqueue styles
		add_action('admin_enqueue_scripts', array($this, 'enqueue_styles'));

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

	}

	/**
	 * Enqueue main plugin scripts.
	 *
	 * @access public
	 */
	public function enqueue_scripts() {
		
	}

	/**
	 * Enqueue main plugin styles.
	 *
	 * @access public
	 */
	public function enqueue_styles() {
		
	}

}

// initialize WP Uploads Stats
global $wp_uploads_stats;
$wp_uploads_stats = new WP_Uploads_Stats();