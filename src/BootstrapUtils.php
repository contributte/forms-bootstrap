<?php
/**
 * Created by Petr Čech (czubehead).
 * Timestamp: 24.3.18 14:39
 */

namespace Czubehead\BootstrapForms;


use Nette\Utils\Html;


/**
 * Class BootstrapUtils. Utils for this library.
 * @package Czubehead\BootstrapForms
 */
class BootstrapUtils
{
	/**
	 * Converts element classes to an array if needed
	 * @param Html $control
	 */
	public static function standardizeClass(Html $control)
	{
		$class = $control->class;
		if (is_string($class)) {
			$control->class = explode(' ', $class);
		}
	}
}