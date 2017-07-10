<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://gitlab.com/czubehead/bootstrap-4-forms
 */


namespace Czubehead\BootstrapForms\Inputs;


use Czubehead\BootstrapForms\Enums\DateTimeFormat;
use DateTime;
use Nette\NotSupportedException;


class DateTimeInput extends TextInput
{
	/**
	 * Input accepted format.
	 * Default is d.m.yyyy h:mm
	 * @var string
	 */
	public $format = DateTimeFormat::DATETIME_EUROPEAN_NO_LEAD;

	private $isValidated = FALSE;

	public function __construct($label = NULL, $maxLength = NULL)
	{
		if ($maxLength !== NULL) {
			throw new NotSupportedException('Do not set $maxLength!');
		}
		parent::__construct($label, NULL);

		$this->addRule(function ($input) {
			return DateTimeFormat::validate($this->format, $input->value);
		}, 'invalid/incorrect format');
	}

	public function cleanErrors()
	{
		$this->isValidated = FALSE;
	}

	public function getValue()
	{
		$val = parent::getValue();
		if (!$this->isValidated) {
			return $val;
		}

		$value = DateTime::createFromFormat($this->format, $val);
		if (!$value) {
			return NULL;
		}

		return $value;
	}

	public function validate()
	{
		parent::validate();
		$this->isValidated = TRUE;
	}
}