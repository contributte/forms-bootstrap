<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Inputs\IValidationInput;
use Tests\BaseTestCase;

class DateTimeControlTest extends BaseTestCase
{

	public function testDefaultDate(): void
	{
		$form = new BootstrapForm();
		$dt = $form->addDate('date', 'Date');
		$this->assertEquals('<input type="date" name="date" id="frm-date" class="form-control">', $dt->getControl()->render());
	}

	public function testShowsValidationState(): void
	{
		$form = new BootstrapForm();
		$dt = $form->addDate('date', 'Date');
		$this->assertInstanceOf(IValidationInput::class, $dt);

		$dt->addError('Foobar error message');

		$html = (string) $form;
		$this->assertStringContainsString('class="form-control is-invalid"', $html);
		$this->assertStringContainsString('<div class="invalid-feedback">Foobar error message<br></div>', $html);
	}

}
