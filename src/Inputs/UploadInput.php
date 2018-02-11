<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://github.com/czubehead/bootstrap-4-forms
 */

namespace Czubehead\BootstrapForms\Inputs;


use Nette\Forms\Controls\UploadControl;
use Nette\Utils\Html;


class UploadInput extends UploadControl
{
	public function getControl()
	{
		$control = parent::getControl();
		$control->class = 'custom-file-input';

		$el = Html::el('label', ['class' => ['custom-file']]);
		$el->addHtml($control);
		$el->addHtml(
			Html::el('span', ['class' => ['custom-file-control']])
		);

		return $el;
	}
}