<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Nette\Application\UI\Form;
use PHPUnit\Framework\TestCase;

class SelectInputTest extends TestCase
{

	public function testSetItemsWithKeysFalse()
	{
		$form = new BootstrapForm();
		$items = ['Croatia', 'Czech', 'Iceland', 'Sweeden'];
		$select = $form->addSelect('country', 'Country')->setItems($items, false);
		$this->assertArrayHasKey('Croatia', $select->getItems());
	}

	public function testSetItemsWithKeysTrue()
	{
		$form = new BootstrapForm();
		$items = ['Croatia', 'Czech', 'Iceland', 'Sweeden'];
		$select = $form->addSelect('country', 'Country')->setItems($items, true);
		$this->assertArrayNotHasKey('Croatia', $select->getItems());
	}
}
