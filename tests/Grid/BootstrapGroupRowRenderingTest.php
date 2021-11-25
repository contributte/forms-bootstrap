<?php declare (strict_types = 1);

namespace Tests\Grid;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Enums\RenderMode;
use Nette\Application\UI\Presenter;
use Tests\BaseTest;

class BootstrapGroupRowRenderingTest extends BaseTest
{

	public function testGroupRowRendering(): void
	{
		$form = new BootstrapForm();
		$row1 = $form->addRow('line1');
		$row1->addCell(6)
			->addSelect('category', 'Category', [1 => 'Category 1', 2 => 'Category 2'])
			->setHtmlAttribute('class', 'selectpicker form-control')
			->setHtmlAttribute('title', 'Choose ...')
			->setRequired(true)
			->getLabelPrototype()
			->setClass('required');

		$row1->addCell(6)
			->addSelect('type', 'Type', [1 => 'Type 1', 2 => 'Type 2'])
			->setHtmlAttribute('class', 'selectpicker form-control')
			->setHtmlAttribute('title', 'Choose ...')
			->setRequired(true)
			->getLabelPrototype()
			->setClass('required');

		$form->addGroup('Group 1', false)
			->add([$row1]);
		$form->setRenderer(new BootstrapRenderer(RenderMode::SIDE_BY_SIDE_MODE));
		$form->setParent($this->createMock(Presenter::class));

		$this->expectOutputString($this->loadTextData('bootstrap_group_row_rendering.html'));
		$form->render();
	}

}
