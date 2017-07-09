<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://gitlab.com/czubehead/bootstrap-4-forms
 */

namespace Czubehead\BootstrapForms;


use Nette\Forms\Controls\SelectBox;

/**
 * Class SelectInput
 * @package Czubehead\BootstrapForms
 */
class SelectInput extends SelectBox
{
	use ChoiceInputTrait;
	use InputPromptTrait;

	/**
	 * SelectInput constructor.
	 *
	 * @param null       $label
	 * @param array|null $items
	 */
	public function __construct($label = null, $items = null)
	{
		parent::__construct($label);
		$this->setItems($items);
	}

	public function getControl()
	{
		$select = parent::getControl()->setHtml(null);

		$select->attrs += [
			'class'    => 'custom-select',
			'disabled' => $this->isControlDisabled(),
		];
		$options = $this->rawItems;
		if (!empty($this->prompt))
		{
			$options = [null => $this->prompt] + $options;
		}

		$optList = $this->makeOptionList($options, function ($value)
		{
			return [
				'selected' => $this->isValueSelected($value),
				'disabled' => $this->isValueDisabled($value),
			];
		});
		foreach ($optList as $item)
		{
			$select->addHtml($item);
		}

		return $select;
	}
}