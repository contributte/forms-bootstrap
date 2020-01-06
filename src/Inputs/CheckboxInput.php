<?php

namespace Contributte\FormsBootstrap\Inputs;


use Contributte\FormsBootstrap\Traits\StandardValidationTrait;
use Nette;
use Nette\Forms\Controls\Checkbox;
use Nette\Utils\Html;


/**
 * Class CheckboxInput. Single checkbox.
 * @package Contributte\FormsBootstrap\Inputs
 */
class CheckboxInput extends Checkbox implements IValidationInput
{
	use StandardValidationTrait {
		// we only want to use it on a specific child
		showValidation as protected _rawShowValidation;
	}

	/**
	 * Generates a checkbox
	 * @return Html
	 */
	public function getControl()
	{
		return self::makeCheckbox($this->getHtmlName(), $this->getHtmlId(), $this->translate($this->caption), $this->value, FALSE, $this->required,
			$this->disabled, $this->getRules());
	}

	/**
	 * Makes a Bootstrap checkbox HTML
	 * @param string                 $name
	 * @param string                 $htmlId
	 * @param string|null            $caption
	 * @param bool                   $checked
	 * @param bool|mixed             $value pass false to omit
	 * @param bool                   $required
	 * @param bool                   $disabled
	 * @param Nette\Forms\Rules|null $rules
	 * @return Html
	 */
	public static function makeCheckbox(
		$name, $htmlId, $caption = NULL, $checked = FALSE, $value = FALSE, $required = FALSE,
		$disabled = FALSE, $rules = NULL)
	{
		$label = Html::el('label', ['class' => ['custom-control', 'custom-checkbox']]);
		$input = Html::el('input', [
			'type'             => 'checkbox',
			'class'            => ['custom-control-input'],
			'name'             => $name,
			'disabled'         => $disabled,
			'required'         => $required,
			'checked'          => $checked,
			'id'               => $htmlId,
			'data-nette-rules' => $rules ? Nette\Forms\Helpers::exportRules($rules) : FALSE,
		]);
		if ($value !== FALSE) {
			$input->attrs += [
				'value' => $value,
			];
		}

		$label->addHtml($input);
		$label->addHtml(
			Html::el('label', [
				'class' => ['custom-control-label'],
				'for'   => $htmlId,
			])->setText($caption)
		);

		$line = Html::el('div');
		$line->addHtml($label);

		return $label;
	}

	/**
	 * Modify control in such a way that it explicitly shows its validation state.
	 * Returns the modified element.
	 * @param Html $control
	 * @return Html
	 */
	public function showValidation(Html $control)
	{
		// add validation classes to the first child, which is <input>
		$control->getChildren()[0] = $this->_rawShowValidation($control->getChildren()[0]);

		return $control;
	}
}
