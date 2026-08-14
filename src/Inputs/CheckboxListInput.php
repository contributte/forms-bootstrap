<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\Traits\ChoiceInputTrait;
use Contributte\FormsBootstrap\Traits\StandardValidationTrait;
use Nette\Forms\Controls\CheckboxList;
use Nette\Utils\Html;
use Stringable;

/**
 * Class CheckboxListInput.
 * Multiple checkboxes in a list.
 */
class CheckboxListInput extends CheckboxList implements IValidationInput
{

	use ChoiceInputTrait;
	use StandardValidationTrait {
		showValidation as protected _rawShowValidation;
	}

	/**
	 * @inheritdoc
	 */
	public function getControl(): Html
	{
		parent::getControl();

		$fieldset = Html::el('fieldset', [
			'disabled' => $this->isControlDisabled(),
		]);

		$baseId = $this->getHtmlId();
		$c = 0;
		foreach ($this->items as $value => $caption) {
			$line = CheckboxInput::makeCheckbox(
				$this->getHtmlName(),
				$baseId . $c,
				is_scalar($caption) || $caption instanceof Stringable ? (string) $caption : null,
				$this->isValueSelected($value),
				$value,
				false,
				$this->isValueDisabled($value),
				$this->getRules()
			);

			$fieldset->addHtml($line);
			$c++;
		}

		return $fieldset;
	}

	/**
	 * Modify control in such a way that it explicitly shows its validation state.
	 * Returns the modified element.
	 */
	public function showValidation(Html $control): Html
	{
		// same parent, but no children
		$fieldset = Html::el($control->getName(), $control->attrs);
		/** @var Html $label */
		foreach ($control->getChildren() as $label) {
			/** @var Html $input */
			$input = $label->getChildren()[0];
			$label->insert(0, $this->_rawShowValidation($input), replace: true);
			$fieldset->addHtml($label);
		}

		return $fieldset;
	}

}
