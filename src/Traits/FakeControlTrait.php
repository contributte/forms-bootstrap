<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Traits;

use Nette\Forms\Control;
use Nette\NotImplementedException;

/**
 * Trait FakeControlTrait.
 * Implements absolute minimum of functionality to be used as a control
 */
trait FakeControlTrait
{

	/**
	 * Always returns an empty array
	 *
	 * @return mixed[]
	 */
	public function getErrors(): array
	{
		return [];
	}

	/**
	 * Not supported
	 *
	 * @return null
	 */
	public function getValue()
	{
		return null;
	}

	public function isDisabled(): bool
	{
		return true;
	}

	/**
	 * Is control value excluded from $form->getValues() result?
	 */
	public function isOmitted(): bool
	{
		return true;
	}

	/**
	 * Not supported
	 *
	 * @param mixed $value
	 */
	public function setValue($value): Control
	{
		throw new NotImplementedException();
	}

	/**
	 * Do nothing
	 *
	 * @internal
	 */
	public function validate(): void
	{
	}

}
