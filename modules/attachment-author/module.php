<?php
/**
 * Class for the stats Attachment Author module.
 */
class WP_Uploads_Stats_Module_Attachment_Author extends WP_Uploads_Stats_Module_Base {

	/**
	 * Setup & configure the module.
	 *
	 * @access public
	 */
	public function setup() {
		$data = array();

		// get all attachment authors & totals
		global $wpdb;
		$attachment_data = $wpdb->get_results("
			SELECT COUNT(ID) AS total, post_author AS author
			FROM $wpdb->posts
			WHERE post_type = 'attachment'
			GROUP BY author
			ORDER BY total DESC
		");

		// prepare module data
		foreach ($attachment_data as $entry) {
			$data[$entry->author] = $entry->total;
		}

		// sort by number of attachments, descending
		arsort($data);

		// distribute data to module
		$this->set_data($data);
	}

}