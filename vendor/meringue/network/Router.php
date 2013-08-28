<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\network;

/**
 * Router object
 * 
 * @package meringue
 */
class Router {
	/**
	 * Routes
	 * 
	 * @access private
	 */
	private $_routes = array();

	/**
	 * Add a route
	 * 
	 * @param string $schema URL to be routed
	 * @param callback $callback Callback to execute when the URL is matched
	 * @return boolean Route callable
	 * @access public
	 */
	public function route($schema,$callback) {
		if (is_callable($callback)) {
			$this->_routes[] = new \meringue\network\Route($schema,$callback);
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Adds multiple routes from a json file
	 * 
	 * @param string $jsonPath Path of the JSON file
	 * @access public
	 */
	public function routeFromJson($jsonPath) {
		$routesArray = \meringue\storage\Json::loadJson($jsonPath);

		foreach ($routesArray as $route) {
			if (!$this->route($route['schema'],$route['callback'])) {
				throw new \Exception('Invalid callback');
			}
		}
	}

	/**
	 * Start the router
	 * 
	 * @access public
	 */
	public function startRouter() {
		$request = \meringue\network\Request::getInstance();

		foreach ($this->_routes as &$route) {
			if ($route->matchUrl($request->url) && $route->matchMethod($request->method)) {
				$route->runCallback();
				return;
			}
		}

		if (\Meringue::get('callback.notFound') !== null and is_callable(\Meringue::get('callback.notFound'))) {
			call_user_func(\Meringue::get('callback.notFound'));
		}
	}
}

?>