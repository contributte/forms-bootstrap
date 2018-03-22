<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://github.com/czubehead/bootstrap-4-forms
 */

namespace Czubehead\BootstrapForms\Inputs;


use Czubehead\BootstrapForms\Traits\ChoiceInputTrait;
use Nette\Forms\Controls\CheckboxList;
use Nette\Utils\Html;


class CheckboxListInput extends CheckboxList
{
	use ChoiceInputTrait;

	public function getControl()
	{
		parent::getControl();
		$fieldset = Html::el('fieldset', [
			'disabled' => $this->isControlDisabled(),
		]);

		$baseId = $this->getHtmlId();
		$c = 0;
		foreach ($this->items as $value => $caption) {
			$line = CheckboxInput::makeCheckbox($this->name . '[]', $baseId . $c, $caption, $this->isValueSelected($value),
				$value, FALSE, $this->isValueDisabled($value));

			$fieldset->addHtml($line);
			$c++;
		}

		return $fieldset;
	}
}