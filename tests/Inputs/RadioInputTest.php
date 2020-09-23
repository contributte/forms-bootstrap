<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Tests\BaseTest;

class RadioInputTest extends BaseTest
{

	public function testRadioInput(): void
	{
		$form = new BootstrapForm();
		$input = $form->addRadioList('txt', 'lbl', [1 => 1, 2 => 2]);
		$this->assertEquals('<fieldset><div class="custom-control custom-radio"><input class="custom-control-input" type="radio" value="1" name="txt" id="frm-txt0" data-nette-rules="[]"><label class="custom-control-label" for="frm-txt0">1</label></div><div class="custom-control custom-radio"><input class="custom-control-input" type="radio" value="2" name="txt" id="frm-txt1"><label class="custom-control-label" for="frm-txt1">2</label></div></fieldset>', (string) $input->getControl());
	}

}
