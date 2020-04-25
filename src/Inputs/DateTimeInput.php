<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\Enums\DateTimeFormat;

/**
 * Class DateTimeInput. Textual datetime input.
 *
 * @property string $format expected PHP format for datetime
 */
class DateTimeInput extends DateInput
{

	/** @var string  */
	public static $defaultFormat = DateTimeFormat::D_DMY_DOTS_NO_LEAD . ' ' . DateTimeFormat::T_24_NO_LEAD;

	/** @var string[] */
	public static $additionalHtmlClasses = [];

}
