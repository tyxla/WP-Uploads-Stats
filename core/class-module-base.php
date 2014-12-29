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
	 * Module data.
	 *
	 * @access protected
	 *
	 * @var array
	 */
	protected $data;

	/**
	 * Constructor.
	 *	
	 * Initializes the module.
	 *
	 * @access public
	 *
	 * @param string $name The module name.
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
	 * @access public
	 */
	public function render() {
		global $wp_uploads_stats;

		// define the module so the template can reach it
		$wp_uploads_module = $this;

		// determine the main template
		$template = $wp_uploads_stats->get_plugin_path() . '/templates/module-' . $this->get_name() . '.php';
		$template = apply_filters('wp_uploads_stats_module_template_' . $this->get_name(), $template);

		// render the main template
		include_once($template);
	}

	/**
	 * Render the module head section.
	 *
	 * @access public
	 * 
	 * @param string $title The module title.
	 */
	public function render_head($title) {
		?>
		<div class="module-head">
			<h3><?php echo $title; ?></h3>
			<a href="#" class="wpus-icon dashicons dashicons-minus toggle"></a>
			<a href="#" class="wpus-icon dashicons dashicons-screenoptions drag-handle"></a>
		</div>
		<?php
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

	/**
	 * Retrieve the module data.
	 *
	 * @access public
	 *
	 * @return array $data The module data.
	 */
	public function get_data() {
		return $this->data;
	}

	/**
	 * Modify the module data.
	 *
	 * @access public
	 *
	 * @param array $data The new module data.
	 */
	public function set_data($data) {
		$this->data = $data;
	}

}