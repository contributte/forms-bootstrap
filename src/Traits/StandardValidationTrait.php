<?php
/**
 * Created by Petr Čech (czubehead).
 * Timestamp: 11.2.18 22:14
 */

namespace Czubehead\BootstrapForms\Traits;

use Czubehead\BootstrapForms\BootstrapRenderer;
use Czubehead\BootstrapForms\Enums\RendererConfig;
use Nette\Forms\Controls\BaseControl;
use Nette\Utils\Html;


/**
 * Trait StandardValidationTrait.
 * Standard way to implement control validation.
 * @package Czubehead\BootstrapForms\Traits
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