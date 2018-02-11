<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://github.com/czubehead/bootstrap-4-forms
 */

namespace Czubehead\BootstrapForms\Inputs;

use Czubehead\BootstrapForms\Traits\StandardValidationTrait;


/**
 * Class TextInput
 * @property string $placeholder
 * @package Czubehead\BootstrapForms\Inputs
 */
class TextInput extends \Nette\Forms\Controls\TextInput implements IValidationInput
{
	use StandardValidationTrait;

	/**
	 * @var string
	 */
	private $placeholder;

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
	public function getControl()
	{
		$control = parent::getControl();
		$control->class[] = 'form-control';
		if (!empty($this->placeholder)) {
			$control->setAttribute('placeholder', $this->placeholder);
		}

		return $control;
	}

	/**
	 * @return string
	 */
	public function getPlaceholder()
	{
		return $this->placeholder;
	}

	/**
	 * @param string $placeholder
	 * @return static
	 */
	public function setPlaceholder($placeholder)
	{
		$this->placeholder = $placeholder;

		return $this;
	}
}