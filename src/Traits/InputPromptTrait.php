<?php

namespace Contributte\FormsBootstrap\Traits;


use Nette\InvalidArgumentException;
use Nette\NotSupportedException;


/**
 * Trait InputPromptTrait.
 * Adds string property prompt. Prompt is the empty value of a select.
 * @property string $prompt
 * @package Contributte\FormsBootstrap\Traits
 */
trait InputPromptTrait
{
	/**
	 * @var string|null
	 */
	protected $prompt = NULL;

	/**
	 * @return null|string
	 */
	public function getPrompt()
	{
		return $this->prompt;
	}

	/**
	 * Sets the first unselectable item on list. Its value is null.
	 * @param null|string $prompt
	 * @return static
	 */
	public function setPrompt($prompt)
	{
		if (empty($prompt)) {
			return $this;
		}

		if (isset($this->items)) {
			if (in_array(NULL, array_keys($this->items))) {
				throw new InvalidArgumentException(
					"There is an item whose value == null (non-strict comparison)." .
					"Setting prompt would interfere with this value.");
			}
		}
		else {
			throw new NotSupportedException('This must be a ChoiceControl');
		}

		$this->prompt = $prompt;

		return $this;
	}
}
