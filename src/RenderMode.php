<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:11
 * This file belongs to the project bootstrap-4-forms
 */

namespace Czubehead\BootstrapForms;

/**
 * Class RenderMode
 * Defines the mode BootstrapRenderer works
 * @package Nette\Forms\Rendering
 * @see     BootstrapRenderer
 */
abstract class RenderMode
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