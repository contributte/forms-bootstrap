<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use PHPUnit\Framework\TestCase;

class TextInputTest extends TestCase
{

	public function testDefaultTextInput()
	{
		$form = new BootstrapForm();
		$input = $form->addText('txt', 'lbl');
		$this->assertEquals('<input type="text" name="txt" id="frm-txt" class="form-control">', $input->getControl()->render());
		$this->assertEquals('<label for="frm-txt">lbl</label>', (string) $input->getLabel());
	}
}
