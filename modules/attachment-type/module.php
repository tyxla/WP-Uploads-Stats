<?php
/**
 * Class for the stats Attachment Type module.
 */
class WP_Uploads_Stats_Module_Attachment_Type extends WP_Uploads_Stats_Module_Base {

	/**
	 * Setup & configure the module.
	 *
	 * @access public
	 */
	public function setup() {
		$data = array();

		// get all attachment extensions & totals
		global $wpdb;
		$attachment_data = $wpdb->get_results("
			SELECT COUNT(ID) as total, SUBSTRING_INDEX(guid, '.', -1) as extension
			FROM $wpdb->posts
			WHERE post_type = 'attachment'
			GROUP BY extension
			ORDER BY total DESC
		");

		// prepare module data
		foreach ($attachment_data as $entry) {
			$extension = $entry->extension;

			// JPEG is treated as JPG for less confusion
			if ($extension === 'jpeg') {
				$extension = 'jpg';
			}

			if (!isset($data[$extension])) {
				$data[$extension] = 0;
			}

			$data[$extension] += $entry->total;
		}

		// sort by number of attachments, descending
		arsort($data);

		// distribute data to module
		$this->set_data($data);
	}

}