<?php 
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\monitoring;

/**
 * The FileMonitor class handle monitoring of the files
 * used by the project
 * 
 * @package meringue
 */
class FileMonitor {
	/**
	 * Returns all the files imported by require()/include()
	 * 
	 * @return array Files included
	 * @access public
	 * @static
	 */
	public static function getIncludedFiles() {
		return get_included_files();
	}

	/**
	 * Returns the disk space available for a specific
	 * folder (default : .)
	 * 
	 * @param string $directory Directory
	 * @return int Size remaining in bytes
	 * @access public
	 * @static
	 */
	public static function getFreeSpace($directory = '.') {
		return disk_free_space($directory);
	}
}

?>