<?php

namespace Contributte\FormsBootstrap\Inputs;

use Nette\Utils\Html;


/**
 * Classes implementing this interface can explicitly show their validation status.
 * Interface IValidationInput
 * @package Contributte\FormsBootstrap\Inputs
 */
interface IValidationInput
{
	/**
	 * Modify control in such a way that it explicitly shows its validation state.
	 * Returns the modified element.
	 * @param Html $control
	 * @return Html
	 */
	public function showValidation(Html $control);
}
