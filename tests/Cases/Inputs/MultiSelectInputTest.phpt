<?php declare(strict_types = 1);

namespace Tests\Cases\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Contributte\Tester\Toolkit;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$select = $form->addMultiSelect('test', 'test', ['1' => 'First', '2' => 'Second']);
	$html = $select->getControl()->render();

	Assert::same('<select name="test[]" id="frm-test" multiple class="form-control"><option value="1">First</option><option value="2">Second</option></select>', $html);
});

Toolkit::test(function (): void {
	BootstrapForm::switchBootstrapVersion(BootstrapVersion::V5);

	$form = new BootstrapForm();
	$select = $form->addMultiSelect('test', 'test', ['1' => 'First', '2' => 'Second']);
	$html = $select->getControl()->render();

	Assert::same('<select name="test[]" id="frm-test" multiple class="form-select"><option value="1">First</option><option value="2">Second</option></select>', $html);

	BootstrapForm::switchBootstrapVersion(BootstrapVersion::V4);
});
