<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\core;

trait RenderModule {
	public static function render($template,$variables = array()) {
		if (self::exists('meringue.render.path') && file_exists(self::get('meringue.render.path').'/'.$template)) {
			call_user_func_array(self::get('callback.render'),[
				(self::get('meringue.render.path').'/'.$template),
				$variables
			]);
		} else {
			call_user_func_array(self::get('callback.render'),[
				$template,
				$variables
			]);
		}
	}
}

?>