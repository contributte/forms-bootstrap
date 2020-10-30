<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\Enums\DateTimeFormat;
use DateTime;
use DateTimeInterface;
use Nette\NotSupportedException;
use Nette\Utils\Html;

/**
 * Class DateInput. Textual date input.
 *
 * @property string $format expected PHP format for datetime
 */
class DateInput extends TextInput
{

	/** @var string  */
	public static $defaultFormat = DateTimeFormat::D_DMY_DOTS_NO_LEAD;

	/** @var string[] */
	public static $additionalHtmlClasses = [];

	/** @var bool */
	public static $addDefaultPlaceholder = true;

	/**
	 * This errorMessage is added for invalid format
	 *
	 * @var string
	 */
	public $invalidFormatMessage = 'invalid/incorrect format';

	/**
	 * Input accepted format.
	 * Default is d.m.yyyy
	 *
	 * @var string
	 */
	private $format;

	/** @var bool */
	private $isValidated = false;

	/**
	 * @param Html|string|null $label
	 */
	public function __construct($label = null, ?int $maxLength = null)
	{
		if ($maxLength !== null) {
			throw new NotSupportedException('Do not set $maxLength!');
		}

		parent::__construct($label, null);

		$this->addRule(function ($input) {
			return DateTimeFormat::validate($this->format, $input->value);
		}, $this->invalidFormatMessage);

		$this->setFormat(static::$defaultFormat);
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

		if (empty($val) || !$this->isValidated) {
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
			$this->validate();

			return $this;
		} elseif (is_string($value) && DateTimeFormat::validate($this->format, $value)) {
			parent::setValue($value);
			$this->validate();

			return $this;
		} elseif ($value === null) {
			parent::setValue(null);

			return $this;
		} else {

			//maybe date from database?
			$date = DateTime::createFromFormat(DateTimeFormat::MYSQL_WITH_MICROSECONDS, $value);

			if ($date === false) {
				$date = DateTime::createFromFormat(DateTimeFormat::MYSQL_WITHOUT_MICROSECONDS, $value);
			}

			if ($date !== false) {
				parent::setValue($date->format($this->format));
				$this->validate();

				return $this;
			}

			// this will fail validation test, but we don't want to throw an exception here
			parent::setValue($value);

			return $this;
		}
	}

	public function getControl(): Html
	{
		$control = parent::getControl();
		$control->class[] = implode(' ', static::$additionalHtmlClasses);

		return $control;
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
	 * @see DateInput::$format
	 */
	public function getFormat(): string
	{
		return $this->format;
	}

	/**
	 * Input accepted format.
	 * Default is d.m.yyyy h:mm
	 */
	public function setFormat(string $format, ?string $placeholder = null): self
	{
		$this->format = $format;

		if ($placeholder === null && static::$addDefaultPlaceholder) {
			$placeholder = DateTimeFormat::toHumanFormat($format);
		}

		if (!empty($placeholder)) {
			$this->setPlaceholder($placeholder);
		}

		return $this;
	}

}
