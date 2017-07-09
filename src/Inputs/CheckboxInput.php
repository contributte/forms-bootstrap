<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://gitlab.com/czubehead/bootstrap-4-forms
 */

namespace Czubehead\BootstrapForms\Inputs;


use Nette\Forms\Controls\Checkbox;
use Nette\Utils\Html;

class CheckboxInput extends Checkbox
{
	/**
	 * Generates a checkbox
	 * @return Html
	 */
	public function getControl()
	{
		parent::getControl();

		return self::makeCheckbox($this->name, $this->caption, $this->value, false, $this->required,
			$this->disabled);
	}

	/**
	 * Makes a Bootstrap checkbox
	 *
	 * @param string      $name
	 * @param string|null $caption
	 * @param bool        $checked
	 * @param bool|mixed  $value pass false to omit
	 * @param bool        $required
	 * @param bool        $disabled
	 *
	 * @return Html
	 */
	public static function makeCheckbox($name, $caption = null, $checked = false, $value = false, $required =
	false,
										$disabled = false)
	{
		$label = Html::el('label', ['class' => 'form-check-label']);
		$input = Html::el('input', [
			'type'     => 'checkbox',
			'class'    => 'form-check-input',
			'name'     => $name,
			'disabled' => $disabled,
			'required' => $required,
			'checked'  => $checked,
		]);
		if ($value !== false)
		{
			$input->attrs += [
				'value' => $value,
			];
		}

		$label->addHtml($input);
		$label->addText($caption);

		$line = Html::el('div', [
			'class' => 'form-check' . ($disabled ? ' disabled' : ''),
		]);
		$line->setHtml($label);

		return $line;
	}
}