<?php
/**
 * Class for the stats File Type Chart module.
 * @uses WP_Uploads_Stats_Module_File_Type
 */
class WP_Uploads_Stats_Module_File_Type_Chart extends WP_Uploads_Stats_Module_File_Type {

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
		foreach ($data as $extension => $number) {
			// generate a somewhat unique color 
			$color = substr(md5($extension), 1, 6);

			// generate pie slice
			$new_data[] = array(
				'value' => intval($number),
				'label' => $extension,
				'color' => '#' . $color
			);
		}

		// apply the new data to the module
		$this->set_data($new_data);
	}

}