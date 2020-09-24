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
		$input->getLabelPrototype()->addHtml('<a href="#">here</a>');
		$input->setAutocomplete(true);
		$this->assertTrue($input->getAutocomplete());
		$this->assertNull($input->getPlaceholder());
		$this->assertEquals('<input type="text" name="txt" id="frm-txt" class="form-control" autocomplete="on">', $input->getControl()->render());
		$this->assertEquals('<label for="frm-txt">lbl<a href="#">here</a></label>', (string) $input->getLabel());
	}

}
