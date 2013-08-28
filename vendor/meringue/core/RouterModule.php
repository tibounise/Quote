<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\core;

trait RouterModule {
	private static $_router = null;

	public static function route($schema,$callback) {
		return self::$_router->route($schema,$callback);
	}

	public static function routeFromJson($jsonPath) {
		self::$_router->routeFromJson($jsonPath);
	}

	private static function _startRouter() {
		self::$_router->startRouter();
	}
}

?>