<?php
/**
 * Directory Iterator class.
 *
 * Provides an implementation for traversing directories similar to
 * the SPL DirectoryIterator.
 */
class WP_Uploads_Stats_Directory_Iterator {

	/**
	 * The index of the current entry.
	 *
	 * @access protected
	 *
	 * @var int
	 */
	protected $key; 

	/**
	 * Whether directory contains more entries.
	 *
	 * @access protected
	 *
	 * @var bool
	 */
	protected $valid = true; 

	/**
	 * The current entry name, or false on failure.
	 *
	 * @access protected
	 *
	 * @var string|bool
	 */
	protected $entry; 
	
	/**
	 * The current path.
	 *
	 * @access protected
	 *
	 * @var string
	 */
	protected $path; 

	/**
	 * The current directory handle.
	 *
	 * @access protected
	 *
	 * @var resource
	 */
	protected $handle; 
	
	/** 
	 * Construct a directory iterator from a path-string. 
	 *
	 * @access public
	 * 
	 * @param string $path Directory to iterate. 
	 * @return WP_Uploads_Stats_Directory_Iterator
	 */ 
	public function __construct($path) {
		if (substr($path, strlen($path) - 1, 1) != '/') { 
			$path = $path . '/'; 
		} 
		
		$this->handle = opendir($path); 
		$this->path = $path; 
	} 
	
	/** 
	 * Retrieve the path that is currently open.
	 *
	 * @access public
	 *
	 * @return string $path The opened path. 
	 */ 
	public function get_path() { 
		return $this->path; 
	}    
	
	/** 
	 * Retrieve the current file name.
	 *
	 * @access public
	 *
	 * @return string $entry The current file name. 
	 */ 
	public function get_file_name() { 
		return $this->entry; 
	}    
	
	/** 
	 * Retrieve the current path, together with the file name.
	 *
	 * @access public
	 *
	 * @return string $full_path The current entries path and file name. 
	 */ 
	public function get_path_name() { 
		return $this->get_path() . $this->get_file_name(); 
	}    

	/** 
	 * Get the current entry's permissions.
	 *
	 * @access public
	 *
	 * @return int $perms The current entry's permissions. 
	 */ 
	public function get_perms() { 
		return fileperms($this->get_path_name()); 
	} 
	
	/** 
	 * Get the current entry's inode.
	 *
	 * @access public
	 *
	 * @return int $inode The current entry's inode. 
	 */ 
	public function get_inode() { 
		return fileinode($this->get_path_name()); 
	} 
	
	/** 
	 * Get the current entry size in bytes.
	 *
	 * @access public
	 *
	 * @return int $size The current entry's size in bytes. 
	 */ 
	public function get_size() { 
		return filesize($this->get_path_name()); 
	} 
	
	/** 
	 * Get the owner of the current entry.
	 *
	 * @access public
	 *
	 * @return string $owner The current entry's owner name. 
	 */ 
	public function get_owner() { 
		return fileowner($this->get_path_name()); 
	} 
	
	/** 
	 * Get the group of the current entry.
	 *
	 * @access public
	 *
	 * @return string $group The current entry's group name. 
	 */ 
	public function get_group() { 
		return filegroup($this->get_path_name()); 
	} 
	
	/** 
	 * Get the last access time of the current entry.
	 *
	 * @access public
	 *
	 * @return int $time The current entry's last access time. 
	 */ 
	public function get_atime() { 
		return fileatime($this->get_path_name()); 
	} 
	
	/** 
	 * Get the last modified time of the current entry.
	 *
	 * @access public
	 *
	 * @return int $time The current entry's last modification time. 
	 */ 
	public function get_mtime() { 
		return filemtime($this->get_path_name()); 
	} 
	
	/** 
	 * Get the current entry's last change time.
	 *
	 * @access public
	 *
	 * @return int $time The current entry's last change time. 
	 */ 
	public function get_ctime() { 
		return filectime($this->get_path_name()); 
	} 
	
	/** 
	 * Get the type of the current entry.
	 *
	 * @access public
	 *
	 * @return string $type The type of the current entry.
	 */ 
	public function get_type() { 
		return filetype($this->get_path_name()); 
	} 
	
	/** 
	 * Whether the current entry is writeable.
	 *
	 * @access public
	 *
	 * @return bool $writable Whether the current entry is writeable. 
	 */ 
	public function is_writable() { 
		return is_writable($this->get_path_name()); 
	} 
	
	/** 
	 * Whether the current entry is readable. 
	 *
	 * @access public
	 *
	 * @return bool $readable Whether the current entry is readable. 
	 */ 
	public function is_readable() { 
		return is_readable($this->get_path_name()); 
	} 
	
	/** 
	 * Whether the current entry is executable.
	 *
	 * @access public
	 *
	 * @return bool $executable Whether the current entry is executable. 
	 */ 
	public function is_executable() { 
		if (function_exists('is_executable')) { 
			return is_executable($this->get_path_name()); 
		}
		return false;
	} 
	
	/** 
	 * Whether the current entry is a file.
	 *
	 * @access public
	 *
	 * @return bool $is_file Whether the current entry is a file. 
	 */ 
	public function is_file() { 
		return is_file($this->get_path_name()); 
	} 
	
	/** 
	 * Whether the current entry is a directory.
	 *
	 * @access public
	 *
	 * @return bool $is_dir Whether the current entry is a directory.
	 */ 
	public function is_dir() { 
		return is_dir($this->get_path_name()); 
	}    
	
	/** 
	 * Whether the current entry is either '.' or '..'.
	 *
	 * @access public
	 *
	 * @return bool $is_dot Whether the current entry is either '.' or '..'. 
	 */ 
	public function is_dot() { 
		return $this->is_dir() && ($this->entry == '.' || $this->entry == '..'); 
	}    
	
	/** 
	 * Whether the current entry is a link. 
	 *
	 * @access public
	 *
	 * @return bool $is_link Whether the current entry is a link.
	 */ 
	public function is_link() { 
		return is_link($this->get_path_name()); 
	}        

	/** 
	 * Move to next entry.
	 *
	 * @access public
	 */                  
	public function next() { 
		$this->valid = $this->get_file(); 
		$this->key++; 
	} 
	
	/** 
	 * Rewind directory back to the start.
	 *
	 * @access public
	 */            
	public function rewind() { 
		$this->key = 0; 
		rewinddir($this->handle); 
		$this->valid = $this->get_file(); 
	} 
	
	/** 
	 * Check whether directory contains more entries.
	 *
	 * @access public
	 *
	 * @return bool $valid Whether the directory contains more entries.
	 */            
	public function valid() { 
		if ($this->valid === false) { 
			$this->close(); 
		} 
		
		return $this->valid; 
	} 
	
	/** 
	 * Return current directory entry key.
	 *
	 * @access public
	 *
	 * @return int $key The current directory entry key.
	 */            
	public function key() { 
		return $this->key; 
	} 
	
	/** 
	 * Return this.
	 *
	 * @access public
	 *
	 * @return WP_Uploads_Stats_Directory_Iterator
	 */        
	public function current() {            
		return $this; 
	} 
	
	/** 
	 * Close the current directory.
	 *
	 * @access public
	 */            
	public function close() { 
		closedir($this->handle); 
	}        
	
	/** 
	 * Check if the current file/directory can be read, and read it (if possible).
	 *
	 * @access public
	 *
	 * @return bool $readable Whether the file/directory is readable.
	 */
	public function get_file() { 
		if ( false !== ($file = readdir($this->handle)) ) { 
			$this->entry = $file; 
			return true; 
		} else { 
			return false; 
		} 
	}        
}    