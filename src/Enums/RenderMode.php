<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Enums;

/**
 * Class RenderMode
 * Defines the mode BootstrapRenderer works in.
 *
 * @see     BootstrapRenderer
 */
class RenderMode
{

	/**
	 * Labels above controls
	 */
	public const VERTICAL_MODE = 0;
	/**
	 * Labels beside controls
	 */
	public const SIDE_BY_SIDE_MODE = 1;

	/**
	 * Everything is inline if possible
	 */
	public const INLINE = 2;

}
