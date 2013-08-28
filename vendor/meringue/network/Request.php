<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\network;

/**
 * HTTP request
 * 
 * @package meringue
 */
class Request {
	/**
	 * Request instance
	 * 
	 * @var Request Request instance
	 * @access private
	 * @static
	 */
	private static $_instance = null;

	/**
	 * Request URL
	 * 
	 * @var string $url Request URL
	 * @access public
	 */
	public $url;

	/**
	 * Request method
	 * 
	 * @var string Request method
	 * @access public
	 */
	public $method;

	/**
	 * Request referer
	 * 
	 * @var string Request referrer
	 * @access public
	 */
	public $referrer;

	/**
	 * Client IP
	 * 
	 * @var string Client IP
	 * @access public
	 */
	public $ip;

	/**
	 * URL base
	 * 
	 * @var string URL base
	 * @access public
	 */
	public $base;

	/**
	 * Ajax status
	 * 
	 * @var boolean Ajax status
	 * @access public
	 */
	public $ajax;

	/**
	 * Request scheme
	 * 
	 * @var string Request scheme
	 * @access public
	 */
	public $scheme;

	/**
	 * Client user-agent
	 * 
	 * @var string User-agent
	 * @access public
	 */
	public $user_agent;

	/**
	 * Request body
	 * 
	 * @var mixed Request body
	 * @access public
	 */
	public $body;

	/**
	 * Request type
	 * 
	 * @var string Request type
	 * @access public
	 */
	public $type;

	/**
	 * Request length
	 * 
	 * @var int Request length
	 * @access public
	 */
	public $length;

	/**
	 * Request query (GET field)
	 * 
	 * @var array Request query
	 * @access public
	 */
	public $query;

	/**
	 * HTTPS status
	 * 
	 * @var boolean HTTPS status
	 * @access public
	 */
	public $secure;

	/**
	 * HTTP accept
	 * 
	 * @var string HTTP accept
	 * @access public
	 */
	public $accept;

	/**
	 * Fill all the HTTP fields
	 * 
	 * @access private
	 */
	private function __construct() {
		$this->url = getenv('REQUEST_URI') ?: '/';
		$this->method = getenv('REQUEST_METHOD') ?: 'GET';
		$this->referrer = getenv('HTTP_REFERER') ?: '';
		$this->ip = getenv('REMOTE_ADDR') ?: '';
        $this->base = str_replace('\\', '/', dirname(getenv('SCRIPT_NAME')));
        $this->ajax = getenv('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest';
        $this->scheme = getenv('SERVER_PROTOCOL') ?: 'HTTP/1.1';
        $this->user_agent = getenv('HTTP_USER_AGENT') ?: '';
        $this->body = file_get_contents('php://input');
        $this->type = getenv('CONTENT_TYPE') ?: '';
        $this->length = getenv('CONTENT_LENGTH') ?: 0;
        $this->query = $_GET;
        $this->secure = getenv('HTTPS') && getenv('HTTPS') != 'off';
        $this->accept = getenv('HTTP_ACCEPT') ?: '';

        if ($this->base != '/' && strlen($this->base) > 0 && strpos($this->url, $this->base) === 0) {
            $this->url = substr($this->url, strlen($this->base));
        }

        if (!empty($this->url)) {
            $_GET += self::parseQuery($this->url);

            $this->query = $_GET;
        }
	}

	/**
	 * Returns Request instance
	 * 
	 * @return Request Request instance
	 * @access public
	 * @static
	 */
	public static function getInstance() {
		if (self::$_instance === null) {
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	/**
	 * Parse the url query
	 * 
	 * @param string $url URL
	 * @return array Query
	 * @access public
	 * @static
	 */
	public static function parseQuery($url) {
		$params = array();

        $args = parse_url($url);
        if (isset($args['query'])) {
            parse_str($args['query'], $params);
        }

        return $params;
	}
}

?>