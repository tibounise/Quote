<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\core;

/**
 * The CoreLoader class loads the classes and the interfaces of Meringue
 * dynamically.
 * 
 * @package meringue
 */
class CoreLoader {
	/**
	 * Register the CoreLoader to the spl autoload register
	 * 
	 * @access public
	 * @static
	 */
	public static function init() {
		spl_autoload_register([__CLASS__,'load']);
	}

	/**
	 * Loads a class/interface
	 * 
	 * @param string $itemName name of the class/interface
	 * @access public
	 * @static
	 */
	public static function load($itemName) {
		$requestedFile = __DIR__.'/../../'.str_replace('\\', '/',$itemName).'.php';

		if (file_exists($requestedFile)) {
			include $requestedFile;
		}
	}
}

?>