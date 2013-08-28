<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\locale;

/**
 * The i18n class is responsible for locales management.
 * 
 * @package meringue
 */
class i18n {
    /**
     * Locales array
     * 
     * @var array
     * @access private
     * @static
     */
	private static $_locales = null;

    /**
     * Constructor
     * 
     * @access private
     */
	private function __construct() {} // Disable instantiation as an object

    /**
     * Get a locale value
     * 
     * @return string Locale value
     * @param string $localeIdentifier Locale identifier
     * @access public
     * @static
     */
    public static function get($localeIdentifier) {
    	return isset(self::$_locales[$localeIdentifier]) ? self::$_locales[$localeIdentifier] : null;
    }

    /**
     * Loads a locale from an array
     * 
     * @param string $localesArray Locale array
     * @access public
     * @static
     */
    public static function load($localesArray) {
    	self::$_locales = $localesArray;
    }

    /**
     * Loads a locale from a JSON file
     * 
     * @param string $filepath Path to the file
     * @access public
     * @static
     */
    public static function loadJson($filepath) {
		$locales = json_decode(file_get_contents($filepath),true);

		if ($locales !== null) self::$_locales = $locales;
    }
}

?>