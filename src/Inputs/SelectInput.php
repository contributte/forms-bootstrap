<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\Traits\ChoiceInputTrait;
use Contributte\FormsBootstrap\Traits\StandardValidationTrait;
use Nette\Forms\Controls\SelectBox;
use Nette\Utils\Html;

/**
 * Class SelectInput.
 * Single select.
 */
class SelectInput extends SelectBox implements IValidationInput
{

	use ChoiceInputTrait;
	use StandardValidationTrait;

	/**
	 * @param null       $label
	 * @param string[]|null $items
	 */
	public function __construct($label = null, ?array $items = null)
	{
		parent::__construct($label);
		$this->setItems($items);
	}

	/**
	 * @inheritdoc
	 */
	public function getControl(): Html
	{
		$select = parent::getControl()->setHtml(null);

		$select->attrs += [
			'class'    => ['custom-select'],
			'disabled' => $this->isControlDisabled(),
		];
		$options = $this->rawItems;
		if (!empty($this->getPrompt())) {
			$options = [null => $this->getPrompt()] + $options;
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
