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

	public function testItemsAsMultiDimensionalArrayWithDuplicateKeysShouldThrowException(): void
	{
		$this->expectExceptionMessage('Value "0" is used multiple times.');
		$countries = [
			'A' => ['B', 'C'],
			'D' => ['E', 'F'],
		];

		$form = new BootstrapForm();
		$select = $form->addSelect('test', 'test')->setItems($countries, true);
		 $select->getControl()->render();
	}

	public function testItemsAsMultiDimensionalArrayRendering(): void
	{
		$countries = [
			'A' => ['B', 'C'],
			'D' => [2 => 'E', 'F'],
		];

		$form = new BootstrapForm();
		$select = $form->addSelect('test', 'test')->setItems($countries, true);
		$html = $select->getControl()->render();
		$expectedHtml = '<select name="test" id="frm-test" class="custom-select"><optgroup label="A"><option value="0">B</option><option value="1">C</option></optgroup><optgroup label="D"><option value="2">E</option><option value="3">F</option></optgroup></select>';
		$this->assertEquals($expectedHtml, $html);
	}

}
