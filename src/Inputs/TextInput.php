<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://gitlab.com/czubehead/bootstrap-4-forms
 */

namespace Czubehead\BootstrapForms\Inputs;


class TextInput extends \Nette\Forms\Controls\TextInput
{
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

		return $control;
	}
}