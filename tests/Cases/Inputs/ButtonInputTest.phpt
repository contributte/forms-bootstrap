<?php declare(strict_types = 1);

namespace Tests\Cases\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\Tester\Toolkit;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$btn = $form->addButton('btn', 'caption');
	Assert::same('<button type="button" name="btn" class="btn btn-secondary">caption</button>', $btn->getControl()->render());
});

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$btn = $form->addButton('btn', 'caption')
		->setHtmlAttribute('onclick', 'someFunc()');
	Assert::same('<button type="button" name="btn" onclick="someFunc()" class="btn btn-secondary">caption</button>', $btn->getControl()->render());
});
