<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://gitlab.com/czubehead/bootstrap-4-forms
 */

namespace Czubehead\BootstrapForms;


use Nette\Forms\Controls\TextArea;

class TextAreaInput extends TextArea
{
	/*
	 * @inheritdoc
	 */
	public function __construct($label = null)
	{
		parent::__construct($label);
		$this->setRequired(false);
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