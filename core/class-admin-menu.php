<?php
/**
 * Class for managing administration menu.
 */
class WP_Uploads_Stats_Admin_Menu {

	/**
	 * Constructor.
	 *	
	 * Initializes and sets up the menu.
	 *
	 * @access public
	 */
	public function __construct() {
		// hook the main plugin page
		add_action('admin_menu', array($this, 'add_submenu_page'));
	}

	/**
	 * Get the title of the submenu item page.
	 *
	 * @access public
	 *
	 * @return string $menu_title The title of the submenu item.
	 */
	public static function get_menu_title() {
		// allow filtering the title of the submenu page
		$menu_title = apply_filters('wp_uploads_stats_menu_item_title', __('Uploads Stats', 'wp-uploads-stats'));

		return $menu_title;
	}

	/**
	 * Get the ID (slug) of the submenu item page.
	 *
	 * @access public
	 *
	 * @return string $menu_id The ID (slug) of the submenu item.
	 */
	public static function get_menu_id() {
		return 'wpus-uploads-stats';
	}

	/**
	 * Add the main plugin submenu page
	 *
	 * @access public
	 */
	public function add_submenu_page() {
		$menu_title = self::get_menu_title();
		$menu_id = self::get_menu_id();

		// register the submenu page - child of the Media parent menu item
		add_submenu_page( 'upload.php', $menu_title, $menu_title, 'manage_options', $menu_id, array($this, 'render') );
	}

	/**
	 * Render the main module page.
	 *
	 * @access public
	 */
	public function render() {
		global $wp_uploads_stats;
		
		// the modules will be rendered only if module manager is loaded
		if ($module_manager = $wp_uploads_stats->get_module_manager()) {
			$module_manager->render();
		}
	}

	/**
	 * Whether we're in the main plugin page.
	 *
	 * @access public
	 * 
	 * @return bool $bool True if we're in the main plugin page.
	 */
	public static function in_plugin_page() {
		if ( !isset($_GET['page']) || $_GET['page'] !== self::get_menu_id() ) {
			return false;
		}
		return true;
	}

}