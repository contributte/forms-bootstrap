<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Traits;

use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Enums\RendererConfig;
use Nette\Forms\Controls\BaseControl;
use Nette\Utils\Html;

/**
 * Trait StandardValidationTrait.
 * Standard way to implement control validation.
 */
trait StandardValidationTrait
{

	/**
	 * Modify control in such a way that it explicitly shows its validation state.
	 * Returns the modified element.
	 */
	public function showValidation(Html $control): Html
	{
		/** @var BaseControl $this */
		$renderer = $this->getForm()->getRenderer();
		/** @var BootstrapRenderer $renderer */

		/** @var BaseControl $this */
		$control = $renderer->configElem(
			$this->hasErrors() ? RendererConfig::INPUT_INVALID : RendererConfig::INPUT_VALID,
			$control
		);

		return $control;
	}

}
