<?php

namespace Contributte\FormsBootstrap\Inputs;


use Contributte\FormsBootstrap\Traits\ChoiceInputTrait;
use Contributte\FormsBootstrap\Traits\InputPromptTrait;
use Contributte\FormsBootstrap\Traits\StandardValidationTrait;
use Nette\Forms\Controls\SelectBox;
use Nette\Utils\Html;

/**
 * Class SelectInput.
 * Single select.
 * @package Contributte\FormsBootstrap
 */
class SelectInput extends SelectBox implements IValidationInput
{
	use ChoiceInputTrait;
	use InputPromptTrait;
	use StandardValidationTrait;

	/**
	 * SelectInput constructor.
	 * @param null       $label
	 * @param array|null $items
	 */
	public function __construct($label = NULL, $items = NULL)
	{
		parent::__construct($label);
		$this->setItems($items);
	}

	/**
	 * @inheritdoc
	 */
	public function getControl(): Html
	{
		$select = parent::getControl()->setHtml(NULL);

		$select->attrs += [
			'class'    => ['custom-select'],
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
