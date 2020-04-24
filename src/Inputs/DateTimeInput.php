<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\Enums\DateTimeFormat;
use DateTime;
use DateTimeInterface;
use Nette\NotSupportedException;

/**
 * Class DateTimeInput. Textual datetime input.
 *
 * @property string $format expected PHP format for datetime
 */
class DateTimeInput extends TextInput
{

	/** @var string  */
	public static $defaultDateTimeFormat = DateTimeFormat::D_DMY_DOTS_NO_LEAD . ' ' . DateTimeFormat::T_24_NO_LEAD;

	/** @var string  */
	public static $defaultDateFormat = DateTimeFormat::D_DMY_DOTS_NO_LEAD;

	/**
	 * This errorMessage is added for invalid format
	 *
	 * @var string
	 */
	public $invalidFormatMessage = 'invalid/incorrect format';

	/**
	 * Input accepted format.
	 * Default is d.m.yyyy h:mm
	 *
	 * @var string
	 */
	private $format;

	/** @var bool */
	private $isValidated = false;

	public function __construct(?string $label = null, $maxLength = null, bool $withTime = true)
	{
		if ($maxLength !== null) {
			throw new NotSupportedException('Do not set $maxLength!');
		}

		parent::__construct($label, null);

		$this->addRule(function ($input) {
			return DateTimeFormat::validate($this->format, $input->value);
		}, $this->invalidFormatMessage);

		$this->setFormat($withTime ? self::$defaultDateTimeFormat : self::$defaultDateFormat);
	}

	/**
	 * @inheritdoc
	 */
	public function cleanErrors(): void
	{
		$this->isValidated = false;
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
			return null;
		}

		return $value;
	}

	/**
	 * @param DateTimeInterface|null $value
	 * @return static
	 */
	public function setValue($value)
	{
		if ($value instanceof DateTimeInterface) {
			parent::setValue($value->format($this->format));

			return $this;
		} elseif (is_string($value) && DateTimeFormat::validate($this->format, $value)) {
			parent::setValue($value);

			return $this;
		} elseif ($value === null) {
			parent::setValue(null);

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
	public function validate(): void
	{
		parent::validate();
		$this->isValidated = true;
	}

	/**
	 * @see DateTimeInput::$format
	 */
	public function getFormat(): string
	{
		return $this->format;
	}

	/**
	 * Input accepted format.
	 * Default is d.m.yyyy h:mm
	 */
	public function setFormat(string $format, ?string $placeholder = null): DateTimeInput
	{
		$this->format = $format;

		if ($placeholder === null) {
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
	 *
	 * @param bool   $example       whether to use e.g. 'd' or '01'
	 * @param bool   $appendExample attach example at the end of placeholder (true) or replace (false)e?
	 */
	public static function makeFormatPlaceholder(string $format, bool $example = true, bool $appendExample = true): string
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
		}

		if ($appendExample) {
			return $letters . '(' . $ex . ')';
		}

		if (!$appendExample) {
			return $ex;
		}

		return $letters;
	}

}
