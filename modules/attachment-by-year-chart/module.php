<?php
/**
 * Class for the stats Attachment by Year Chart module.
 * @uses WP_Uploads_Stats_Module_Attachment_By_Year
 */
class WP_Uploads_Stats_Module_Attachment_By_Year_Chart extends WP_Uploads_Stats_Module_Attachment_By_Year {

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
		foreach ($data as $year => $count) {
			// generate a somewhat unique color 
			$color = substr(md5($year), 2, 6);

			// generate pie slice
			$new_data[] = array(
				'value' => intval($count),
				'label' => $year . ': ' . $count,
				'color' => '#' . $color
			);
		}

		// apply the new data to the module
		$this->set_data($new_data);
	}

}