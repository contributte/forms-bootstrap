<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Traits;

use Nette\InvalidArgumentException;
use Nette\NotSupportedException;

/**
 * Trait InputPromptTrait.
 * Adds string property prompt. Prompt is the empty value of a select.
 */
trait InputPromptTrait
{

	/**
	 * Sets the first unselectable item on list. Its value is null.
	 *
	 * @param string|null $prompt
	 * @return static
	 */
	public function setPrompt($prompt)
	{
		if (empty($prompt)) {
			return $this;
		}

		if (!isset($this->items)) {
			throw new NotSupportedException('This must be a ChoiceControl');
		}

		/** @var array<int, int|string|null> $keys */
		$keys = array_keys($this->items);
		if (in_array('', $keys, true) || in_array(null, $keys, true)) {
			throw new InvalidArgumentException(
				'There is an item whose value === "" or null .' .
				'Setting prompt would interfere with this value.'
			);
		}

		parent::setPrompt($prompt);

		return $this;
	}

}
