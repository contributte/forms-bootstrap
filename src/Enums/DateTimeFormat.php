<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 10.7.17
 * Time: 17:34
 * This file belongs to the project bootstrap-4-forms.code
 */

namespace Czubehead\BootstrapForms\Enums;

use DateTime;


/**
 * Defines some common datetime formats
 * @package Czubehead\BootstrapForms\Enums
 */
class DateTimeFormat
{
	/**
	 * yyyy-mm-dd mm:ss
	 */
	const DATETIME_INTERNATIONAL = self::DATE_INTERNATIONAL . ' ' . self::TIME_24;

	/**
	 * More like computer date
	 * yyyy-mm-dd
	 */
	const DATE_INTERNATIONAL = 'Y-m-d';

	/**
	 * dd.mm.yyyy
	 */
	const DATE_EUROPEAN = 'd.m.Y';

	/**
	 * Typically use for user input
	 * d.m.yyyy (no leading zeros)
	 */
	const DATE_EUROPEAN_NO_LEAD = 'j.n.Y';

	/**
	 * d.m.yyyy h:mm (no leading zeros)
	 */
	const DATETIME_EUROPEAN_NO_LEAD = self::DATE_EUROPEAN_NO_LEAD . ' ' . self::TIME_24;

	/**
	 * yyyy/mm/dd
	 */
	const DATE_AMERICAN = 'Y/m/d';

	/**
	 * yyyy/m/d (no leading zeros)
	 */
	const DATE_AMERICAN_NO_LEAD = 'Y/n/j';

	/**
	 * yyyy/mm/dd hh:mm AM/PM
	 */
	const DATETIME_AMERICAN = self::DATE_AMERICAN . ' ' . self::TIME_12;

	/**
	 * yyyy/m/d h:mm AM/PM (no leading zeros)
	 */
	const DATETIME_AMERICAN_NO_LEAD = self::DATE_AMERICAN_NO_LEAD . ' ' . self::TIME_12;

	/**
	 * 24-hour time format with leading zeros
	 */
	const TIME_24 = 'H:i';

	/**
	 * 12-hour time format, e.g. 02:15 PM
	 */
	const TIME_12 = 'h:i A';

	/**
	 * 24-hour format without leading zeros for hours.
	 */
	const TIME_24_NO_LEAD = 'G:i';

	/**
	 * 12-hour format without leading zeros, e.g. 2:15 PM
	 */
	const TIME_12_NO_LEAD = 'g:i A';

	/**
	 * Checks if give time string is indeed in the format specified
	 * @param string $format
	 * @param string $timeString
	 * @return bool
	 */
	public static function validate($format, $timeString)
	{
		$time = DateTime::createFromFormat($format, $timeString);

		return ($time !== FALSE) && ($timeString === $time->format($format));
	}
}
