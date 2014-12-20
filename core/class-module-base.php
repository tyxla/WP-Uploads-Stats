<?php
/**
 * Abstract base class for a WP_Uploads_Stats module.
 */
abstract class WP_Uploads_Stats_Module_Base {

	/**
	 * Constructor.
	 *	
	 * Initializes the module.
	 *
	 * @access public
	 */
	public function __construct() {

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
	abstract public function render();

}