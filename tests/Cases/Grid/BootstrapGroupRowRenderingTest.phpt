<?php declare(strict_types = 1);

namespace Tests\Cases\Grid;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Enums\RenderMode;
use Contributte\Tester\Toolkit;
use Mockery;
use Nette\Application\UI\Presenter;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$row1 = $form->addRow('line1');
	$row1->getElementPrototype()->setAttribute('class', 'class1');
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
	$form->setParent(Mockery::mock(Presenter::class)->shouldIgnoreMissing());

	ob_start();
	$form->render();
	$output = ob_get_clean();

	Assert::same(file_get_contents(__DIR__ . '/../../data/bootstrap_group_row_rendering.html'), $output);
});
