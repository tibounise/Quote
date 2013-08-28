<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\core;

trait ExtLoaderModule {
	private static $_extLoader = null;

	public static function load($path) {
		if (self::$_extLoader === null) {
			self::$_extLoader = new \meringue\loader\ExtLoader;
		}

		self::$_extLoader->addPath($path);
	}
}

?>