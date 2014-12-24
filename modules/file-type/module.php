<?php
/**
 * Class for the stats File Type module.
 */
class WP_Uploads_Stats_Module_File_Type extends WP_Uploads_Stats_Module_Base {

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
		$data = $iterator->get_files_by_type();

		// distribute data to module
		$this->set_data($data);
	}

}