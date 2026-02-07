<?php declare(strict_types = 1);

namespace Tests\Cases\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\Tester\Toolkit;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$input = $form->addText('txt', 'lbl');
	$input->getLabelPrototype()->addHtml('<a href="#">here</a>');
	$input->setAutocomplete(true);
	Assert::true($input->getAutocomplete());
	Assert::null($input->getPlaceholder());
	Assert::same('<input type="text" name="txt" id="frm-txt" class="form-control" autocomplete="on">', $input->getControl()->render());
	Assert::same('<label for="frm-txt">lbl<a href="#">here</a></label>', (string) $input->getLabel());
});
