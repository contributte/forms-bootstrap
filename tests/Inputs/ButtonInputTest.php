<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Tests\BaseTest;

class ButtonInputTest extends BaseTest
{

	public function testDefaultButton(): void
	{
		$form = new BootstrapForm();
		$btn = $form->addButton('btn', 'caption');
		$this->assertEquals('<button type="button" name="btn" class="btn btn-secondary">caption</button>', $btn->getControl()->render());
	}

	public function testHtmlAttributeButton(): void
	{
		$form = new BootstrapForm();
		$btn = $form->addButton('btn', 'caption')
			->setHtmlAttribute('onclick', 'someFunc()');
		$this->assertEquals('<button type="button" name="btn" onclick="someFunc()" class="btn btn-secondary">caption</button>', $btn->getControl()->render());
	}

}
