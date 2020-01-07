<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\Traits\BootstrapButtonTrait;
use Nette\Forms\Controls\SubmitButton;

/**
 * Class SubmitButtonInput. Form can be submitted with this.
 */
class SubmitButtonInput extends SubmitButton
{

	use BootstrapButtonTrait;

}
