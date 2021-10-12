<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Nette\InvalidArgumentException;
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

	public function testItemsAsMultiDimensionalArrayRenderingV5(): void
	{
		BootstrapForm::switchBootstrapVersion(BootstrapVersion::V5);

		$countries = [
			'A' => ['B', 'C'],
			'D' => [2 => 'E', 'F'],
		];

		$form = new BootstrapForm();
		$select = $form->addSelect('test', 'test')->setItems($countries, true);
		$html = $select->getControl()->render();
		$expectedHtml = '<select name="test" id="frm-test" class="form-select"><optgroup label="A"><option value="0">B</option><option value="1">C</option></optgroup><optgroup label="D"><option value="2">E</option><option value="3">F</option></optgroup></select>';
		$this->assertEquals($expectedHtml, $html);

		BootstrapForm::switchBootstrapVersion(BootstrapVersion::V4);
	}

	public function testSetPromptWithOneItemAlreadyNullShouldThrowException(): void
	{
		$this->expectException(InvalidArgumentException::class);
		$form = new BootstrapForm();
		$select = $form->addSelect('test', 'test', [null => 'choose']);
		$select->setPrompt('Hey');
	}

	public function testSetPrompt(): void
	{
		$form = new BootstrapForm();
		$select = $form->addSelect('test', 'test', ['1' => 'First', '2' => 'Second']);
		$select->setPrompt('');
		$select->setPrompt('Choose');
		$html = $select->getControl()->render();

		$this->assertStringContainsString('Choose', $html);
	}

}
