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

	/**
	 * Reads element classes as a list, whichever way the class attribute was set
	 *
	 * @return mixed[]
	 */
	public static function fetchClasses(Html $control): array
	{
		$class = $control->getAttribute('class');

		if (is_array($class)) {
			return $class;
		}

		// class is set, but not as an array
		if (is_string($class)) {
			return explode(' ', $class);
		}

		// class is not set
		return [];
	}

	/**
	 * Appends a class to the element
	 */
	public static function addClass(Html $control, string $class): void
	{
		$classes = self::fetchClasses($control);
		$classes[] = $class;

		$control->class = $classes;
	}

	/**
	 * Removes a class from the element, if it is there at all
	 */
	public static function removeClass(Html $control, string $class): void
	{
		$control->class = array_filter(
			self::fetchClasses($control),
			static fn ($presentClass): bool => $presentClass !== $class
		);
	}

	/**
	 * Whether the element already carries the class
	 */
	public static function hasClass(Html $control, string $class): bool
	{
		return in_array($class, self::fetchClasses($control), true);
	}

}
