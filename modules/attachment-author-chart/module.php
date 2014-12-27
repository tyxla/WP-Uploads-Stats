<?php
/**
 * Class for the stats Attachments by Author Chart module.
 * @uses WP_Uploads_Stats_Module_Attachment_Author
 */
class WP_Uploads_Stats_Module_Attachment_Author_Chart extends WP_Uploads_Stats_Module_Attachment_Author {

	/**
	 * Setup & configure the module.
	 *
	 * @access public
	 */
	public function setup() {

		// use the parent's setup to generate the data
		parent::setup();

		// prepare data for use in the Chart.js format
		$new_data = array();
		$data = $this->get_data();
		foreach ($data as $id => $number) {
			// generate a somewhat unique color 
			$color = substr(md5($id), 2, 6);

			// generate pie slice
			$new_data[] = array(
				'value' => intval($number),
				'label' => get_the_author_meta('display_name', $id),
				'color' => '#' . $color
			);
		}

		// apply the new data to the module
		$this->set_data($new_data);
	}

}