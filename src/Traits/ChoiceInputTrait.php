<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Traits;

use Nette\InvalidArgumentException;
use Nette\Utils\Html;

/**
 * Trait ChoiceInputTrait.
 * Provides basic functionality for inputs where one of more than one predefined values are possible.
 */
trait ChoiceInputTrait
{

	/**
	 * items as user entered them - may be nested, unlike items, which are always flat.
	 *
	 * @var string[]
	 */
	protected $rawItems;

	/**
	 * Processes an associative array in a way that it has no nesting. Keys for
	 * nested arrays are lost, but nested arrays are merged.
	 *
	 * @param mixed[] $array
	 * @return mixed[]
	 */
	public function flatAssocArray(array $array): array
	{
		$result = [];
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$result += $this->flatAssocArray($value);
			} else {
				$result[$key] = $value;
			}
		}

		return $result;
	}

	/**
	 * Makes array of <option>. Can handle associative arrays just fine. Checks for duplicate values.
	 *
	 * @param mixed[] $items
	 * @param callable $optionArgs     takes ($value,$caption) and spits out an array of &lt;option&gt;
	 *                                 attributes
	 * @param mixed[] $valuesRendered for internal use. Do not change.
	 * @return Html[]
	 * @throws InvalidArgumentException when $items have multiple of the same values
	 */
	public function makeOptionList(array $items, callable $optionArgs, array &$valuesRendered = []): array
	{
		$ret = [];
		foreach ($items as $value => $caption) {
			if (is_int($value)) {
				$value = (string) $value;
			}

			if (is_array($caption)) {
				// subgroup
				$option = Html::el('optgroup', ['label' => $value]);

				// options within the group
				$nested = $this->makeOptionList($caption, $optionArgs, $valuesRendered);

				foreach ($nested as $item) {
					$option->addHtml($item);
				}
			} else {
				if (in_array($value, $valuesRendered)) {
					throw new InvalidArgumentException('Value "' . $value . '" is used multiple times.');
				}

				$valuesRendered[] = $value;

				// normal option
				$option = Html::el(
					'option',
					array_merge(['value' => (string) $value], $optionArgs($value, $caption))
				);
				$option->setText($caption);
			}

			$ret[] = $option;
		}

		return $ret;
	}

	/**
	 * @param mixed[] $items Items to set. Associative arrays are supported.
	 * @return static
	 */
	public function setItems(array $items, bool $useKeys = true)
	{
		$this->rawItems = $items;

		$processed = $this->flatAssocArray($items);
		parent::setItems($processed, $useKeys);

		if (!$useKeys) {
			$this->rawItems = $this->getItems();
		}

		return $this;
	}

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
