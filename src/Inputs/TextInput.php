<?php

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\BootstrapUtils;
use Contributte\FormsBootstrap\Traits\StandardValidationTrait;
use Nette\InvalidArgumentException;


/**
 * Class TextInput
 * @property string $placeholder HTML placeholder
 * @property bool   $autocomplete
 * @package Contributte\FormsBootstrap\Inputs
 */
class TextInput extends \Nette\Forms\Controls\TextInput implements IValidationInput, IAutocompleteInput
{
	use StandardValidationTrait;

	/**
	 * @var string
	 */
	private $placeholder;

	/**
	 * @var null|bool
	 */
	private $autocomplete = NULL;

	/*
	 * @inheritdoc
	 */
	public function __construct($label = NULL, $maxLength = NULL)
	{
		parent::__construct($label, $maxLength);
		$this->setRequired(FALSE);
	}

	/*
	 * @inheritdoc
	 */

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
		if (!empty($this->placeholder)) {
			$control->setAttribute('placeholder', $this->placeholder);
		}
		if ($this->autocomplete !== NULL) {
			$control->setAttribute('autocomplete', $this->autocomplete ? 'on' : 'off');
		}

		return $control;
	}

	/**
	 * @return string
	 * @see TextInput::$placeholder
	 */
	public function getPlaceholder()
	{
		return $this->placeholder;
	}

	/**
	 * @param string $placeholder
	 * @return static
	 * @see TextInput::$placeholder
	 */
	public function setPlaceholder($placeholder)
	{
		$this->placeholder = $placeholder;

		return $this;
	}
}
