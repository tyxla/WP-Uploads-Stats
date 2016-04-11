<?php
/*
Plugin Name: WP Uploads Stats
Description: Provides you with detailed statistics about your WordPress media uploads and attachments.
Version: 1.0.3
Author: tyxla
Author URI: http://marinatanasov.com/
Plugin URI: https://github.com/tyxla/WP-Uploads-Stats
License: GPL2
Requires at least: 3.8
Tested up to: 4.5
Text Domain: wp-uploads-stats
Domain Path: /languages
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

		// hook our plugins_loaded function
		add_action('plugins_loaded', array($this, 'plugins_loaded'));

		// set the path to the plugin main directory
		$this->set_plugin_path(dirname(__FILE__));

		// set assets URL
		$this->set_assets_url(plugins_url('/', __FILE__));

		// include all plugin files
		$this->include_files();

		// initialize admin menu
		$this->set_admin_menu_manager(new WP_Uploads_Stats_Admin_Menu());

		// initialize module settings manager
		$this->set_module_settings_manager(new WP_Uploads_Stats_Module_Settings());

		// make sure nothing unnecessary is done outside of the plugin main page
		if ( !WP_Uploads_Stats_Admin_Menu::in_plugin_page() ) {
			return;
		}

		// initialize module manager
		$this->set_module_manager(new WP_Uploads_Stats_Module_Manager());

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
	 * Called upon WordPress' "plugins_loaded" action.
	 *
	 * @access public
	 */
	public function plugins_loaded() {
		// initialize translations
		load_plugin_textdomain( 'wp-uploads-stats', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
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
				'title' => __('Overview', 'wp-uploads-stats'),
			),
			'file-type' => array(
				'class' => 'WP_Uploads_Stats_Module_File_Type',
				'title' => __('Files by Type', 'wp-uploads-stats'),
			),
			'file-type-chart' => array(
				'class' => 'WP_Uploads_Stats_Module_File_Type_Chart',
				'title' => __('Files by Type - Chart', 'wp-uploads-stats'),
			),
			'size-by-year' => array(
				'class' => 'WP_Uploads_Stats_Module_Size_By_Year',
				'title' => __('Size by Year', 'wp-uploads-stats'),
			),
			'size-by-year-chart' => array(
				'class' => 'WP_Uploads_Stats_Module_Size_By_Year_Chart',
				'title' => __('Size by Year - Chart', 'wp-uploads-stats'),
			),
			'attachment-type' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_Type',
				'title' => __('Attachments by Type', 'wp-uploads-stats'),
			),
			'attachment-type-chart' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_Type_Chart',
				'title' => __('Attachments by Type - Chart', 'wp-uploads-stats'),
			),
			'attachment-author' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_Author',
				'title' => __('Attachments by Author', 'wp-uploads-stats'),
			),
			'attachment-author-chart' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_Author_Chart',
				'title' => __('Attachments by Author - Chart', 'wp-uploads-stats'),
			),
			'attachment-by-year' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_By_Year',
				'title' => __('Attachments by Year', 'wp-uploads-stats'),
			),
			'attachment-by-year-chart' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_By_Year_Chart',
				'title' => __('Attachments by Year - Chart', 'wp-uploads-stats'),
			),
			'attachment-post-type' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_Post_Type',
				'title' => __('Attachments by Post Type', 'wp-uploads-stats'),
			),
			'attachment-post-type-chart' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_Post_Type_Chart',
				'title' => __('Attachments by Post Type - Chart', 'wp-uploads-stats'),
			),
			'attachment-by-month-year' => array(
				'class' => 'WP_Uploads_Stats_Module_Attachment_By_Month_Year',
				'title' => __('Attachments by Month/Year', 'wp-uploads-stats'),
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