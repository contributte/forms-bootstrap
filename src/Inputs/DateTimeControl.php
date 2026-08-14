<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\BootstrapUtils;
use Contributte\FormsBootstrap\Traits\StandardValidationTrait;
use Nette\Utils\Html;

class DateTimeControl extends \Nette\Forms\Controls\DateTimeControl implements IValidationInput
{

	use StandardValidationTrait;

	public function getControl(): Html
	{
		$control = parent::getControl();
		BootstrapUtils::addClass($control, 'form-control');

		return $control;
	}

}
