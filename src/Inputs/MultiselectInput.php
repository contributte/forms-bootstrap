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
use Czubehead\BootstrapForms\Traits\InputPromptTrait;
use Nette\Forms\Controls\MultiSelectBox;


class MultiselectInput extends MultiSelectBox
{
	use ChoiceInputTrait;
	use InputPromptTrait;

	public function __construct($label = NULL, array $items = NULL)
	{
		parent::__construct($label, NULL);
		$this->setItems($items);
	}

	public function getControl()
	{
		$select = parent::getControl()->setHtml(NULL);

		$select->attrs += [
			'class'    => 'form-control',
			'disabled' => $this->isControlDisabled(),
		];
		$options = $this->rawItems;
		if (!empty($this->prompt)) {
			$options = [NULL => $this->prompt] + $options;
		}

		$optList = $this->makeOptionList($options, function ($value) {
			return [
				'selected' => $this->isValueSelected($value),
				'disabled' => $this->isValueDisabled($value),
			];
		});
		foreach ($optList as $item) {
			$select->addHtml($item);
		}

		return $select;
	}
}