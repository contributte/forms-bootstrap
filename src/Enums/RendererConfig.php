<?php

namespace Contributte\FormsBootstrap\Enums;


use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Grid\BootstrapCell;
use Contributte\FormsBootstrap\Grid\BootstrapRow;


/**
 * Class RendererConfig.
 * An enum of possible BootstrapRenderer configuration options.
 * @package Contributte\FormsBootstrap\Enums
 * @see     BootstrapRenderer
 */
class RendererConfig
{
	/**
	 * The form element
	 */
	const form = 'form';

	/**
	 * Form group
	 */
	const group = 'group';
	/**
	 * Label of a group
	 */
	const groupLabel = 'group-label';

	/**
	 * Bootstrap row
	 * @see BootstrapRow
	 */
	const gridRow = 'grid-row';
	/**
	 * @see BootstrapCell
	 */
	const gridCell = 'grid-cell';

	/**
	 * Errors belonging to the form rather than an individual control. This is a container.
	 */
	const formOwnErrors = 'form-own-errors';
	/**
	 * Multiple of those will be inside formOwnErrors
	 */
	const formOwnError = 'form-own-error';

	const pair = 'pair';
	const label = 'label';
	const description = 'description';
	/**
	 * form group parts which are not label - input, feedback, description
	 */
	const nonLabel = 'non-label';

	/**
	 * Influences on control HTML. Applied after validation.
	 */
	const input = 'input';
	const inputValid = 'input-valid';
	const inputInvalid = 'input-invalid';
	/**
	 * Element that is normally an inline element within bootstrap
	 */

	/**
	 * Text saying if field is valid or invalid
	 */
	const feedback = 'feedback';
	/**
	 * Child of 'feedback'. Extra attributes for invalid feedback
	 */
	const feedbackValid = 'feedback-valid';
	/**
	 * Child of 'feedback'. Extra attributes for valid feedback
	 */
	const feedbackInvalid = 'feedback-invalid';

	/**
	 * Element name
	 */
	const elementName = 'element';
	/**
	 * Container. Must contain 'element' key. May be recursive.
	 */
	const container = 'container';

	const attributes = 'attributes';
	/**
	 * Class or array of classes to set
	 */
	const classSet = 'class-set';
	/**
	 * Class or array of classes to add
	 */
	const classAdd = 'class-add';
	/**
	 * Class or array to classes to remove if they exist
	 */
	const classRemove = 'class-remove';
}
