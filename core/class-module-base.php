<?php
/**
 * Abstract base class for a WP_Uploads_Stats module.
 */
abstract class WP_Uploads_Stats_Module_Base {

	/**
	 * Module name.
	 *
	 * @access protected
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * Constructor.
	 *	
	 * Initializes the module.
	 *
	 * @access public
	 */
	public function __construct($name) {
		$this->set_name($name);
	}

	/**
	 * Setup & configure the module.
	 *
	 * @abstract
	 * @access public
	 */
	abstract public function setup();

	/**
	 * Render the module.
	 *
	 * @abstract
	 * @access public
	 */
	public function render() {
		global $wp_uploads_stats;		

		// determine the main template
		$template = $wp_uploads_stats->get_plugin_path() . '/templates/module-' . $this->get_name() . '.php';
		$template = apply_filters('wp_uploads_stats_module_template_' . $this->get_name(), $template);

		// render the main template
		include_once($template);
	}

	/**
	 * Retrieve the module name.
	 *
	 * @access public
	 *
	 * @return string $name The module name.
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * Modify the module name.
	 *
	 * @access public
	 *
	 * @param string $name The new module name.
	 */
	public function set_name($name) {
		$this->name = $name;
	}

}