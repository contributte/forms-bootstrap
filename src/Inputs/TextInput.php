<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\BootstrapUtils;
use Contributte\FormsBootstrap\Traits\StandardValidationTrait;
use Nette\InvalidArgumentException;
use Nette\Utils\Html;

/**
 * Class TextInput
 *
 * @property string $placeholder HTML placeholder
 * @property bool   $autocomplete
 */
class TextInput extends \Nette\Forms\Controls\TextInput implements IValidationInput, IAutocompleteInput
{

	use StandardValidationTrait;

	/** @var string */
	private $placeholder;

	/** @var bool|null */
	private $autocomplete = null;

	public function __construct(?string $label = null, ?int $maxLength = null)
	{
		parent::__construct($label, $maxLength);
		$this->setRequired(false);
	}

	/*
	 * @inheritdoc
	 */

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
		if (!empty($this->placeholder)) {
			$control->setAttribute('placeholder', $this->placeholder);
		}

		if ($this->autocomplete !== null) {
			$control->setAttribute('autocomplete', $this->autocomplete ? 'on' : 'off');
		}

		return $control;
	}

	/**
	 * @see TextInput::$placeholder
	 */
	public function getPlaceholder(): string
	{
		return $this->placeholder;
	}

	/**
	 * @return static
	 * @see TextInput::$placeholder
	 */
	public function setPlaceholder(string $placeholder)
	{
		$this->placeholder = $placeholder;

		return $this;
	}

	public function getLabel($caption = null): Html
	{
		$label = parent::getLabel($caption);
		if (!empty($this->getLabelPrototype()->getChildren())) {
			foreach ($this->getLabelPrototype()->getChildren() as $child) {
				$label->insert(null, $child);
			}
		}

		return $label;
	}

}
