<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://github.com/czubehead/bootstrap-4-forms
 */

namespace Czubehead\BootstrapForms\Inputs;


use Czubehead\BootstrapForms\Traits\StandardValidationTrait;
use Nette\Forms\Controls\Checkbox;
use Nette\Utils\Html;


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
		parent::getControl();

		return self::makeCheckbox($this->getHtmlName(), $this->getHtmlId(), $this->caption, $this->value, FALSE, $this->required,
			$this->disabled);
	}

	/**
	 * Makes a Bootstrap checkbox
	 * @param string      $name
	 * @param string      $htmlId
	 * @param string|null $caption
	 * @param bool        $checked
	 * @param bool|mixed  $value pass false to omit
	 * @param bool        $required
	 * @param bool        $disabled
	 * @return Html
	 */
	public static function makeCheckbox(
		$name, $htmlId, $caption = NULL, $checked = FALSE, $value = FALSE, $required = FALSE,
		$disabled = FALSE)
	{
		$label = Html::el('label', ['class' => ['custom-control', 'custom-checkbox']]);
		$input = Html::el('input', [
			'type'     => 'checkbox',
			'class'    => ['custom-control-input'],
			'name'     => $name,
			'disabled' => $disabled,
			'required' => $required,
			'checked'  => $checked,
			'id'       => $htmlId,
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