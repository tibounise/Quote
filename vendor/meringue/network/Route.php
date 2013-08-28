<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\network;

/**
 * Route object
 * 
 * @package meringue
 */
class Route {
    /**
     * Pattern to match the URL
     * 
     * @access public
     */
	public $pattern;

    /**
     * Callback to execute
     * 
     * @access public
     */
	public $callback;

    /**
     * Methods to match
     * 
     * @access public
     */
	public $methods = array();

    public $params = array();

    /**
     * Constructor
     * 
     * @param string $schema URL schema
     * @param callback $callback Callback
     * @access public
     */
	public function __construct($schema,$callback) {
		$this->callback = $callback;

		if (strpos($schema,' ') !== false) {
			list($method,$pattern) = explode(' ',trim($schema),2);

			$this->methods = explode('|',$method);
            $this->pattern = $pattern;
		} else {
			$this->methods = ['*'];
            $this->pattern = $schema;
		}
	}

    /**
     * Checks for url match
     * 
     * @return boolean Matching status
     * @param string $url URL
     * @access public
     */
	public function matchUrl($url) {
        // Rapid pattern return
		if ($url === '*' || $url === $this->pattern) return true;

		$ids = array();
        $this->pattern = str_replace(array(')','*'), array(')?','.*?'), $this->pattern);

        // Build the regex for matching
        $regex = preg_replace_callback(
            '#@([\w]+)(:([^/\(\)]*))?#',
            function($matches) use (&$ids) {
                $ids[$matches[1]] = null;
                if (isset($matches[3])) {
                    return '(?P<'.$matches[1].'>'.$matches[3].')';
                }
                return '(?P<'.$matches[1].'>[^/\?]+)';
            },
            $this->pattern
        );

        // Fix trailing slash
        $regex .= (substr($this->pattern, -1) === '/') ? '?' : '/?';

        // Attempt to match route and named parameters
        if (preg_match('#^'.$regex.'(?:\?.*)?$#i', $url, $matches)) {
            foreach ($ids as $k => $v) {
                $this->params[$k] = (array_key_exists($k, $matches)) ? urldecode($matches[$k]) : null;
            }

            return true;
        } else {
            return false;
        }
	}

    /**
     * Checks for matching method
     * 
     * @return boolean Matching status
     * @param string $method Request method
     * @access public
     */
	public function matchMethod($method) {
        return count(array_intersect(array($method, '*'), $this->methods)) > 0;
    }

    /**
     * Run the callback
     * 
     * @access public
     */
    public function runCallback() {
        return call_user_func_array($this->callback,$this->params);
    }
}

?>