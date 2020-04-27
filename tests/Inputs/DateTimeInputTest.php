<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Inputs\DateInput;
use Contributte\FormsBootstrap\Inputs\DateTimeInput;
use PHPUnit\Framework\TestCase;

class DateTimeInputTest extends TestCase
{

	public function testDefaultDateTime()
	{
		$form = new BootstrapForm();
		$dt = $form->addDateTime('datetime', 'Date and time');
		$this->assertEquals('<input type="text" name="datetime" id="frm-datetime" class="form-control" placeholder="d.m.yyyy h:mm (31.12.1998 23:59)">', $dt->getControl()->render());
	}

	public function testDefaultAdditionalClasses()
	{
		$form = new BootstrapForm();
		DateTimeInput::$additionalHtmlClasses[] = 'datetimepicker';
		DateTimeInput::$additionalHtmlClasses[] = 'cool';
		$dt = $form->addDateTime('datetime', 'Date and time');
		$this->assertEquals('<input type="text" name="datetime" id="frm-datetime" class="form-control datetimepicker cool" placeholder="d.m.yyyy h:mm (31.12.1998 23:59)">', $dt->getControl()->render());
	}

	public function testNotMessingHtmlClassOfDateAndDateTime()
	{
		DateTimeInput::$additionalHtmlClasses = ['datetime'];
		DateInput::$additionalHtmlClasses = ['date'];

		$form = new BootstrapForm();
		$dt = $form->addDateTime('datetime', 'Date and time');
		$this->assertStringContainsString('class="form-control datetime"', $dt->getControl()->render());

		$d = $form->addDate('date', 'Date');
		$this->assertStringContainsString('class="form-control date"', $d->getControl()->render());
	}
}
