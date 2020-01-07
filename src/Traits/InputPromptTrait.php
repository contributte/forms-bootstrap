<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Traits;

use Nette\InvalidArgumentException;
use Nette\NotSupportedException;

/**
 * Trait InputPromptTrait.
 * Adds string property prompt. Prompt is the empty value of a select.
 *
 * @property string $prompt
 */
trait InputPromptTrait
{

	/** @var string|null */
	protected $prompt = null;

	public function getPrompt(): ?string
	{
		return $this->prompt;
	}

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

		if (isset($this->items)) {
			if (in_array(null, array_keys($this->items))) {
				throw new InvalidArgumentException(
					'There is an item whose value == null (non-strict comparison).' .
					'Setting prompt would interfere with this value.'
				);
			}
		} else {
			throw new NotSupportedException('This must be a ChoiceControl');
		}

		$this->prompt = $prompt;

		return $this;
	}

}
