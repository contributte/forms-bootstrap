<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Tests\BaseTestCase;

class DateTimeControlTest extends BaseTestCase
{

	public function testDefaultDate(): void
	{
		$form = new BootstrapForm();
		$dt = $form->addDate('date', 'Date');
		$this->assertEquals('<input type="date" name="date" id="frm-date" class="form-control">', $dt->getControl()->render());
	}

}
