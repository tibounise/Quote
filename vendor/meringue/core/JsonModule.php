<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\core;

trait JsonModule {
	public static function loadJson($jsonFile) {
		return \meringue\storage\Json::loadJson($jsonFile);
	}

	public static function saveJson($jsonFile,$data) {
		\meringue\storage\Json::saveJson($jsonFile,$data);
	}
}

?>