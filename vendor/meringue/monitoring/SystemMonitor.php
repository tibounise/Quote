<?php
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

namespace meringue\monitoring;

/**
 * The SystemMonitor class handle monitoring of the
 * system, such as CPU or RAM usage.
 * 
 * @package meringue
 */
class SystemMonitor {
	/**
	 * Get the memory usage (peak usage, which is I think
	 * more significant)
	 * 
	 * @return integer Number of bytes of memory used
	 * @access public
	 * @static
	 */
	public static function getMemoryUsage() {
		return memory_get_peak_usage();
	}

	/**
	 * Calculate the execution time from to the request to
	 * the function call
	 * 
	 * @return float Seconds since the request
	 * @access public
	 * @static
	 */
	public static function getCurrentExecTime() {
		return microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
	}
}

?>