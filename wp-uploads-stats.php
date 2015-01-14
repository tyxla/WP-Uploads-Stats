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
	 * The admin menu manager.
	 *
	 * @access protected
	 *
	 * @var WP_Uploads_Stats_Admin_Menu
	 */
	protected $admin_menu_manager;

	/**
	 * The module settings manager.
	 *
	 * @access protected
	 *
	 * @var WP_Uploads_Stats_Module_Settings
	 */
	protected $module_settings_manager;

	/**
	 * The screen settings manager.
	 *
	 * @access protected
	 *
	 * @var WP_Uploads_Stats_Module_Screen_Options
	 */
	protected $screen_settings_manager;

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

		// initialize admin menu
		$this->set_admin_menu_manager(new WP_Uploads_Stats_Admin_Menu());

		// initialize module settings manager
		$this->set_module_settings_manager(new WP_Uploads_Stats_Module_Settings());

		// initialize screen settings manager
		$this->set_screen_settings_manager(new WP_Uploads_Stats_Module_Screen_Options());

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
	 * Retrieve the admin menu manager.
	 *
	 * @access public
	 *
	 * @return WP_Uploads_Stats_Admin_Menu $admin_menu_manager The admin menu manager.
	 */
	public function get_admin_menu_manager() {
		return $this->admin_menu_manager;
	}

	/**
	 * Modify the admin menu manager.
	 *
	 * @access public
	 *
	 * @param WP_Uploads_Stats_Admin_Menu $admin_menu_manager The new admin menu manager.
	 */
	public function set_admin_menu_manager($admin_menu_manager) {
		$this->admin_menu_manager = $admin_menu_manager;
	}

	/**
	 * Retrieve the module settings manager.
	 *
	 * @access public
	 *
	 * @return WP_Uploads_Stats_Module_Settings $module_settings_manager The module settings manager.
	 */
	public function get_module_settings_manager() {
		return $this->module_settings_manager;
	}

	/**
	 * Modify the module settings manager.
	 *
	 * @access public
	 *
	 * @param WP_Uploads_Stats_Module_Settings $module_settings_manager The new module settings manager.
	 */
	public function set_module_settings_manager($module_settings_manager) {
		$this->module_settings_manager = $module_settings_manager;
	}

	/**
	 * Retrieve the screen settings manager.
	 *
	 * @access public
	 *
	 * @return WP_Uploads_Stats_Module_Screen_Options $screen_settings_manager The screen settings manager.
	 */
	public function get_screen_settings_manager() {
		return $this->screen_settings_manager;
	}

	/**
	 * Modify the screen settings manager.
	 *
	 * @access public
	 *
	 * @param WP_Uploads_Stats_Module_Screen_Options $screen_settings_manager The new screen settings manager.
	 */
	public function set_screen_settings_manager($screen_settings_manager) {
		$this->screen_settings_manager = $screen_settings_manager;
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
			'overview' => array(
				'class' => 'WP_Uploads_Stats_Module_Overview',
				'title' => 'Overview',
			),
			'file-type' => array(
				'class' => 'WP_Uploads_Stats_Module_File_Type',
				'title' => 'Files by Type',
			),
			'file-type-chart' => array(
				'class' => 'WP_Uploads_Stats_Module_File_Type_Chart',
				'title' => 'Files by Type - Chart',
			),
			'size-by-year' => array(
				'class' => 'WP_Uploads_Stats_Module_Size_By_Year',
				'title' => 'Size by Year',
			),
			'size-by-year-chart' => array(
				'class' => 'WP_Uploads_Stats_Module_Size_By_Year_Chart',
				'title' => 'Size by Year - Chart',
			),
			'attachment-type' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_Type',
				'title' => 'Attachments by Type',
			),
			'attachment-type-chart' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_Type_Chart',
				'title' => 'Attachments by Type - Chart',
			),
			'attachment-author' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_Author',
				'title' => 'Attachments by Author',
			),
			'attachment-author-chart' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_Author_Chart',
				'title' => 'Attachments by Author - Chart',
			),
			'attachment-by-year' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_By_Year',
				'title' => 'Attachments by Year',
			),
			'attachment-by-year-chart' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_By_Year_Chart',
				'title' => 'Attachments by Year - Chart',
			),
			'attachment-post-type' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_Post_Type',
				'title' => 'Attachments by Post Type',
			),
			'attachment-post-type-chart' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_Post_Type_Chart',
				'title' => 'Attachments by Post Type - Chart',
			),
			'attachment-by-month-year' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_By_Month_Year',
				'title' => 'Attachments by Month/Year',
			),
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
		require_once($this->get_plugin_path() . '/core/class-module-settings.php');
		require_once($this->get_plugin_path() . '/core/class-module-screen-options.php');
		require_once($this->get_plugin_path() . '/core/class-admin-menu.php');

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

		// pass module settings to main script
		wp_localize_script('wp-uploads-stats', 'WPUS', array(
			'settings' => $this->get_module_settings_manager()->get()
		));
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