<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://github.com/czubehead/bootstrap-4-forms
 */


namespace Czubehead\BootstrapForms\Inputs;


use Czubehead\BootstrapForms\Enums\DateTimeFormat;
use DateTime;
use Nette\InvalidArgumentException;
use Nette\NotSupportedException;


class DateTimeInput extends TextInput
{
	/**
	 * Input accepted format.
	 * Default is d.m.yyyy h:mm
	 * @var string
	 */
	public $format = DateTimeFormat::D_DMY_DOTS_NO_LEAD . ' ' . DateTimeFormat::T_24_NO_LEAD;

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

	/**
	 * @param DateTime|null $value
	 * @return static
	 */
	public function setValue($value)
	{
		if ($value instanceof DateTime) {
			parent::setValue($value->format($this->format));

			return $this;
		}
		elseif ($value === NULL) {
			parent::setValue(NULL);

			return $this;
		}
		throw new InvalidArgumentException('Value must be either DateTime or NULL');
	}

	public function validate()
	{
		parent::validate();
		$this->isValidated = TRUE;
	}
}