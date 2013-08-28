<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\storage;

/**
 * Dictionnary extension for Meringue
 * 
 * @package meringue
 */
class Dictionnary {
	/**
	 * Stored variables
	 * 
	 * @access private
	 */
	private $_variables;

	/**
	 * Check if a key exists
	 * 
	 * @return boolean
	 * @param string $key Key to be tested
	 * @access public
	 */
	public function exists($key) {
		return isset($this->_variables[$key]);
	}

	/**
	 * Get a key's value
	 * 
	 * @param string $key Key
	 * @return mixed Value
	 * @access public
	 */
	public function get($key) {
		return $this->exists($key) ? $this->_variables[$key] : null;
	}

	/**
	 * Sets a value to a key
	 * 
	 * @param string $key Key
	 * @param mixed $value Value
	 * @access public
	 */
	public function set($key,$value) {
		$this->_variables[$key] = $value;
	}
}

?>