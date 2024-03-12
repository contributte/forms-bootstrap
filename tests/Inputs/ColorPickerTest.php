<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Tests\BaseTest;

class ColorPickerTest extends BaseTest
{

	public function testDefaultTextInput(): void
	{
		$form = new BootstrapForm();
		$input = $form->addColor('color', 'Choose color');
		$this->assertEquals('<input type="color" name="color" id="frm-color" value="#000000" class="form-control">', $input->getControl()->render());
		$this->assertEquals('<label for="frm-color">Choose color</label>', (string) $input->getLabel());
	}

}
