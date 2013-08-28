<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\template;

interface RenderInterface {
	/**
	 * Render a template
	 * 
	 * @param string $template Path
	 * @param array $variables Variables
	 * @access public
	 * @static
	 */
	public static function render($template,$variables);
}

?>