<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Nette\Utils\Html;

/**
 * Classes implementing this interface can explicitly show their validation status.
 * Interface IValidationInput
 */
interface IValidationInput
{

	/**
	 * Modify control in such a way that it explicitly shows its validation state.
	 * Returns the modified element.
	 */
	public function showValidation(Html $control): Html;

}
