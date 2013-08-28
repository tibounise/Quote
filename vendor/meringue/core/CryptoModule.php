<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\core;

trait CryptoModule {
	public static function generateSalt() {
		return call_user_func(self::get('callback.saltGenerator'));
	}

	public static function generateToken() {
		return call_user_func(self::get('callback.tokenGenerator'));
	}

	public static function hash($hashedString,$salt) {
		return call_user_func_array(self::get('callback.hashGenerator'),array($hashedString,$salt));
	}
}

?>