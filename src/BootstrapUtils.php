<?php

namespace Contributte\FormsBootstrap;


use Nette\Utils\Html;


/**
 * Class BootstrapUtils. Utils for this library.
 * @package Contributte\FormsBootstrap
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
