<?php

namespace Contributte\FormsBootstrap\Traits;

use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Enums\RendererConfig;
use Nette\Forms\Controls\BaseControl;
use Nette\Utils\Html;


/**
 * Trait StandardValidationTrait.
 * Standard way to implement control validation.
 * @package Contributte\FormsBootstrap\Traits
 */
trait StandardValidationTrait
{
	/**
	 * Modify control in such a way that it explicitly shows its validation state.
	 * Returns the modified element.
	 * @param Html $control
	 * @return Html
	 */
	public function showValidation(Html $control)
	{
		/** @var BaseControl $this */
		$renderer = $this->getForm()->getRenderer();
		/** @var BootstrapRenderer $renderer */

		/** @var BaseControl $this */
		$control = $renderer->configElem(
			$this->hasErrors() ? RendererConfig::inputInvalid : RendererConfig::inputValid,
			$control
		);

		return $control;
	}
}
