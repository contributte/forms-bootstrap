<?php declare(strict_types = 1);

namespace Tests\Cases\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\Tester\Toolkit;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$input = $form->addColor('color', 'Choose color');
	Assert::same('<input type="color" name="color" id="frm-color" value="#000000" class="form-control">', $input->getControl()->render());
	Assert::same('<label for="frm-color">Choose color</label>', (string) $input->getLabel());
});
