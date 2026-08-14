<?php declare (strict_types = 1);

namespace Tests\E2E;

use Contributte\FormsBootstrap\BootstrapForm;
use Nette\Application\UI\Presenter;

/**
 * A real presenter used to drive a full request lifecycle in end-to-end tests.
 * The form under test is built by a factory supplied by the test, and rendering
 * is cut short right after the signal has been processed so that no template
 * factory is needed.
 */
class TestPresenter extends Presenter
{

	/** @var callable(): BootstrapForm */
	public $formFactory;

	/** @var mixed[]|null values captured by the form's onSuccess handler */
	public ?array $succeededWith = null;

	/** @var bool whether the form's onError handler ran */
	public bool $errored = false;

	public function renderDefault(): void
	{
		// the signal has already been dispatched by now; stop before the template layer
		$this->terminate();
	}

	protected function createComponentForm(): BootstrapForm
	{
		$form = ($this->formFactory)();

		$form->onSuccess[] = function (BootstrapForm $form): void {
			$this->succeededWith = (array) $form->getValues();
		};
		$form->onError[] = function (): void {
			$this->errored = true;
		};

		return $form;
	}

}
