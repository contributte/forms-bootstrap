<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\BootstrapUtils;
use Contributte\FormsBootstrap\Traits\StandardValidationTrait;
use Nette\Forms\Controls\TextArea;
use Nette\Utils\Html;

class TextAreaInput extends TextArea implements IValidationInput, IAutocompleteInput
{

	use StandardValidationTrait;

	/** @var bool|null */
	private $autocomplete = null;

	/**
	 * @param string|Html|null $label
	 */
	public function __construct($label = null)
	{
		parent::__construct($label);
		$this->setRequired(false);
	}

	/**
	 * Gets the state of autocomplete: true=on,false=off,null=omit attribute
	 */
	public function getAutocomplete(): ?bool
	{
		return $this->autocomplete;
	}

	/**
	 * Turns autocomplete on or off.
	 *
	 * @param bool|null $bool null to omit attribute (default)
	 * @return static
	 */
	public function setAutocomplete(?bool $bool)
	{
		$this->autocomplete = $bool;

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getControl(): Html
	{
		$control = parent::getControl();
		BootstrapUtils::standardizeClass($control);

		$control->class[] = 'form-control';
		if ($this->autocomplete !== null) {
			$control->setAttribute('autocomplete', $this->autocomplete ? 'on' : 'off');
		}

		return $control;
	}

}
