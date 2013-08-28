<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\security;

/**
 * Cryptography class intended to improve security.
 * 
 * @package meringue
 */
class Crypto {
	/**
	 * Generates a salt using OpenSSL module
	 * 
	 * @return string Salt
	 * @access public
	 * @static
	 */
	public static function OpenSSLSaltGenerator() {
		if (extension_loaded('OpenSSL')) {
			return base64_encode(openssl_random_pseudo_bytes(66));
		} else {
			throw new Exception('OpenSSL extension not installed');
		}
	}

	/**
	 * Generates a salt using uniqid() (not good)
	 * 
	 * @return string Salt
	 * @access public
	 * @static
	 */
	public static function basicSaltGenerator() {
		return uniqid('',true);
	}

	/**
	 * Generates a 24 char token using mt_rand()
	 * 
	 * @return string Token
	 * @access public
	 * @static
	 */
	public static function basicTokenGenerator() {
		return substr(md5(mt_rand()*20),0,24);
	}

	/**
	 * Generates a hash using the pbkdf2 algorythm
	 * 
	 * @param string $hashed String to be hashed
	 * @param string $salt Salt
	 * @return string Hashed string
	 * @access public
	 * @static
	 */
	public static function pbkdf2HashGenerator($hashed,$salt) {
		if (function_exists('hash_pbkdf2')) {
			return hash_pbkdf2('sha256',$hashed,$salt,0xFFFF); // 65536 iterations
		} else {
			throw new Exception('Native pbkdf2 function not available');
		}
	}

	/**
	 * Generates a hash using crypt() function
	 * 
	 * @param string $hashed String to be hashed
	 * @param string $salt Salt
	 * @return string Hashed string
	 * @access public
	 * @static
	 */
	public static function cryptHashGenerator($hashed,$salt) {
		return crypt($hashed,'$6$rounds=65536$'.$salt.'$');
	}
}

?>