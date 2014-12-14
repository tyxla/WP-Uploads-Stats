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
	 * Constructor.
	 *	
	 * Initializes and hooks the plugin functionality.
	 *
	 * @access public
	 */
	public function __construct() {

	}

}

// initialize WP Uploads Stats
global $wp_uploads_stats;
$wp_uploads_stats = new WP_Uploads_Stats();