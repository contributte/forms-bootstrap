<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Traits;

use Contributte\FormsBootstrap\BootstrapUtils;
use Nette\Utils\Html;

/**
 * Trait BootstrapButtonTrait. Modifies an existing button class such that it returns a bootstrap button.
 *
 * @property string $btnType
 */
trait BootstrapButtonTrait
{

	/** @var string */
	private $btnClass = 'btn-primary';

	/**
	 * Gets additional button class. Default is btn-primary.
	 */
	public function getBtnClass(): string
	{
		return $this->btnClass;
	}

	/**
	 * Sets additional button class. Default is btn-primary
	 *
	 * @return static
	 */
	public function setBtnClass(string $btnClass)
	{
		$this->btnClass = $btnClass;

		return $this;
	}

	/**
	 * @param string|null $caption
	 */
	public function getControl($caption = null): Html
	{
		$control = parent::getControl($caption);
		$this->addBtnClass($control);

		return $control;
	}

	protected function addBtnClass(Html $element): void
	{
		BootstrapUtils::standardizeClass($element);
		$element->class[] = 'btn ' . $this->getBtnClass();
	}

}
