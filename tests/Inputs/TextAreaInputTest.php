<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Tests\BaseTest;

class TextAreaInputTest extends BaseTest
{

	public function testDefaultTextAreaInput(): void
	{
		$form = new BootstrapForm();
		$input = $form->addTextArea('txt', 'lbl');
		$this->assertEquals('<textarea name="txt" id="frm-txt" class="form-control"></textarea>', $input->getControl()->render());
		$this->assertEquals('<label for="frm-txt">lbl</label>', (string) $input->getLabel());
	}

}
