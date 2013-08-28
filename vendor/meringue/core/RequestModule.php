<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\core;

trait RequestModule {
	/**
	 * Factory for meringue's requests objects
	 * 
	 * @return Request Request object
	 * @access public
	 * @static
	 */
	public static function getRequest() {
		return \meringue\network\Request::getInstance();
	}
}

?>