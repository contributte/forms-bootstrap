<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\BootstrapUtils;
use Contributte\FormsBootstrap\Traits\StandardValidationTrait;
use Nette\Forms\Controls\TextArea;
use Nette\InvalidArgumentException;
use Nette\Utils\Html;

class TextAreaInput extends TextArea implements IValidationInput, IAutocompleteInput
{

	use StandardValidationTrait;

	/** @var bool|null */
	private $autocomplete = null;

	public function __construct(?string $label = null)
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
		if (!in_array($bool, [true, false, null], true)) {
			throw new InvalidArgumentException('valid values are only true/false/null');
		}

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
