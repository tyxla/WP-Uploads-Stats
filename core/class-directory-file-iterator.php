<?php
/**
 * Perform general operations on directories and files
 */
class WP_Uploads_Stats_Directory_File_Iterator {

	/**
	 * Contains the current iterator path.
	 *
	 * @access protected
	 *
	 * @var string
	 */
	protected $path = '';

	/**
	 * Constructor.
	 *	
	 * Initializes the iterator with a certain directory/file path.
	 *
	 * @access public
	 *
	 * @param string $path The directory/file path to iterate.
	 */
	public function __construct($path) {
		$this->set_path($path);
	}

	/**
	 * Retrieve the current directory/file path.
	 *
	 * @access public
	 *
	 * @return string $path The current directory/file path.
	 */
	public function get_path() {
		return $this->path;
	}

	/**
	 * Modify the registered path.
	 *
	 * @access public
	 *
	 * @param string $path The new directory/file path.
	 */
	public function set_path($path = array()) {
		$this->path = $path;
	}

	/**
	 * Get all directories and files within the current directory.
	 *
	 * @access public
	 *
	 * @return array $entries All files and directories within the current directory.
	 */
	public function get_entries() {
		$path = $this->get_path();

		if (is_file($path)) {
			return array();
		} 

		$entries = array();

		// find all non-dot files/directories and save them to the entry list
		if ($dir = opendir($path)) {
			while (false !== ($file = readdir($dir))) {
				if ($file != "." && $file != "..") {
					$file_path = $path . DIRECTORY_SEPARATOR . $file;
					$entries[] = $file_path;
				}
			}
			closedir($dir);
		}

		return $entries;
	}

	/**
	 * Get the size of the current file/directory.
	 *
	 * @access public
	 *
	 * @return int $size The total size of the current directory/file.
	 */
	public function get_size() {
		$path = $this->get_path();

		// if this is a file, get its size
		if (is_file($path)) {
			return filesize($path);
		} 

		$total_size = 0;

		// recursively get the size of all directories
		$entries = $this->get_entries();
		foreach ($entries as $entry) {
			$entry_iterator = new WP_Uploads_Stats_Directory_File_Iterator($entry);
			$total_size += $entry_iterator->get_size();
		}

		return $total_size;
	}

	/**
	 * Get the number of files of the current directory.
	 *
	 * @access public
	 *
	 * @return int $number The total number of files in the current directory.
	 */
	public function get_file_number() {
		$path = $this->get_path();

		// if this is a single file
		if (is_file($path)) {
			return 1;
		}

		$file_number = 0;

		// get number of files recursively within the current directory
		$entries = $this->get_entries();
		foreach ($entries as $entry) {
			$entry_iterator = new WP_Uploads_Stats_Directory_File_Iterator($entry);
			$file_number += $entry_iterator->get_file_number();
		}

		return $file_number;
	}

	/**
	 * Get the number of directories within the current directory.
	 *
	 * @access public
	 *
	 * @return int $number The total number of directories within the current directory.
	 */
	public function get_directory_number() {
		$path = $this->get_path();
		$dir_number = 0;

		// if this is a directory, count it
		if (is_dir($path)) {
			$dir_number++;
		}

		// get number of directories recursively within the current directory
		$entries = $this->get_entries();
		foreach ($entries as $entry) {
			$entry_iterator = new WP_Uploads_Stats_Directory_File_Iterator($entry);
			$dir_number += $entry_iterator->get_directory_number();
		}

		return $dir_number;
	}

	/**
	 * Get number of files by file type.
	 *
	 * @access public
	 *
	 * @return array $files The total number of files, classified by file type.
	 */
	public function get_files_by_type() {
		$path = $this->get_path();
		$by_type = array();

		// if this is a file, count it
		if (is_file($path)) {
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$by_type = $this->add_file_by_type_number($by_type, $ext, 1);
		} else {
			// get files by type within the current directory, recursively
			$entries = $this->get_entries();
			foreach ($entries as $entry) {

				// get files by type in the current directory
				$entry_iterator = new WP_Uploads_Stats_Directory_File_Iterator($entry);
				$entry_by_type = $entry_iterator->get_files_by_type();

				// add the found files by type to the totals
				foreach ($entry_by_type as $type => $value) {
					$by_type = $this->add_file_by_type_number($by_type, $type, $value);
				}
			}
		}

		return $by_type;
	}

	/**
	 * Add a certain amount to a certain file type to the totals.
	 *
	 * @access public
	 *
	 * @param array $totals The total number of files before the update.
	 * @param string $type The file type (extension).
	 * @param int $value The total number of files to add of that type.
	 * @return array $totals The updated total number of files, classified by file type.
	 */
	private function add_file_by_type_number($totals, $type, $value = 1) {
		// JPEG should be counted as JPG to reduce confusion
		if ($type == 'jpeg') {
			$type = 'jpg';
		}

		// make sure the array key for that type is defined
		if (!isset($totals[$type])) {
			$totals[$type] = 0;
		}

		// increase the total by the passed value
		$totals[$type] += $value;
		
		return $totals;
	}
}