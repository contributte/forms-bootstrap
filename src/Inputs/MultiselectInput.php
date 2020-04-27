<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\Traits\ChoiceInputTrait;
use Contributte\FormsBootstrap\Traits\InputPromptTrait;
use Contributte\FormsBootstrap\Traits\StandardValidationTrait;
use Nette\Forms\Controls\MultiSelectBox;
use Nette\Utils\Html;

/**
 * Class MultiselectInput.
 * Selectbox where multiple options can be selected.
 */
class MultiselectInput extends MultiSelectBox implements IValidationInput
{

	use ChoiceInputTrait;
	use InputPromptTrait;
	use StandardValidationTrait;

	/**
	 * @param string[] $items
	 */
	public function __construct(?string $label = null, ?array $items = null)
	{
		parent::__construct($label, null);

		if ($items !== null) {
			$this->setItems($items);
		}
	}

	/**
	 * @inheritdoc
	 */
	public function getControl(): Html
	{
		$select = parent::getControl()->setHtml(null);

		$select->attrs += [
			'class'    => ['form-control'],
			'disabled' => $this->isControlDisabled(),
		];
		$options = $this->rawItems;
		if (!empty($this->prompt)) {
			$options = [null => $this->prompt] + $options;
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
