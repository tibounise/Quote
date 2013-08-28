<?php

namespace Quote\Error;

class Controller {
	public static function fourHundredFourAction() {
		\Meringue::render('error.php',[
			'message' => 'Page not found :('
		]);
	}
}

?>