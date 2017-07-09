<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://gitlab.com/czubehead/bootstrap-4-forms
 */

namespace Czubehead\BootstrapForms;


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
	 *
	 * @return ButtonInput
	 */
	public function addButton($name, $content = null, $btnClass = 'btn-secondary')
	{
		$comp = new ButtonInput($content);
		$comp->setBtnClass($btnClass);
		$this->addComponent($comp, $name);

		return $comp;
	}

	public abstract function addComponent(IComponent $component, $name, $insertBefore = null);

	/**
	 * @param string $name
	 * @param null   $caption
	 *
	 * @return CheckboxInput
	 */
	public function addCheckbox($name, $caption = null)
	{
		$comp = new CheckboxInput($caption);
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string     $name
	 * @param null       $label
	 * @param array|null $items
	 *
	 * @return CheckboxListInput
	 */
	public function addCheckboxList($name, $label = null, array $items = null)
	{
		$comp = new CheckboxListInput($label, $items);
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string $name
	 *
	 * @return BootstrapContainer
	 */
	public function addContainer($name)
	{
		$control = new self();
		$control->currentGroup = $this->currentGroup;
		if ($this->currentGroup !== null)
		{
			$this->currentGroup->add($control);
		}

		return $this[ $name ] = new $control;
	}

	/**
	 * Adds a datetime input.
	 *
	 * @param string $name  name
	 * @param string $label label
	 *
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
	 *
	 * @return TextInput
	 */
	public function addEmail($name, $label = null)
	{
		return $this->addText($name, $label)
					->addRule(Form::EMAIL);
	}

	/**
	 * @param string $name
	 * @param string $label
	 * @param null   $cols      ignored
	 * @param null   $maxLength ignored
	 *
	 * @return TextInput
	 */
	public function addText($name, $label = null, $cols = null, $maxLength = null)
	{
		$comp = new TextInput($label);
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * Adds error to a specific component
	 *
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
	 *
	 * @return TextInput
	 */
	public function addInteger($name, $label = null)
	{
		return $this->addText($name, $label)
					->addRule(Form::INTEGER);
	}

	/**
	 * @param string     $name
	 * @param null       $label
	 * @param array|null $items
	 * @param null       $size
	 *
	 * @return MultiselectInput
	 */
	public function addMultiSelect($name, $label = null, array $items = null, $size = null)
	{
		$comp = new MultiselectInput($label, $items);
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string $name
	 * @param string $label
	 *
	 * @return UploadInput
	 */
	public function addMultiUpload($name, $label = null)
	{
		return $this->addUpload($name, $label, true);
	}

	/**
	 * @param string $name
	 * @param string $label
	 * @param bool   $multiple
	 *
	 * @return UploadInput
	 */
	public function addUpload($name, $label = null, $multiple = false)
	{
		$comp = new UploadInput($label, $multiple);
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string $name
	 * @param string $label
	 * @param null   $cols
	 * @param null   $maxLength
	 *
	 * @return TextInput
	 */
	public function addPassword($name, $label = null, $cols = null, $maxLength = null)
	{
		return $this->addText($name, $label)
					->setType('password');
	}

	public function addRadioList($name, $label = null, array $items = null)
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
	 *
	 * @return SelectInput
	 */
	public function addSelect($name, $label = null, array $items = null, $size = null)
	{
		$comp = new SelectInput($label, $items);
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string $name
	 * @param string $caption
	 * @param string $btnClass secondary button class (primary is 'btn')
	 *
	 * @return SubmitButtonInput
	 */
	public function addSubmit($name, $caption = null, $btnClass = 'btn-primary')
	{
		$comp = new SubmitButtonInput($caption);
		$comp->setBtnClass($btnClass);
		$this->addComponent($comp, $name);

		return $comp;
	}

	/**
	 * @param string $name
	 * @param string $label
	 * @param null   $cols ignored
	 * @param null   $rows ignored
	 *
	 * @return TextAreaInput
	 */
	public function addTextArea($name, $label = null, $cols = null, $rows = null)
	{
		$comp = new TextAreaInput($label);
		$this->addComponent($comp, $name);

		return $comp;
	}
}