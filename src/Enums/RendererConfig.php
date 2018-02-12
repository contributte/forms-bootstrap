<?php
/**
 * Created by Petr Čech (czubehead).
 * Timestamp: 11.2.18 14:22
 */

namespace Czubehead\BootstrapForms\Enums;


class RendererConfig
{
	const form = 'form';

	const group = 'group';
	const groupLabel = 'group-label';

	/**
	 * Inputs of class in inlineGrouped are rendered together in this.
	 * This is a container itself
	 */
	const inlineGroup = 'inline-group';
	/**
	 * element within inlineGroup
	 */
	const inlineGroupNonLabel = 'inline-group-non-label';
	/**
	 * element within inlineGroup
	 */
	const inlineGroupLabel = 'inline-group-label';
	/**
	 * pair rendered within inlineGroup
	 */
	const inlineGroupPair = 'inline-group-pair';
	/**
	 * List of classes that put inputs to inlineGrouped
	 */
	const inlineGroupedClasses = 'inline-grouped';

	const pair = 'pair';
	const label = 'label';
	const description = 'description';
	/**
	 * form group parts which are not label - input, feedback, description
	 */
	const nonLabel = 'non-label';

	const input = 'input';
	const inputValid = 'input-valid';
	const inputInvalid = 'input-invalid';
	/**
	 * Element that is normally an inline element within bootstrap
	 */

	/**
	 * list of classes that are normally inline
	 */
	const inlineInput = 'inline-input';
	/**
	 * list of classes which are considered as buttons for grouping
	 */
	const inlineClasses = 'inline-classes';

	const uploadInput = 'upload-input';
	/**
	 * List of classes considered as upload
	 */
	const uploadClasses = 'upload-classes';

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