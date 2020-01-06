<?php

namespace Contributte\FormsBootstrap\Traits;


use Contributte\FormsBootstrap\BootstrapContainer;
use Contributte\FormsBootstrap\Inputs\ButtonInput;
use Contributte\FormsBootstrap\Inputs\CheckboxInput;
use Contributte\FormsBootstrap\Inputs\CheckboxListInput;
use Contributte\FormsBootstrap\Inputs\DateTimeInput;
use Contributte\FormsBootstrap\Inputs\MultiselectInput;
use Contributte\FormsBootstrap\Inputs\RadioInput;
use Contributte\FormsBootstrap\Inputs\SelectInput;
use Contributte\FormsBootstrap\Inputs\SubmitButtonInput;
use Contributte\FormsBootstrap\Inputs\TextAreaInput;
use Contributte\FormsBootstrap\Inputs\TextInput;
use Contributte\FormsBootstrap\Inputs\UploadInput;
use Nette\ComponentModel\IComponent;
use Nette\Forms\Container;
use Nette\Forms\Controls\Button;
use Nette\Forms\Controls\Checkbox;
use Nette\Forms\Controls\CheckboxList;
use Nette\Forms\Controls\MultiSelectBox;
use Nette\Forms\Controls\RadioList;
use Nette\Forms\Controls\SelectBox;
use Nette\Forms\Controls\SubmitButton;
use Nette\Forms\Controls\TextArea;
use Nette\Forms\Controls\TextInput as NetteTextInput;
use Nette\Forms\Controls\UploadControl;
use Nette\Forms\Form;
use Nette\Utils\Html;


/**
 * Trait BootstrapContainerTrait.
 * Implements methods to add inputs.
 * @package Contributte\FormsBootstrap
 */
trait BootstrapContainerTrait
{
	/**
	 * @param string           $name
	 * @param null|string|Html $content
	 * @param string           $btnClass secondary button class (primary is 'btn')
	 * @return ButtonInput
	 */
	public function addButton(string $name, $content = NULL): Button
	{
		$comp = new ButtonInput($content);
		$comp->setBtnClass('btn-secondary');
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string $name
	 * @param null   $caption
	 * @return CheckboxInput
	 */
	public function addCheckbox(string $name, $caption = NULL): Checkbox
	{
		$comp = new CheckboxInput($caption);
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string     $name
	 * @param null       $label
	 * @param array|null $items
	 * @return CheckboxListInput
	 */
	public function addCheckboxList(string $name, $label = NULL, ?array $items = NULL): CheckboxList
	{
		$comp = new CheckboxListInput($label, $items);
		$this->addComponent($comp, $name);

		return $comp;
	}

	public abstract function addComponent(IComponent $component, ?string $name, ?string $insertBefore = NULL);

	/**
	 * @param string $name
	 * @return BootstrapContainer
	 */
	public function addContainer($name): Container
	{
		$control = new BootstrapContainer;
		$control->currentGroup = $this->currentGroup;
		if ($this->currentGroup !== NULL) {
			/** @noinspection PhpUndefinedMethodInspection */
			$this->currentGroup->add($control);
		}

		return $this[ $name ] = $control;
	}

	/**
	 * Adds a datetime input.
	 * @param string $name  name
	 * @param string $label label
	 * @return DateTimeInput
	 */
	public function addDateTime(string $name, $label): DateTimeInput
	{
		$comp = new DateTimeInput($label);
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param      $name
	 * @param null $label
	 * @return TextInput
	 */
	public function addEmail(string $name, $label = NULL): NetteTextInput
	{
		return $this->addText($name, $label)
					->addRule(Form::EMAIL);
	}

	/**
	 * Adds error to a specific component
	 * @param string $componentName
	 * @param string $message
	 */
	public function addInputError(string $componentName, string $message): void
	{
		/** @noinspection PhpUndefinedMethodInspection */
		$this[ $componentName ]->addError($message);
	}

	/**
	 * @param string $name
	 * @param string $label
	 * @return TextInput
	 */
	public function addInteger(string $name, $label = NULL): NetteTextInput
	{
		return $this->addText($name, $label)
					->addRule(Form::INTEGER);
	}

	/**
	 * @param string     $name
	 * @param null       $label
	 * @param array|null $items
	 * @param null       $size
	 * @return MultiselectInput
	 */
	public function addMultiSelect(string $name, $label = NULL, ?array $items = NULL, ?int $size = NULL): MultiSelectBox
	{
		$comp = new MultiselectInput($label, $items);
		if ($size !== NULL) {
			$comp->setHtmlAttribute('size', $size);
		}
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string $name
	 * @param string $label
	 * @return UploadInput
	 */
	public function addMultiUpload(string $name, $label = NULL): UploadControl
	{
		return $this->addUpload($name, $label, TRUE);
	}

	/**
	 * @param string $name
	 * @param string $label
	 * @param null   $cols
	 * @param null   $maxLength
	 * @return TextInput
	 */
	public function addPassword(string $name, $label = NULL, ?int $cols = NULL, ?int $maxLength = NULL): NetteTextInput
	{
		return $this->addText($name, $label, $cols, $maxLength)
					->setType('password');
	}

	public function addRadioList(string $name, $label = NULL, array $items = NULL): RadioList
	{
		$comp = new RadioInput($label, $items);
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string $name
	 * @param string $label
	 * @param array  $items
	 * @param null   $size ignore
	 * @return SelectInput
	 */
	public function addSelect(string $name, $label = NULL, ?array $items = NULL, ?int $size = NULL): SelectBox
	{
		$comp = new SelectInput($label, $items);
		if ($size !== NULL) {
			$comp->setHtmlAttribute('size', $size);
		}
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string $name
	 * @param string $caption
	 * @param string $btnClass secondary button class (primary is 'btn')
	 * @return SubmitButtonInput
	 */
	public function addSubmit(string $name, $caption = NULL): SubmitButton
	{
		$comp = new SubmitButtonInput($caption);
		$comp->setBtnClass('btn-primary');
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string $name
	 * @param string $label
	 * @param null   $cols      ignored
	 * @param null   $maxLength ignored
	 * @return TextInput
	 */
	public function addText(string $name, $label = NULL, ?int $cols = NULL, ?int $maxLength = NULL): NetteTextInput
	{
		$comp = new TextInput($label);
		if ($cols !== NULL) {
			$comp->setHtmlAttribute('cols', $cols);
		}
		if ($maxLength != NULL) {
			$comp->setHtmlAttribute('maxlength', $cols);
		}
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string $name
	 * @param string $label
	 * @param null   $cols ignored
	 * @param null   $rows ignored
	 * @return TextAreaInput
	 */
	public function addTextArea(string $name, $label = NULL, ?int $cols = NULL, ?int $rows = NULL): TextArea
	{
		$comp = new TextAreaInput($label);
		if ($cols !== NULL) {
			$comp->setHtmlAttribute('cols', $cols);
		}
		if ($rows !== NULL) {
			$comp->setHtmlAttribute('rows', $rows);
		}

		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string $name
	 * @param string $label
	 * @param bool   $multiple
	 * @return UploadInput
	 */
	public function addUpload(string $name, $label = NULL, bool $multiple = FALSE): UploadControl
	{
		$comp = new UploadInput($label, $multiple);
		$this->addComponent($comp, $name);

		return $comp;
	}
}
