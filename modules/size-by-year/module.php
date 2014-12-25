<?php
/**
 * Class for the stats Size by Year module.
 */
class WP_Uploads_Stats_Module_Size_By_Year extends WP_Uploads_Stats_Module_Base {

	/**
	 * Setup & configure the module.
	 *
	 * @access public
	 */
	public function setup() {
		$data = array();

		// initialize the iterator
		$wp_uploads_dir = wp_upload_dir();
		$iterator = new WP_Uploads_Stats_Directory_File_Iterator($wp_uploads_dir['basedir']);

		// get year directories and their total size
		$data = array();
		$entries = $iterator->get_entries();
		foreach ($entries as $entry) {
			$year = basename($entry);
			if (preg_match('~^\d{4}$~', $year)) {
				$directory_iterator = new WP_Uploads_Stats_Directory_File_Iterator($entry);
				$data[$year] = size_format($directory_iterator->get_size());
			}
		}

		// sort by size, descending
		arsort($data);

		// distribute data to module
		$this->set_data($data);
	}

}