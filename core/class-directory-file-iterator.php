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

		if (is_file($path)) {
			return filesize($path);
		} 

		$total_size = 0;

		$entries = $this->get_entries();
		foreach ($entries as $entry) {
			$entry_iterator = new WP_Uploads_Stats_Directory_File_Iterator($entry);
			$total_size += $entry_iterator->get_size();
		}

		return $total_size;
	}

}