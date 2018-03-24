<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://github.com/czubehead/bootstrap-4-forms
 */

namespace Czubehead\BootstrapForms\Inputs;


use Czubehead\BootstrapForms\BootstrapUtils;
use Czubehead\BootstrapForms\Traits\StandardValidationTrait;
use Nette\Forms\Controls\TextArea;
use Nette\InvalidArgumentException;


/**
 * Class TextAreaInput
 * @package Czubehead\BootstrapForms\Inputs
 * @property bool|null $autocomplete
 */
class TextAreaInput extends TextArea implements IValidationInput, IAutocompleteInput
{
	use StandardValidationTrait;

	private $autocomplete = NULL;

	/*
	 * @inheritdoc
	 */
	public function __construct($label = NULL)
	{
		parent::__construct($label);
		$this->setRequired(FALSE);
	}

	/**
	 * Gets the state of autocomplete: true=on,false=off,null=omit attribute
	 * @param $bool
	 * @return bool|null
	 */
	public function getAutocomplete($bool)
	{
		return $this->autocomplete;
	}

	/**
	 * Turns autocomplete on or off.
	 * @param bool|null $bool null to omit attribute (default)
	 * @return static
	 */
	public function setAutocomplete($bool)
	{
		if (!in_array($bool, [TRUE, FALSE, NULL], TRUE)) {
			throw new InvalidArgumentException('valid values are only true/false/null');
		}
		$this->autocomplete = $bool;

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getControl()
	{
		$control = parent::getControl();
		BootstrapUtils::standardizeClass($control);

		$control->class[] = 'form-control';
		if ($this->autocomplete !== NULL) {
			$control->setAttribute('autocomplete', $this->autocomplete ? 'on' : 'off');
		}

		return $control;
	}
}