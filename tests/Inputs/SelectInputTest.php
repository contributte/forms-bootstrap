<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Tests\BaseTest;

class SelectInputTest extends BaseTest
{

	public function testSetItemsWithKeysFalse(): void
	{
		$form = new BootstrapForm();
		$items = ['Croatia', 'Czech', 'Iceland', 'Sweeden'];
		$select = $form->addSelect('country', 'Country')->setItems($items, false);
		$this->assertArrayHasKey('Croatia', $select->getItems());
	}

	public function testSetItemsWithKeysTrue(): void
	{
		$form = new BootstrapForm();
		$items = ['Croatia', 'Czech', 'Iceland', 'Sweeden'];
		$select = $form->addSelect('country', 'Country')->setItems($items, true);
		$this->assertArrayNotHasKey('Croatia', $select->getItems());
	}

}
