<?php
/**
 * Class for the stats Overview module.
 */
class WP_Uploads_Stats_Module_Overview extends WP_Uploads_Stats_Module_Base {

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

		// get total size
		$data['total_size'] = size_format($iterator->get_size());

		// get number of files
		$data['total_files'] = $iterator->get_file_number();

		// get number of directories - 1 (main uploads directory excluded)
		$data['total_directories'] = $iterator->get_directory_number() - 1;

		// distribute data to module
		$this->set_data($data);
	}

	/**
	 * The labels of the data rows.
	 *
	 * @access public
	 */
	public function get_data_labels() {
		return array(
			'total_size' => 'Total Size',
			'total_files' => 'Total Number of Files',
			'total_directories' => 'Total Number of Directories',
		);
	}

}