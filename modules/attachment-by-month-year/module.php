<?php
/**
 * Class for the stats Attachment by Month/Year module.
 */
class WP_Uploads_Stats_Module_Attachment_By_Month_Year extends WP_Uploads_Stats_Module_Base {

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
			SELECT COUNT(ID) AS total, YEAR(post_date) AS year, MONTH(post_date) as month
			FROM $wpdb->posts
			WHERE post_type = 'attachment'
			GROUP BY year, month
			ORDER BY year DESC, month DESC
		");

		// prepare module data
		foreach ($attachment_data as $entry) {
			if ( !isset($data[$entry->year]) ) {
				$data[$entry->year] = array();
			}

			$data[$entry->year][$entry->month] = $entry->total;
		}

		// distribute data to module
		$this->set_data($data);
	}

}