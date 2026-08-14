<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Traits;

use Nette\InvalidArgumentException;

/**
 * Trait InputPromptTrait.
 * Adds string property prompt. Prompt is the empty value of a select.
 */
trait InputPromptTrait
{

	/**
	 * Sets the first unselectable item on list. Its value is null.
	 */
	public function setPrompt(string|\Stringable|false $prompt): static
	{
		if (empty($prompt)) {
			return $this;
		}

		$keys = array_keys($this->items);
		if (in_array('', $keys, true)) {
			throw new InvalidArgumentException(
				'There is an item whose value === "" .' .
				'Setting prompt would interfere with this value.'
			);
		}

		parent::setPrompt($prompt);

		return $this;
	}

}
