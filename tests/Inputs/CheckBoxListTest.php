<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Tests\BaseTest;

class CheckBoxListTest extends BaseTest
{

	public function testSetItemsWithKeysAndValueIntegers(): void
	{
		$form = new BootstrapForm();
		$items = [2020 => 2020, 2021 => 2021];
		$control = $form->addCheckboxList('numbers', 'numbers', $items);
		$html = $control->getControl()->render();
		$expectedHtml = '<fieldset><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="numbers[]" id="frm-numbers0" data-nette-rules="[]" value="2020"><label class="custom-control-label" for="frm-numbers0">2020</label></label><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="numbers[]" id="frm-numbers1" data-nette-rules="[]" value="2021"><label class="custom-control-label" for="frm-numbers1">2021</label></label></fieldset>';
		$this->assertEquals($expectedHtml, $html);
	}

}
