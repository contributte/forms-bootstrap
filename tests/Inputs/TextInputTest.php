<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Tests\BaseTest;

class TextInputTest extends BaseTest
{

	public function testDefaultTextInput(): void
	{
		$form = new BootstrapForm();
		$input = $form->addText('txt', 'lbl');
		$this->assertEquals('<input type="text" name="txt" id="frm-txt" class="form-control">', $input->getControl()->render());
		$this->assertEquals('<label for="frm-txt">lbl</label>', (string) $input->getLabel());
	}

}
