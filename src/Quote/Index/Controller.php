<?php

namespace Quote\Index;

class Controller {
	public static function pickRandomQuoteAction() {
		$quotes = \Meringue::loadJson(__APPROOT__.'/app/data/quotes.json');

		\Meringue::render('view.php',[
			'quote' => $quotes[rand(0,count($quotes)-1)]
		]);
	}
}

?>