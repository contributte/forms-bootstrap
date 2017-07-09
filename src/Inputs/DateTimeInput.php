<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://gitlab.com/czubehead/bootstrap-4-forms
 */


namespace Czubehead\BootstrapForms\Inputs;


use Nette\NotSupportedException;
use Nette\Utils\DateTime;


class DateTimeInput extends TextInput
{
	const Format = "/^([0-9]{4}(-[0-9]{2}){2}T[0-9]{2}:[0-9]{2})(:[0-9]{2})?$/";

	public function __construct($label = NULL, $maxLength = NULL)
	{
		if ($maxLength !== NULL) {
			throw new NotSupportedException('Do not set $maxLength!');
		}
		parent::__construct($label, $maxLength);
		$this->setType('datetime-local');
		$this->setRequired(FALSE);

		$this->addRule(function ($val) {
			$val = $val->value;
			if ($val instanceof \DateTime) {
				return TRUE;
			}
			elseif (is_string($val)) {
				return preg_match(DateTimeInput::Format, $val);
			}

			return FALSE;
		}, "date must be: yyyy-mm-ddThh:mm");
	}

	public function getValue()
	{
		return new DateTime(parent::getValue());
	}

	public function setValue($value)
	{
		if ($this->isTimeString($value)) {
			$value = new DateTime($value);
		}
		elseif (!$value instanceof \DateTime) {
			parent::setValue(NULL);

			return;
		}
		$value = $value->format('Y-m-d H:i');
		$value = str_replace(' ', 'T', $value);

		parent::setValue($value);
	}

	private function isTimeString($string)
	{
		return preg_match(self::Format, $string);
	}
}