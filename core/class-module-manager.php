<?php
/**
 * Class for managing modules.
 */
class WP_Uploads_Stats_Module_Manager {
	/**
	 * Contains all registered modules.
	 *
	 * @access protected
	 *
	 * @var array
	 */
	protected $modules = array();

	/**
	 * Constructor.
	 *	
	 * Initializes and hooks the modules and their functionality.
	 *
	 * @access public
	 */
	public function __construct() {

		// load the modules
		add_action('init', array($this, 'load'));

		// setup the modules
		add_action('admin_init', array($this, 'setup'));

		// hook the main module page
		add_action('admin_menu', array($this, 'add_submenu_page'));
	}

	/**
	 * Load all the plugin modules.
	 *
	 * @access public
	 */
	public function load() {
		// allow for new modules to be registered
		$module_names = apply_filters('wp_uploads_stats_modules', array());

		// initialize the modules
		$modules = array();
		foreach ($module_names as $module_name => $module_settings) {
			$class_name = $module_settings['class'];
			$module_title = $module_settings['title'];
			$modules[] = new $class_name($module_name, $module_title);
		}

		// register the modules
		$this->set_modules($modules);
	}

	/**
	 * Setup all the registered plugin modules.
	 *
	 * @access public
	 */
	public function setup() {
		$modules = $this->get_modules();
		foreach ($modules as $module) {
			$module->setup();
		}
	}

	/**
	 * Add the main plugin submenu page
	 *
	 * @access public
	 */
	public function add_submenu_page() {
		// the title of the submenu page
		$menu_title = apply_filters('wp_uploads_stats_menu_item_title', 'Uploads Stats');

		// register the submenu page - child of the Media parent menu item
		add_submenu_page( 'upload.php', $menu_title, $menu_title, 'manage_options', 'wpus-' . sanitize_title_with_dashes($menu_title), array($this, 'render') );
	}

	/**
	 * Render the main module container.
	 *
	 * @access public
	 */
	public function render() {
		global $wp_uploads_stats;		

		// determine the main template
		$template = $wp_uploads_stats->get_plugin_path() . '/templates/main.php';
		$template = apply_filters('wp_uploads_stats_main_template', $template);

		// render the main template
		include_once($template);
	}

	/**
	 * Render all modules.
	 *
	 * @access public
	 */
	public function render_modules() {
		$modules = $this->get_modules();

		// allow external code to modify the order of appearance of the modules
		$modules = apply_filters('wp_uploads_stats_modules_render_order', $modules);

		// render the modules in the correct order
		foreach ($modules as $module) {
			$module->render();
		}
	}

	/**
	 * Retrieve all the registered modules.
	 *
	 * @access public
	 *
	 * @return array $modules The currently registered modules.
	 */
	public function get_modules() {
		return $this->modules;
	}

	/**
	 * Modify the registered modules.
	 *
	 * @access public
	 *
	 * @param array $modules An array of module objects.
	 */
	public function set_modules($modules = array()) {
		$this->modules = $modules;
	}

}