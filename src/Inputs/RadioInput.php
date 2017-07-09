<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://gitlab.com/czubehead/bootstrap-4-forms
 */

namespace Czubehead\BootstrapForms\Inputs;


use Czubehead\BootstrapForms\Traits\ChoiceInputTrait;
use Nette\Forms\Controls\ChoiceControl;
use Nette\Utils\Html;


/**
 * Class RadioList
 * @package Czubehead\BootstrapForms
 */
class RadioInput extends ChoiceControl
{
	use ChoiceInputTrait;

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
		$this->setOption('type', 'radio');
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

		foreach ($items as $value => $caption) {
			$disabledOption = $this->isValueDisabled($value);

			$wrapper = Html::el('div', [
				'class' => 'form-check' . ($disabledOption ? ' disabled' : ''),
			]);

			$label = Html::el('label', ['class' => 'form-check-label']);
			$input = Html::el('input', [
				'class'    => 'form-check-input',
				'type'     => 'radio',
				'value'    => $value,
				'name'     => $this->name,
				'checked'  => $this->isValueSelected($value),
				'disabled' => $disabledOption,
			]);
			$label->addHtml($input);
			$label->addText($caption);
			$wrapper->addHtml($label);

			$container->addHtml($wrapper);
		}

		return $container;
	}
}