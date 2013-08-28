<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\storage;

/**
 * JSON class
 * 
 * @package meringue
 */
class Json {
	/**
	 * Loads a JSON file
	 * 
	 * @param string $jsonFile Path
	 * @return array JSON content
	 * @access public
	 * @static
	 */
	public static function loadJson($jsonFile) {
		$json = file_get_contents($jsonFile);

		if ($json != null) {
			$jsonDecoded = json_decode($json,true);

			return $jsonDecoded;
		} else {
			throw new \Exception('The json file seems to be corrupted');
		}
	}

	/**
	 * Save to a JSON file
	 * 
	 * @param string $jsonFile Path
	 * @param array $data Array data
	 * @access public
	 * @static
	 */
	public static function saveJson($jsonFile,$data) {
		if (file_put_contents($jsonFile,json_encode($data)) === null) {
			throw new \Exception('The json file cannot be written');
		}
	}
}

?>