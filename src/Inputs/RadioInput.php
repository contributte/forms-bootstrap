<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://github.com/czubehead/bootstrap-4-forms
 */

namespace Czubehead\BootstrapForms\Inputs;


use Czubehead\BootstrapForms\Enums\RendererOptions;
use Czubehead\BootstrapForms\Traits\ChoiceInputTrait;
use Czubehead\BootstrapForms\Traits\StandardValidationTrait;
use Nette\Forms\Controls\ChoiceControl;
use Nette\Utils\Html;


/**
 * Class RadioList
 * @package Czubehead\BootstrapForms
 */
class RadioInput extends ChoiceControl implements IValidationInput
{
	use ChoiceInputTrait;
	use StandardValidationTrait {
		showValidation as protected _rawShowValidation;
	}

	/**
	 * @var Html
	 */
	private $container;

	/**
	 * @param  string|object
	 * @param array|null $items
	 */
	public function __construct($label = NULL, array $items = NULL)
	{
		parent::__construct($label, $items);
		$this->control->type = 'radio';
		$this->container = Html::el('fieldset');
		$this->setOption(RendererOptions::type, 'radio');
	}

	/**
	 * Generates control's HTML element.
	 * @return Html
	 */
	public function getControl()
	{
		// has to run
		parent::getControl();

		$items = $this->getItems();
		$container = $this->container;

		$c = 0;
		$htmlId = $this->getHtmlId();
		foreach ($items as $value => $caption) {
			$disabledOption = $this->isValueDisabled($value);
			$itemHtmlId = $htmlId . $c;

			$wrapper = Html::el('div', [
				'class' => ['custom-control', 'custom-radio'],
			]);

			$wrapper->addHtml(
				Html::el('input', [
					'class'    => ['custom-control-input'],
					'type'     => 'radio',
					'value'    => $value,
					'name'     => $this->getHtmlName(),
					'checked'  => $this->isValueSelected($value),
					'disabled' => $disabledOption,
					'id'       => $itemHtmlId,
				])
			);

			$wrapper->addHtml(
				Html::el('label', [
					'class' => ['custom-control-label'],
					'for'   => $itemHtmlId,
				])->setText($caption)
			);

			$container->addHtml($wrapper);
			$c++;
		}

		return $container;
	}

	/**
	 * Modify control in such a way that it explicitly shows its validation state.
	 * Returns the modified element.
	 * @param Html $control
	 * @return Html
	 */
	public function showValidation(Html $control)
	{
		$fieldset = Html::el($control->getName(), $control->attrs);
		/** @var Html $rowDiv */
		foreach ($control->getChildren() as $rowDiv) {
			$input = $rowDiv->getChildren()[0];
			$rowDiv->getChildren()[0] = $this->_rawShowValidation($input);
			$fieldset->addHtml($rowDiv);
		}

		return $control;
	}
}