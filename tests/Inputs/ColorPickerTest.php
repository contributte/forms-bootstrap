<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Inputs\IValidationInput;
use Nette\Application\UI\Presenter;
use Tests\BaseTestCase;

class ColorPickerTest extends BaseTestCase
{

	public function testDefaultTextInput(): void
	{
		$form = new BootstrapForm();
		$input = $form->addColor('color', 'Choose color');
		$this->assertEquals('<input type="color" name="color" id="frm-color" value="#000000" class="form-control">', $input->getControl()->render());
		$this->assertEquals('<label for="frm-color">Choose color</label>', (string) $input->getLabel());
	}

	public function testShowsValidationState(): void
	{
		$form = new BootstrapForm();
		// Rendering a form requires a presenter with a non-empty action; see BaseTestCase users.
		$form->setParent($this->createStub(Presenter::class));
		$form->setAction('/');

		$input = $form->addColor('color', 'Choose color');
		$this->assertInstanceOf(IValidationInput::class, $input);

		$input->addError('Foobar error message');

		$html = (string) $form;
		$this->assertStringContainsString('class="form-control is-invalid"', $html);
		$this->assertStringContainsString('<div class="invalid-feedback">Foobar error message<br></div>', $html);
	}

}
