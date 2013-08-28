<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\network;

/**
 * HTTP response
 * 
 * @version 1.0ß
 * @package meringue
 */
class Response {
    /**
     * HTTP response codes
     * 
     * @var array Response codes
     */
	public static $codes = [
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',

        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',

        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',

        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported'
    ];

    private $_body = '';
    private $_headers = array();

    public function status($code) {
        if (array_key_exists($code,self::$codes)) {
            if (strpos(php_sapi_name(), 'cgi') !== false) { // Check for CGI
                header('Status: '.$code.' '.self::$codes[$code],
                       true);
            } else {
                header(getenv('SERVER_PROTOCOL') ?: 'HTTP/1.1'.' '.$code.' '.self::$codes[$code],
                       true,
                       $code);
            }
        } else {
            throw new \Exception('Error code not found');
        }

        return $this;
    }

    public function header($header,$value) {
        $this->_headers[$header] = $value;

        return $this;
    }

    public function cache($expiration = false) {
        if ($expiration === false) {
            $this->header('Expires','Mon, 26 Jul 1997 05:00:00 GMT');
            $this->header('Cache-Control',array(
                'no-store, no-cache, must-revalidate',
                'post-check=0, pre-check=0',
                'max-age=0'
            ));
            $this->header('Pragma','no-cache');
        } else {
            $this->header('Expires',gmdate('D, d M Y H:i:s',$expiration).' GMT');
            $this->header('Cache-Control','max-age='.($expiration-time()));
        }
    }

    public function write($data) {
        $this->_body .= $data;

        return $this;
    }

    public function send() {
        if (ob_get_length() > 0)
            ob_end_clean(); // Clean existing data

        if (!headers_sent()) {
            foreach ($this->_headers as $header => $value) {
                if (is_array($value)) {
                    foreach ($value as $val) {
                        header($header.': '.$val);
                    }
                } else {
                    header($header.': '.$value);
                }
            }
        }

        echo $this->body;
    }
}

?>