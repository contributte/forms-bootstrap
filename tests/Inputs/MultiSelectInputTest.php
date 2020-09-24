<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Tests\BaseTest;

class MultiSelectInputTest extends BaseTest
{

	public function testMultiSelect(): void
	{
		$form = new BootstrapForm();
		$select = $form->addMultiSelect('test', 'test', ['1' => 'First', '2' => 'Second']);
		$html = $select->getControl()->render();

		$this->assertEquals('<select name="test[]" id="frm-test" multiple class="form-control"><option value="1">First</option><option value="2">Second</option></select>', $html);
	}

}
