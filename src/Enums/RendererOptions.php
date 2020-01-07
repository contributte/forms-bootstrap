<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Enums;

/**
 * Class RendererOptions.
 * This class provides a list of BootstrapRenderer recognised options.
 */
class RendererOptions
{

	/**
	 * Internal. If control has already been rendered.
	 */
	public const _RENDERED = '_rendered';
	/**
	 * Boolean. Can se set on groups, if false, group will not be rendered separately.
	 * Honestly I have no clue as to why would you do it, but is present on the original renderer...
	 */
	public const VISUAL = 'visual';
	/**
	 * String|Html. Can be set on groups. If it's a string, it will be used as Html::el(container)
	 */
	public const CONTAINER = 'container';
	/**
	 * String. Can be set on groups or controls. It is just a regular HTML attribute id.
	 * Note that if it's set on a control, it will be applied to the pair, not the control as it's already
	 * set internally.
	 */
	public const ID = 'id';
	/**
	 * String. Standard input description, a.ka. bootstrap Help text
	 */
	public const DESCRIPTION = 'description';
	/**
	 * String|Html. Can be set on a group and will dictate its <legend>. If it's a string, it will be
	 * translated (if applicable)
	 */
	public const LABEL = 'label';
	/**
	 * String. Can be set on an input. If set to 'hidden', label is not rendered and all hidden inputs are
	 * rendered at the end of form.
	 * I wouldn't play with this.
	 */
	public const TYPE = 'type';
	/**
	 * String. Can be set on an input. If form's validation state is shown and the input is valid, this is
	 * shown instead of an error
	 */
	public const FEEDBACK_VALID = 'feedback-valid';

}
