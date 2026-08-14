<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Traits;

use Stringable;

/**
 * Trait ChoiceInputTrait.
 * Provides basic functionality for inputs where one of more than one predefined values are possible.
 */
trait ChoiceInputTrait
{

	/**
	 * Check if whole control is disabled.
	 * This is false if only a set of values is disabled
	 */
	protected function isControlDisabled(): bool
	{
		if (is_bool($this->disabled)) {
			return $this->disabled;
		}

		return false;
	}

	/**
	 * Check if a specific value is disabled. If whole control is disabled, returns false.
	 *
	 * @param mixed $value value to check for
	 */
	protected function isValueDisabled($value): bool
	{
		$disabled = $this->disabled;
		// only something usable as an array key can be listed among the disabled values
		if (is_array($disabled) && (is_int($value) || is_string($value))) {
			return isset($disabled[$value]) && $disabled[$value];
		}

		return false;
	}

	/**
	 * @param mixed $value
	 */
	protected function isValueSelected($value): bool
	{
		$val = $this->getValue();
		if ($value === null) {
			return false;
		}

		if (is_array($val)) {
			return in_array($value, $val);
		}

		return $this->stringifyChoiceValue($value) === $this->stringifyChoiceValue($val);
	}

	/**
	 * Choice values are compared the way they appear in the rendered markup — as strings
	 *
	 * @param mixed $value
	 */
	private function stringifyChoiceValue($value): string
	{
		if ($value === null || is_scalar($value) || $value instanceof Stringable) {
			return (string) $value;
		}

		// nothing a choice key could ever be
		return '';
	}

}
