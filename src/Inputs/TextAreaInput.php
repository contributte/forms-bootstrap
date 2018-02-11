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
use Nette\Forms\Controls\TextArea;


class TextAreaInput extends TextArea implements IValidationInput
{
	use StandardValidationTrait;
	/*
	 * @inheritdoc
	 */
	public function __construct($label = NULL)
	{
		parent::__construct($label);
		$this->setRequired(FALSE);
	}

	/**
	 * @inheritdoc
	 */
	public function getControl()
	{
		$control = parent::getControl();
		$control->class[] = 'form-control';

		return $control;
	}
}