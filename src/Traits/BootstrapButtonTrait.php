<?php

namespace Contributte\FormsBootstrap\Traits;

use Contributte\FormsBootstrap\BootstrapUtils;
use Nette\Utils\Html;


/**
 * Trait BootstrapButtonTrait. Modifies an existing button class such that it returns a bootstrap button.
 * @package Contributte\FormsBootstrap
 * @property string $btnType
 */
trait BootstrapButtonTrait
{
	/**
	 * @var string
	 */
	private $btnClass = 'btn-primary';

	/**
	 * Gets additional button class. Default is btn-primary.
	 * @return string
	 */
	public function getBtnClass()
	{
		return $this->btnClass;
	}

	/**
	 * Sets additional button class. Default is btn-primary
	 * @param string $btnClass
	 * @return static
	 */
	public function setBtnClass($btnClass)
	{
		$this->btnClass = $btnClass;

		return $this;
	}

	public function getControl($caption = NULL)
	{
		$control = parent::getControl($caption);
		$this->addBtnClass($control);

		return $control;
	}

	/**
	 * @param Html $element
	 */
	protected function addBtnClass($element)
	{
		BootstrapUtils::standardizeClass($element);
		$element->class[] = 'btn ' . $this->getBtnClass();
	}
}
