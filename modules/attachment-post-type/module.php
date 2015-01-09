<?php
/**
 * Class for the stats Attachment by Post Type module.
 */
class WP_Uploads_Stats_Module_Attachment_Post_Type extends WP_Uploads_Stats_Module_Base {

	/**
	 * Setup & configure the module.
	 *
	 * @access public
	 */
	public function setup() {
		$data = array();

		// get all post types & attachment totals
		global $wpdb;
		$attachment_data = $wpdb->get_results("
			SELECT COUNT(attachments.ID) AS count, parents.post_type AS post_type
			FROM $wpdb->posts AS attachments
			LEFT JOIN $wpdb->posts AS parents
			ON attachments.post_parent = parents.ID
			WHERE attachments.post_type = 'attachment'
			GROUP BY parents.post_type
			ORDER BY count DESC
		");

		// prepare data in flat format
		foreach ($attachment_data as $result) {
			$post_type = $result->post_type;
			if (empty($post_type)) {
				$post_type = 'None (Unattached)';
			}

			$data[$post_type] = $result->count;
		}

		// distribute data to module
		$this->set_data($data);
	}

}