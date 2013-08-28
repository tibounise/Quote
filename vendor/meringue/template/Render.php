<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\template;

/**
 * A simple Render for PHP template
 * 
 * @package meringue
 */
class Render implements RenderInterface {
	/**
	 * Render a PHP template
	 * 
	 * @param string $template Path
	 * @param array $variables Variables
	 * @access public
	 * @static
	 */
	public static function render($template,$variables) {
		extract($variables);
		require $template;
	}
}

?>