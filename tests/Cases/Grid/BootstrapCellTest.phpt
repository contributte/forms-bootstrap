<?php declare(strict_types = 1);

namespace Tests\Cases\Grid;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\Tester\Toolkit;
use Mockery;
use Nette\Application\UI\Presenter;
use Nette\InvalidArgumentException;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$row = $form->addRow();
	$cell = $row->addCell(12);
	$form->setParent(Mockery::mock(Presenter::class)->shouldIgnoreMissing());

	$cell->addHtmlClass('new-class');
	Assert::same('<div class="new-class col-sm-12"></div>', $cell->render()->render());
});

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$row = $form->addRow();
	$cell = $row->addCell(12);
	$form->setParent(Mockery::mock(Presenter::class)->shouldIgnoreMissing());

	$cell->addSubmit('first', 'First');
	$cell->addSubmit('second', 'Second');

	ob_start();
	$form->render();
	$output = ob_get_clean();

	Assert::same(file_get_contents(__DIR__ . '/../../data/cell_with_2_submits.html'), $output);
});

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$row = $form->addRow();

	Assert::exception(function () use ($row): void {
		$row->addCell(15);
	}, InvalidArgumentException::class);
});

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$row = $form->addRow();
	$cell = $row->addCell(12);
	$form->setParent(Mockery::mock(Presenter::class)->shouldIgnoreMissing());

	$first = $form->addGroup('first');
	$first->add($form->addText('a'));
	$form->addGroup('second');
	$cell->setCurrentGroup($first);

	Assert::same($first, $cell->getCurrentGroup());
});
