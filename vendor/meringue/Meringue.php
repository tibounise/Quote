<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

require __DIR__.'/core/CoreLoader.php';

\meringue\core\CoreLoader::init();

/**
 * Meringue kernel
 * 
 * @version 1.0ß
 * @package meringue
 */
class Meringue {
	// Import kernel modules
    use meringue\core\RenderModule;
    use meringue\core\JsonModule;
    use meringue\core\RequestModule;
    use meringue\core\RouterModule;
    use meringue\core\ExtLoaderModule;
    use meringue\core\CryptoModule;
    use meringue\core\DictionnaryModule;

	// Disable instantiation as an object
    /**
     * Constructor
     * 
     * @access private
     */
	private function __construct() {}

    /**
     * Clone method
     * 
     * @access private
     */
    private function __clone() {}

    /**
     * Initialise the framework
     * 
     * @param boolean $withSessions Enable sessions
     * @access public
     * @static
     */
    public static function init($withSessions = true) {
        self::$_dictionnary = new meringue\storage\Dictionnary;
        self::$_router = new meringue\network\Router;

        if ($withSessions && !isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * Start the framework
     * 
     * @access public
     * @static
     */
    public static function start() {
    	self::_startRouter();
    }
}

Meringue::init();

require __DIR__.'/MeringueConf.php';

?>  