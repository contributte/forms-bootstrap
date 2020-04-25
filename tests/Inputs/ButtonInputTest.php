<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Inputs\ButtonInput;
use PHPUnit\Framework\TestCase;

class ButtonInputTest extends TestCase
{

	public function testDefaultButton()
	{
		$form = new BootstrapForm();
		$btn = $form->addButton('btn', 'caption');
		$this->assertEquals('<button type="button" name="btn" class="btn btn-secondary">caption</button>', $btn->getControl()->render());
	}
}
