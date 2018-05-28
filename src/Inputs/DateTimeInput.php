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
use Nette\NotSupportedException;


/**
 * Class DateTimeInput. Textual datetime input.
 * @package Czubehead\BootstrapForms\Inputs
 * @property string $format expected PHP format for datetime
 */
class DateTimeInput extends TextInput
{
	const DEFAULT_FORMAT = DateTimeFormat::D_DMY_DOTS_NO_LEAD . ' ' . DateTimeFormat::T_24_NO_LEAD;

	/**
	 * This errorMessage is added for invalid format
	 * @var string
	 */
	public $invalidFormatMessage = 'invalid/incorrect format';

	/**
	 * Input accepted format.
	 * Default is d.m.yyyy h:mm
	 * @var string
	 */
	private $format;

	private $isValidated = FALSE;

	public function __construct($label = NULL, $maxLength = NULL)
	{
		if ($maxLength !== NULL) {
			throw new NotSupportedException('Do not set $maxLength!');
		}
		parent::__construct($label, NULL);

		$this->addRule(function ($input) {
			return DateTimeFormat::validate($this->format, $input->value);
		}, $this->invalidFormatMessage);

		$this->setFormat(self::DEFAULT_FORMAT);
	}

	/**
	 * @inheritdoc
	 */
	public function cleanErrors()
	{
		$this->isValidated = FALSE;
	}

	/**
	 * @inheritdoc
	 */
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
		} elseif (is_string($value) && DateTimeFormat::validate($this->format, $value)) {
			parent::setValue($value);

			return $this;
		} elseif ($value === NULL) {
			parent::setValue(NULL);

			return $this;
		} else {
			// this will fail validation test, but we don't want to throw an exception here
			parent::setValue($value);

			return $this;
		}
	}


	/**
	 * @inheritdoc
	 */
	public function validate()
	{
		parent::validate();
		$this->isValidated = TRUE;
	}

	/**
	 * @return string
	 * @see DateTimeInput::$format
	 */
	public function getFormat()
	{
		return $this->format;
	}

	/**
	 * Input accepted format.
	 * Default is d.m.yyyy h:mm
	 * @param string      $format
	 * @param null|string $placeholder
	 * @return DateTimeInput
	 */
	public function setFormat($format, $placeholder = NULL)
	{
		$this->format = $format;

		if ($placeholder === NULL) {
			$placeholder = self::makeFormatPlaceholder($format);
		}
		if (!empty($placeholder)) {
			$this->setPlaceholder($placeholder);
		}

		return $this;
	}

	/**
	 * Turns datetime format into a placeholder,  e.g. 'd.m.Y' => 'dd.mm.yyyy'.
	 * Supported values: d, j, m, n, Y, y, a, A, g, G, h, H, i, s, c, U
	 * @param string $format
	 * @param bool   $example       whether to use e.g. 'd' or '01'
	 * @param bool   $appendExample attach example at the end of placeholder (true) or replace (false)e?
	 * @return string
	 */
	public static function makeFormatPlaceholder($format, $example = TRUE, $appendExample = TRUE)
	{
		$letterSubs = [
			'd' => 'dd',
			'j' => 'd',
			'm' => 'mm',
			'n' => 'm',
			'Y' => 'yyyy',
			'y' => 'yy',
			'a' => 'am/pm',
			'A' => 'AM/PM',
			'g' => 'h',
			'G' => 'h',
			'h' => 'hh',
			'H' => 'hh',
			'i' => 'mm',
			's' => 'ss',
			'c' => 'yyyy-mm-ddThh:mm:ss+hh:mm',
			'U' => 'unix timestamp',
		];
		$numSubs = [
			'd' => '31',
			'j' => '31',
			'm' => '12',
			'n' => '12',
			'Y' => '1998',
			'y' => '98',
			'a' => 'am',
			'A' => 'AM',
			'g' => '12',
			'G' => '23',
			'h' => '12',
			'H' => '23',
			'i' => '59',
			's' => '00',
			'c' => '2012-12-21T17:42:00+00:00',
			'U' => '1501444136',
		];
		$letters = strtr($format, $letterSubs);
		$ex = strtr($format, $numSubs);

		if (!$example) {
			return $letters;
		} elseif ($example && $appendExample) {
			return "$letters ($ex)";
		} elseif ($example && !$appendExample) {
			return $ex;
		} else {
			return $letters;
		}
	}
}