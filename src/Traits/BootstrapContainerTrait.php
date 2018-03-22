<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://github.com/czubehead/bootstrap-4-forms
 */

namespace Czubehead\BootstrapForms\Traits;


use Czubehead\BootstrapForms\BootstrapContainer;
use Czubehead\BootstrapForms\Inputs\ButtonInput;
use Czubehead\BootstrapForms\Inputs\CheckboxInput;
use Czubehead\BootstrapForms\Inputs\CheckboxListInput;
use Czubehead\BootstrapForms\Inputs\DateTimeInput;
use Czubehead\BootstrapForms\Inputs\MultiselectInput;
use Czubehead\BootstrapForms\Inputs\RadioInput;
use Czubehead\BootstrapForms\Inputs\SelectInput;
use Czubehead\BootstrapForms\Inputs\SubmitButtonInput;
use Czubehead\BootstrapForms\Inputs\TextAreaInput;
use Czubehead\BootstrapForms\Inputs\TextInput;
use Czubehead\BootstrapForms\Inputs\UploadInput;
use Nette\ComponentModel\IComponent;
use Nette\Forms\Form;
use Nette\Utils\Html;


/**
 * Trait BootstrapContainerTrait
 * @package Czubehead\BootstrapForms
 */
trait BootstrapContainerTrait
{
	/**
	 * @param string           $name
	 * @param null|string|Html $content
	 * @param string           $btnClass secondary button class (primary is 'btn')
	 * @return ButtonInput
	 */
	public function addButton($name, $content = NULL, $btnClass = 'btn-secondary')
	{
		$comp = new ButtonInput($content);
		$comp->setBtnClass($btnClass);
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string $name
	 * @param null   $caption
	 * @return CheckboxInput
	 */
	public function addCheckbox($name, $caption = NULL)
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
	public function addCheckboxList($name, $label = NULL, array $items = NULL)
	{
		$comp = new CheckboxListInput($label, $items);
		$this->addComponent($comp, $name);

		return $comp;
	}

	public abstract function addComponent(IComponent $component, $name, $insertBefore = NULL);

	/**
	 * @param string $name
	 * @return BootstrapContainer
	 */
	public function addContainer($name)
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
	public function addDateTime($name, $label)
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
	public function addEmail($name, $label = NULL)
	{
		return $this->addText($name, $label)
					->addRule(Form::EMAIL);
	}

	/**
	 * Adds error to a specific component
	 * @param string $componentName
	 * @param string $message
	 */
	public function addInputError($componentName, $message)
	{
		/** @noinspection PhpUndefinedMethodInspection */
		$this[ $componentName ]->addError($message);
	}

	/**
	 * @param string $name
	 * @param string $label
	 * @return TextInput
	 */
	public function addInteger($name, $label = NULL)
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
	public function addMultiSelect($name, $label = NULL, array $items = NULL, $size = NULL)
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
	public function addMultiUpload($name, $label = NULL)
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
	public function addPassword($name, $label = NULL, $cols = NULL, $maxLength = NULL)
	{
		return $this->addText($name, $label, $cols, $maxLength)
					->setType('password');
	}

	public function addRadioList($name, $label = NULL, array $items = NULL)
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
	public function addSelect($name, $label = NULL, array $items = NULL, $size = NULL)
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
	public function addSubmit($name, $caption = NULL, $btnClass = 'btn-primary')
	{
		$comp = new SubmitButtonInput($caption);
		$comp->setBtnClass($btnClass);
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
	public function addText($name, $label = NULL, $cols = NULL, $maxLength = NULL)
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
	public function addTextArea($name, $label = NULL, $cols = NULL, $rows = NULL)
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
	public function addUpload($name, $label = NULL, $multiple = FALSE)
	{
		$comp = new UploadInput($label, $multiple);
		$this->addComponent($comp, $name);

		return $comp;
	}
}