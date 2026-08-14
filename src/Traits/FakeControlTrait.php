<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Traits;

use Nette\ComponentModel\Component;
use Nette\ComponentModel\IComponent;
use Nette\Forms\Control;
use Nette\NotImplementedException;
use Stringable;

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
	 * Hierarchical name of the component, the way a real Nette component would report it.
	 *
	 * Needed because tools that walk $form->getControls() -- Nette\Forms\Blueprint, i.e. the
	 * {formPrint} macro -- call this on everything they find, and a fake control is found too.
	 *
	 * @param class-string<IComponent>|null $type
	 */
	public function lookupPath(?string $type = null, bool $throw = true): ?string
	{
		$parent = $this->getParent();

		// the searched-for ancestor is our direct parent, so the path is just our own name
		if ($type !== null && $parent instanceof $type) {
			return $this->getName();
		}

		$parentPath = $parent instanceof Component ? $parent->lookupPath($type, $throw) : null;

		return ($parentPath === null || $parentPath === '' ? '' : $parentPath . IComponent::NameSeparator)
			. $this->getName();
	}

	/**
	 * A fake control has no label.
	 *
	 * @param string|Stringable|null $caption
	 * @return null
	 */
	public function getLabel($caption = null)
	{
		return null;
	}

	public function isRequired(): bool
	{
		return false;
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
		//intentionally empty
	}

}
