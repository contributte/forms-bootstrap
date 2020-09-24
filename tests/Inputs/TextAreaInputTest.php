<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Tests\BaseTest;

class TextAreaInputTest extends BaseTest
{

	public function testDefaultTextAreaInput(): void
	{
		$form = new BootstrapForm();
		$input = $form->addTextArea('txt', 'lbl', 5, 10);
		$input->setAutocomplete(false);
		$this->assertFalse($input->getAutocomplete());
		$this->assertEquals('<textarea name="txt" cols="5" rows="10" id="frm-txt" class="form-control" autocomplete="off"></textarea>', $input->getControl()->render());
		$this->assertEquals('<label for="frm-txt">lbl</label>', (string) $input->getLabel());
	}

}
