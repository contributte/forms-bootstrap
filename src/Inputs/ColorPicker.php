<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\BootstrapUtils;
use Contributte\FormsBootstrap\Traits\StandardValidationTrait;
use Nette\Utils\Html;

class ColorPicker extends \Nette\Forms\Controls\ColorPicker
{

	use StandardValidationTrait;

	public function getControl(): Html
	{
		$control = parent::getControl();
		BootstrapUtils::standardizeClass($control);

		$control->class[] = 'form-control';

		return $control;
	}

}
