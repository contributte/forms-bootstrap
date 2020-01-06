<?php

namespace Contributte\FormsBootstrap\Inputs;


use Contributte\FormsBootstrap\Traits\ChoiceInputTrait;
use Contributte\FormsBootstrap\Traits\InputPromptTrait;
use Contributte\FormsBootstrap\Traits\StandardValidationTrait;
use Nette\Forms\Controls\MultiSelectBox;
use Nette\Utils\Html;

/**
 * Class MultiselectInput.
 * Selectbox where multiple options can be selected.
 * @package Contributte\FormsBootstrap\Inputs
 */
class MultiselectInput extends MultiSelectBox implements IValidationInput
{
	use ChoiceInputTrait;
	use InputPromptTrait;
	use StandardValidationTrait;

	public function __construct($label = NULL, array $items = NULL)
	{
		parent::__construct($label, NULL);
		$this->setItems($items);
	}

	/**
	 * @inheritdoc
	 */
	public function getControl(): Html
	{
		$select = parent::getControl()->setHtml(NULL);

		$select->attrs += [
			'class'    => ['form-control'],
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
