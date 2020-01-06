<?php

namespace Contributte\FormsBootstrap\Enums;

/**
 * Class RenderMode
 * Defines the mode BootstrapRenderer works in.
 * @package Nette\Forms\Rendering
 * @see     BootstrapRenderer
 */
class RenderMode
{
	/**
	 * Labels above controls
	 */
	const VerticalMode = 0;
	/**
	 * Labels beside controls
	 */
	const SideBySideMode = 1;

	/**
	 * Everything is inline if possible
	 */
	const Inline = 2;
}
