<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Enums;

use DateTime;

/**
 * An easy-to-use list of date/time formats
 * How to understand the constants
 * ===============================
 * 1. `D_` prefix -> date format
 * 2. `T_` prefix -> time format
 * 3. `DMY`,`YMD` and `MDY` specify the *order* of day, month and year
 * 4. `_NO_LEAD` suffix means no leading zeros
 * 5. `T_12` `LOWER`/`UPPER` point to AM/am, PM/pm
 */
class DateTimeFormat
{

	public const D_DMY_DOTS = 'd.m.Y';
	public const D_DMY_DOTS_NO_LEAD = 'j.n.Y';

	public const D_DMY_SLASHES = 'd/m/Y';
	public const D_DMY_SLASHES_NO_LEAD = 'j/n/Y';

	public const D_DMY_DASHES = 'd-m-Y';
	public const D_DMY_DASHES_NO_LEAD = 'j-n-Y';

	public const D_YMD_DOTS = 'Y.m.d';
	public const D_YMD_DOTS_NO_LEAD = 'Y.n.j';

	public const D_YMD_SLASHES = 'Y/m/d';
	public const D_YMD_SLASHES_NO_LEAD = 'Y/n/j';

	public const D_YMD_DASHES = 'Y-m-d';
	public const D_YMD_DASHES_NO_LEAD = 'Y-n-j';

	public const D_MDY_DOTS = 'm.d.Y';
	public const D_MDY_DOTS_NO_LEAD = 'n.j.Y';

	public const D_MDY_SLASHES = 'm/d/Y';
	public const D_MDY_SLASHES_NO_LEAD = 'n/j/Y';

	public const D_MDY_DASHES = 'm-d-Y';
	public const D_MDY_DASHES_NO_LEAD = 'n-j-Y';

	public const T_24 = 'H:i';
	public const T_24_NO_LEAD = 'G:i';

	public const T_12_LOWER = 'h:i a';
	public const T_12_LOWER_NO_LEAD = 'g:i a';

	public const T_12_UPPER = 'h:i A';
	public const T_12_UPPER_NO_LEAD = 'g:i A';

	public const MYSQL_WITH_MICROSECONDS = 'Y-m-d H:i:s.u';
	public const MYSQL_WITHOUT_MICROSECONDS = 'Y-m-d H:i:s';

	/**
	 * Checks if give time string is indeed in the format specified.
	 * Some leading zeros check might be omitted.
	 */
	public static function validate(string $format, string $timeString): bool
	{
		$time = DateTime::createFromFormat($format, $timeString);

		return ($time !== false) && ($timeString === $time->format($format));
	}

	/**
	 * Turns datetime format into a human readable format,  e.g. 'd.m.Y' => 'dd.mm.yyyy'.
	 * Supported values: d, j, m, n, Y, y, a, A, g, G, h, H, i, s, c, U
	 */
	public static function toHumanFormat(string $format, bool $example = true, bool $appendExample = true): string
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

		return $appendExample ? $letters . ' (' . $ex . ')' : $ex;
	}

}
