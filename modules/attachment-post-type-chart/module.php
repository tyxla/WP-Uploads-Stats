<?php
/**
 * Class for the stats Attachments by Post Type Chart module.
 * @uses WP_Uploads_Stats_Module_Attachment_Post_Type
 */
class WP_Uploads_Stats_Module_Attachment_Post_Type_Chart extends WP_Uploads_Stats_Module_Attachment_Post_Type {

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
		foreach ($data as $post_type => $number) {
			// generate a somewhat unique color 
			$color = substr(md5($post_type), 3, 6);

			// generate pie slice
			$new_data[] = array(
				'value' => intval($number),
				'label' => $post_type,
				'color' => '#' . $color
			);
		}

		// apply the new data to the module
		$this->set_data($new_data);
	}

}