<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Contributte\FormsBootstrap\Traits\StandardValidationTrait;
use Nette;
use Nette\Forms\Controls\Checkbox;
use Nette\Utils\Html;

/**
 * Class CheckboxInput. Single checkbox.
 *
 * @property bool $disabled
 */
class CheckboxInput extends Checkbox implements IValidationInput
{

	use StandardValidationTrait {
		// we only want to use it on a specific child
		showValidation as protected _rawShowValidation;
	}

	/**
	 * set to true so that checkboxes by defaults are alligned on right with input fields, you can also set
	 *
	 * @var bool
	 */
	public static $defaultAllignWithInputControls = false;

	/**
	 * set to true to allign checkbox to right with all other input controls
	 *
	 * @var bool
	 */
	public $allignWithInputControls;

	public function __construct($label = null)
	{
		$this->allignWithInputControls = static::$defaultAllignWithInputControls;
		parent::__construct($label);
	}

	/**
	 * Generates a checkbox
	 */
	public function getControl(): Html
	{
		return self::makeCheckbox(
			$this->getHtmlName(),
			$this->getHtmlId(),
			$this->translate($this->caption),
			$this->value,
			false,
			$this->required,
			$this->disabled,
			$this->getRules()
		);
	}

	/**
	 * Makes a Bootstrap checkbox HTML
	 *
	 * @param string|Html|null $caption
	 * @param bool|mixed             $value pass false to omit
	 */
	public static function makeCheckbox(
		string $name,
		string $htmlId,
		$caption = null,
		bool $checked = false,
		$value = false,
		bool $required = false,
		bool $disabled = false,
		?Nette\Forms\Rules $rules = null
	): Html
	{
		$label = Html::el('label', ['class' => BootstrapForm::getBootstrapVersion() === BootstrapVersion::V5 ? 'form-check' : ['custom-control', 'custom-checkbox']]);
		$input = Html::el('input', [
			'type'             => 'checkbox',
			'class'            => [BootstrapForm::getBootstrapVersion() === BootstrapVersion::V5 ? 'form-check-input' : 'custom-control-input'],
			'name'             => $name,
			'disabled'         => $disabled,
			'required'         => $required,
			'checked'          => $checked,
			'id'               => $htmlId,
			'data-nette-rules' => $rules ? Nette\Forms\Helpers::exportRules($rules) : false,
		]);
		if ($value !== false) {
			$input->attrs += [
				'value' => $value,
			];
		}

		$label->addHtml($input);
		$label->addHtml(
			Html::el('label', [
				'class' => [BootstrapForm::getBootstrapVersion() === BootstrapVersion::V5 ? 'form-check-label' : 'custom-control-label'],
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
	 */
	public function showValidation(Html $control): Html
	{
		// add validation classes to the first child, which is <input>
		$control->getChildren()[0] = $this->_rawShowValidation($control->getChildren()[0]);

		return $control;
	}

	public function allignWithInputControls(): bool
	{
		return $this->allignWithInputControls;
	}

	public function setAllignWithInputControls(bool $allignWithControls = true): void
	{
		$this->allignWithInputControls = $allignWithControls;
	}

}
