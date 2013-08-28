<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\loader;

/**
 * The ExtLoader is a loader for external libraries
 */
class ExtLoader {
	/**
	 * Registered paths
	 *
	 * @var array
	 * @access private
	 */
	private $_loadPaths = array();

	/**
	 * Register the loader to the SPL register
	 * 
	 * @access public
	 */
	public function __construct() {
		spl_autoload_register(array(__CLASS__,'load'));
	}

	/**
	 * Adding a path to be loaded
	 * 
	 * @param string $path Path to the directory
	 * @access public
	 */
	public function addPath($path) {
		if (substr($path,-1) != '/') {
			$path .= '/';
		}

		$this->_loadPaths[] = $path;
	}

	/**
	 * Loads a specified class/interface
	 * 
	 * @param string $itemName Name of the class or interface
	 * @access public
	 */
	public function load($itemName) {

		foreach ($this->_loadPaths as $path) {
			$finalPath = $path.str_replace('\\', '/',$itemName).'.php';

			if (file_exists($finalPath))
				include $finalPath;
		}
	}
}

?>