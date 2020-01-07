<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap;

use Nette\Utils\Html;

/**
 * Class BootstrapUtils. Utils for this library.
 */
class BootstrapUtils
{

	/**
	 * Converts element classes to an array if needed
	 */
	public static function standardizeClass(Html $control): void
	{
		$class = $control->class;
		if (is_string($class)) {
			$control->class = explode(' ', $class);
		}
	}

}
