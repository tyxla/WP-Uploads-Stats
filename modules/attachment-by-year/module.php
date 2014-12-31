<?php
/**
 * Class for the stats Attachment by Year module.
 */
class WP_Uploads_Stats_Module_Attachment_By_Year extends WP_Uploads_Stats_Module_Base {

	/**
	 * Setup & configure the module.
	 *
	 * @access public
	 */
	public function setup() {
		$data = array();

		// get all attachment years & totals
		global $wpdb;
		$attachment_data = $wpdb->get_results("
			SELECT COUNT(ID) AS total, YEAR(post_date) AS year
			FROM $wpdb->posts
			WHERE post_type = 'attachment'
			GROUP BY year
			ORDER BY total DESC
		");

		// prepare module data
		foreach ($attachment_data as $entry) {
			$data[$entry->year] = $entry->total;
		}

		// sort by size, descending
		arsort($data);

		// distribute data to module
		$this->set_data($data);
	}

}