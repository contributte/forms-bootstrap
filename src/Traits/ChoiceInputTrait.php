<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Traits;

/**
 * Trait ChoiceInputTrait.
 * Provides basic functionality for inputs where one of more than one predefined values are possible.
 *
 * @property bool|array|null $disabled
 * @method int|string|array getValue()
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
		if (is_array($disabled)) {
			return isset($disabled[$value]) && $disabled[$value];
		} elseif (!is_bool($disabled)) {
			return $disabled === $value;
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

		return ((string) $value) === ((string) $val);
	}

}
