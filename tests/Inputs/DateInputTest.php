<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\DateTimeFormat;
use Contributte\FormsBootstrap\Inputs\DateInput;
use Tests\BaseTest;

class DateInputTest extends BaseTest
{

	public function testDefaultDate(): void
	{
		$form = new BootstrapForm();
		$dt = $form->addDate('date', 'Date');
		$this->assertEquals('<input type="text" name="date" id="frm-date" class="form-control" placeholder="d.m.yyyy (31.12.1998)">', $dt->getControl()->render());
	}

	public function testWithCustomStaticFormat(): void
	{
		$form = new BootstrapForm();
		DateInput::$defaultFormat = DateTimeFormat::D_YMD_DASHES;
		$dt = $form->addDate('date', 'Date');
		$this->assertEquals('<input type="text" name="date" id="frm-date" class="form-control" placeholder="yyyy-mm-dd (1998-12-31)">', $dt->getControl()->render());
	}

}
