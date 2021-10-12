<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Tests\BaseTest;

class RadioInputTest extends BaseTest
{

	public function testRadioInput(): void
	{
		$form = new BootstrapForm();
		$input = $form->addRadioList('txt', 'lbl', [1 => 1, 2 => 2]);
		$this->assertEquals('<fieldset><div class="custom-control custom-radio"><input class="custom-control-input" type="radio" value="1" name="txt" id="frm-txt0" data-nette-rules="[]"><label class="custom-control-label" for="frm-txt0">1</label></div><div class="custom-control custom-radio"><input class="custom-control-input" type="radio" value="2" name="txt" id="frm-txt1"><label class="custom-control-label" for="frm-txt1">2</label></div></fieldset>', (string) $input->getControl());
	}

	public function testRadioInputV5(): void
	{
		BootstrapForm::switchBootstrapVersion(BootstrapVersion::V5);

		$form = new BootstrapForm();
		$input = $form->addRadioList('txt', 'lbl', [1 => 1, 2 => 2]);
		$this->assertEquals('<fieldset><div class="form-check"><input class="form-check-input" type="radio" value="1" name="txt" id="frm-txt0" data-nette-rules="[]"><label class="form-check-label" for="frm-txt0">1</label></div><div class="form-check"><input class="form-check-input" type="radio" value="2" name="txt" id="frm-txt1"><label class="form-check-label" for="frm-txt1">2</label></div></fieldset>', (string) $input->getControl());

		BootstrapForm::switchBootstrapVersion(BootstrapVersion::V4);
	}

}
