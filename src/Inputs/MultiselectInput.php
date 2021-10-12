<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Contributte\FormsBootstrap\Traits\ChoiceInputTrait;
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
	use StandardValidationTrait;

	/**
	 * @param Html|string|null $label
	 * @param string[] $items
	 */
	public function __construct($label = null, ?array $items = null)
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
		$select = parent::getControl();

		$select->attrs += [
			'class'    => [BootstrapForm::getBootstrapVersion() === BootstrapVersion::V5 ? 'form-select' : 'form-control'],
			'disabled' => $this->isControlDisabled(),
		];

		return $select;
	}

}
