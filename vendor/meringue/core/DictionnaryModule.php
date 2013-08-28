<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\core;

trait DictionnaryModule {
	private static $_dictionnary = null;

	public static function exists($key) {
		return self::$_dictionnary->exists($key);
	}

	public static function get($key) {
		return self::$_dictionnary->get($key);
	}

	public static function set($key,$value) {
		self::$_dictionnary->set($key,$value);
	}
}

?>