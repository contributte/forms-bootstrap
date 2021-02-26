<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Traits;

use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Enums\RendererConfig;
use Nette\Forms\Form;
use Nette\NotSupportedException;
use Nette\Utils\Html;

/**
 * Trait StandardValidationTrait.
 * Standard way to implement control validation.
 */
trait StandardValidationTrait
{

	abstract public function getForm(bool $throw = true): ?Form;

	/**
	 * Modify control in such a way that it explicitly shows its validation state.
	 * Returns the modified element.
	 */
	public function showValidation(Html $control): Html
	{
		/** @var Form $form */
		$form = $this->getForm();

		/** @var BootstrapRenderer $renderer */
		$renderer = $form->getRenderer();

		if (!($renderer instanceof BootstrapRenderer)) {
			throw new NotSupportedException('Only Bootstrap renderer is supported');
		}

		/** @var Html $control */
		$control = $renderer->configElem(
			$this->hasErrors() ? RendererConfig::INPUT_INVALID : RendererConfig::INPUT_VALID,
			$control
		);

		return $control;
	}

}
