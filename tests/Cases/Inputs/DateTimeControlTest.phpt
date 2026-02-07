<?php declare(strict_types = 1);

namespace Tests\Cases\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\Tester\Toolkit;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$dt = $form->addDate('date', 'Date');
	Assert::same('<input type="date" name="date" id="frm-date" class="form-control">', $dt->getControl()->render());
});
