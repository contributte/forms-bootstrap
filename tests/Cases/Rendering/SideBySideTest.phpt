<?php declare(strict_types = 1);

namespace Tests\Cases\Rendering;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Enums\RenderMode;
use Contributte\Tester\Toolkit;
use Mockery;
use Nette\Application\UI\Presenter;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

function createForm(): BootstrapForm
{
	$form = new BootstrapForm();
	$form->setRenderer(new BootstrapRenderer(RenderMode::SIDE_BY_SIDE_MODE));
	$form->setParent(Mockery::mock(Presenter::class)->shouldIgnoreMissing());

	return $form;
}

Toolkit::test(function (): void {
	$form = createForm();

	ob_start();
	$form->render();
	$output = ob_get_clean();

	Assert::same(file_get_contents(__DIR__ . '/../../data/empty_form.html'), $output);
});

Toolkit::test(function (): void {
	$form = createForm();
	$form->setAction('?a=3&b=aw');
	$form->setMethod('get');

	ob_start();
	$form->render();
	$output = ob_get_clean();

	Assert::same(file_get_contents(__DIR__ . '/../../data/method_get.html'), $output);
});

Toolkit::test(function (): void {
	$form = createForm();
	$form->addText('a', 'b');

	ob_start();
	$form->render();
	$output = ob_get_clean();

	Assert::same(file_get_contents(__DIR__ . '/../../data/side_by_side/text.html'), $output);
});

Toolkit::test(function (): void {
	$form = createForm();
	$row1 = $form->addRow();
	$cell1 = $row1->addCell(6);
	$cell1->addText('name', 'Name');
	$cell2 = $row1->addCell(6);
	$cell2->addText('mail', 'Mail');

	ob_start();
	$form->render();
	$output = ob_get_clean();

	Assert::same(file_get_contents(__DIR__ . '/../../data/side_by_side/simple_grid.html'), $output);
});

Toolkit::test(function (): void {
	$form = createForm();
	$form->addCheckbox('a', 'b');

	ob_start();
	$form->render();
	$output = ob_get_clean();

	Assert::same(file_get_contents(__DIR__ . '/../../data/side_by_side/checkbox.html'), $output);
});

Toolkit::test(function (): void {
	$form = createForm();
	$form->addCheckbox('a', 'b')->setAllignWithInputControls();

	ob_start();
	$form->render();
	$output = ob_get_clean();

	Assert::same(file_get_contents(__DIR__ . '/../../data/side_by_side/checkbox_right.html'), $output);
});

Toolkit::test(function (): void {
	$form = createForm();
	$form->addSubmit('a', 'b');

	ob_start();
	$form->render();
	$output = ob_get_clean();

	Assert::same(file_get_contents(__DIR__ . '/../../data/side_by_side/submit.html'), $output);
});

Toolkit::test(function (): void {
	$form = createForm();
	$form->addSubmit('a', 'b')->setAllignWithInputControls();

	ob_start();
	$form->render();
	$output = ob_get_clean();

	Assert::same(file_get_contents(__DIR__ . '/../../data/side_by_side/submit_right.html'), $output);
});

Toolkit::test(function (): void {
	$form = createForm();
	$form->addTextArea('a', 'b');

	ob_start();
	$form->render();
	$output = ob_get_clean();

	Assert::same(file_get_contents(__DIR__ . '/../../data/side_by_side/textarea.html'), $output);
});

Toolkit::test(function (): void {
	$form = createForm();
	$form->addText('a')->addError('test-error');

	ob_start();
	$form->render();
	$output = ob_get_clean();

	Assert::same(file_get_contents(__DIR__ . '/../../data/side_by_side/text-error.html'), $output);
});
